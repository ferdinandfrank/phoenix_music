<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumCreateRequest;
use App\Http\Requests\AlbumUpdateRequest;
use App\Models\Album;
use App\Models\Category;
use App\Models\User;
use App\Notifications\AlbumCreatedNotification;
use App\Notifications\AlbumDeletedNotification;
use App\Notifications\AlbumUpdatedNotification;
use App\Utils\LocalDate;
use Auth;
use Gate;
use Settings;

/**
 * AlbumController
 * -----------------------
 * Controller to handle the logic for the 'track' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class AlbumController extends Controller {

    /**
     * Displays a listing of the albums.
     *
     * @return \Illuminate\View\View The page with the track listing.
     */
    public function index() {

        $albums = Album::withCount('tracks')->paginate(config('portfolio.backend.pagination_entries_per_page'));

        return response()->view('backend.album.index', compact('albums'));
    }

    /**
     * Shows the form to create a new track.
     *
     * @return \Illuminate\View\View The page to create a new track.
     */
    public function create() {
        $album = new Album();
        $isEditPage = false;

        return response()->view('backend.album.edit', compact('track', 'isEditPage'));
    }

    /**
     * Shows the form to edit the specified track.
     *
     * @param  Album $album The track to edit.
     *
     * @return \Illuminate\View\View The page to edit the specified track.
     */
    public function edit(Album $album) {
        $isEditPage = true;

        return response()->view('backend.album.edit', compact('track', 'isEditPage'));
    }

    /**
     * Displays the details page of the specified track.
     *
     * @param Album $album The track to show the detail page.
     *
     * @return \Illuminate\View\View The details page of the specified track or the last page the user visited if the
     *                               track has not been published and the user has no permission to view it.
     */
    public function show(Album $album) {
        $album->load('tracks.categories');
        return response()->view('frontend.album.show', compact('album'));
    }

    /**
     * Stores a new track with the specified data in the database.
     *
     * @param AlbumCreateRequest $request The data to create a new track.
     *
     * @return \Illuminate\Http\JsonResponse The stored track.
     */
    public function store(AlbumCreateRequest $request) {
        $album = Auth::user()->albums()->create($request->all());
        $album->categories()->sync($request->get('categories', []));

        if (!empty($album)) {
            \Notification::send(User::all(), (new AlbumCreatedNotification($album, Auth::user())));
        }

        return response()->json($album, empty($album) ? 500 : 200);
    }

    /**
     * Updates the specified track in the database.
     *
     * @param AlbumUpdateRequest $request The data to update the track.
     * @param Album              $album    The track to update.
     *
     * @return \Illuminate\Http\JsonResponse The updated track.
     */
    public function update(AlbumUpdateRequest $request, Album $album) {
        if (Gate::denies('update', $album)) {
            return redirect()->back();
        }

        $album->fill($request->all());
        $dirty = $album->getDirty();
        $success = $album->save();

        if ($success && count($dirty) > 0) {
            \Notification::send(User::all(), (new AlbumUpdatedNotification($album, Auth::user(), array_keys($dirty))));
        }

        if ($request->has('categories')) {
            $album->categories()->sync($request->get('categories'));
        }

        return response()->json($album, $success ? 200 : 500);
    }

    /**
     * Deletes the specified track in the database.
     *
     * @param Album $album The track to delete.
     *
     * @return \Illuminate\Http\JsonResponse {@code true} if the specified track was deleted successfully, {@code
     *                                       false} otherwise.
     */
    public function destroy(Album $album) {
        if (Gate::denies('delete', $album)) {
            return redirect()->back();
        }

        $album->categories()->detach();
        $deleteSuccess = $album->delete();

        if ($deleteSuccess) {
            \Notification::send(User::all(), (new AlbumDeletedNotification($album, Auth::user())));
            return response()->json(true);
        } else {
            return response()->json(getJsonError(), 500);
        }
    }

    /**
     * Shows a preview of all possible preview layouts.
     *
     * @param Album|null $album The track of which the previews shall be shown. If this is set to {@code null} a random
     *                        track will be fetched from the database.
     *
     * @return \Illuminate\View\View The page with all possible preview layouts.
     */
    public function showPreviewLayouts(Album $album = null) {
        if ($album->id == 0) {
            $album = Album::inRandomOrder()->first();
        }

        $categories = Category::all();

        return response()->view("frontend.track.preview_preview", compact('track', 'categories'));
    }
}
