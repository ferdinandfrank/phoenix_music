<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumCreateRequest;
use App\Models\Album;
use App\Models\User;
use App\Notifications\AlbumCreatedNotification;
use App\Notifications\AlbumDeletedNotification;
use App\Notifications\AlbumUpdatedNotification;
use Auth;
use Gate;
use Illuminate\Http\Request;

/**
 * AlbumController
 * -----------------------
 * Controller to handle the logic for the 'album' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class AlbumController extends Controller {

    /**
     * Displays a listing of the albums.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View The page with the album listing.
     */
    public function index(Request $request) {
        $entries_count = $request->get('entries_count') ?? 10;

        $albums = Album::search($request->get('search'))
                       ->withCount('tracks')
                       ->sortable(['created_at' => 'desc'])
                       ->paginate($entries_count);

        $newAlbumNotifications = \Auth::user()->unreadNotifications()->where('type',
            AlbumCreatedNotification::class)->get();
        $newAlbumKeys = $newAlbumNotifications->pluck('data.key');

        foreach ($newAlbumNotifications as $newAlbumNotification) {
            $newAlbumNotification->markAsRead();
        }

        return response()->view('backend.album.index', compact('albums', 'newAlbumKeys', 'entries_count'));
    }

    /**
     * Shows the form to create a new album.
     *
     * @return \Illuminate\View\View The page to create a new album.
     */
    public function create() {
        if (Gate::denies('store', Album::class)) {
            return redirect()->back();
        }

        return $this->showEditForm(new Album());
    }

    /**
     * Shows the form to edit the specified album.
     *
     * @param  Album $album The album to edit.
     *
     * @return \Illuminate\View\View The page to edit the specified album.
     */
    public function edit(Album $album) {
        if (Gate::denies('update', $album)) {
            return redirect()->back();
        }

        return $this->showEditForm($album, true);
    }

    private function showEditForm(Album $album, $isEditPage = false) {
        return view('backend.album.edit', compact('album', 'isEditPage'));
    }

    /**
     * Displays the details page of the specified album.
     *
     * @param Album $album The album to show the detail page.
     *
     * @return \Illuminate\View\View The details page of the specified album.
     */
    public function show(Album $album) {
        $album->load('tracks.categories');

        return response()->view('frontend.album.show', compact('album'));
    }

    /**
     * Stores a new album with the specified data in the database.
     *
     * @param AlbumCreateRequest $request The data to create a new album.
     *
     * @return \Illuminate\Http\JsonResponse The stored album.
     */
    public function store(AlbumCreateRequest $request) {
        if (Gate::denies('store', Album::class)) {
            return redirect()->back();
        }

        $album = Album::create($request->all());

        if (!empty($album)) {
            \Notification::send(User::ignore(Auth::id())->get(), (new AlbumCreatedNotification($album, Auth::user())));
        }

        return response()->json($album, empty($album) ? 500 : 200);
    }

    /**
     * Updates the specified track in the database.
     *
     * @param AlbumCreateRequest $request The data to update the album.
     * @param Album              $album   The album to update.
     *
     * @return \Illuminate\Http\JsonResponse The updated album.
     */
    public function update(AlbumCreateRequest $request, Album $album) {
        if (Gate::denies('update', $album)) {
            return redirect()->back();
        }

        $album->fill($request->all());
        $dirty = $album->getDirty();
        $success = $album->save();

        if ($success && count($dirty) > 0) {
            \Notification::send(User::ignore(Auth::id())->get(), (new AlbumUpdatedNotification($album, Auth::user(), array_keys($dirty))));
        }

        return response()->json($album, $success ? 200 : 500);
    }

    /**
     * Deletes the specified album in the database.
     *
     * @param Album $album The album to delete.
     *
     * @return \Illuminate\Http\JsonResponse {@code true} if the specified album was deleted successfully, {@code
     *                                       false} otherwise.
     */
    public function destroy(Album $album) {
        if (Gate::denies('delete', $album)) {
            return redirect()->back();
        }

        $deleteSuccess = $album->delete();

        if ($deleteSuccess) {
            \Notification::send(User::ignore(Auth::id())->get(), (new AlbumDeletedNotification($album, Auth::user())));

            return response()->json(true);
        } else {
            return response()->json(getJsonError(), 500);
        }
    }
}
