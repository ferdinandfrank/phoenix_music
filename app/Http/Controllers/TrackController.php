<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackCreateRequest;
use App\Models\Album;
use App\Models\Category;
use App\Models\Track;
use App\Models\User;
use App\Notifications\TrackCreatedNotification;
use App\Notifications\TrackDeletedNotification;
use App\Notifications\TrackUpdatedNotification;
use Auth;
use Gate;
use Illuminate\Http\Request;

/**
 * TrackController
 * -----------------------
 * Controller to handle the logic for the 'track' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class TrackController extends Controller {

    /**
     * Displays a listing of the tracks.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View The page with the track listing.
     */
    public function index(Request $request) {
        $entries_count = $request->get('entries_count') ?? 10;

        $tracks = Track::search($request->get('search'))
                       ->with(['views', 'composer', 'album', 'categories'])
                       ->sortable(['published_at' => 'desc'])
                       ->paginate($entries_count);

        $newTrackNotifications = \Auth::user()->unreadNotifications()->where('type',
            TrackCreatedNotification::class)->get();
        $newTrackKeys = $newTrackNotifications->pluck('data.key');

        foreach ($newTrackNotifications as $newTrackNotification) {
            $newTrackNotification->markAsRead();
        }

        return view('backend.track.index', compact('tracks', 'newTrackKeys', 'entries_count'));
    }

    /**
     * Shows the form to create a new track.
     *
     * @return \Illuminate\View\View The page to create a new track.
     */
    public function create() {
        return $this->showEditForm(new Track());
    }

    public function showEditForm(Track $track, $isEditPage = false) {
        $composers = User::all();
        $categories = Category::all();
        $albums = Album::all();

        return view('backend.track.edit', compact('track', 'isEditPage', 'categories', 'composers', 'albums'));
    }

    /**
     * Shows the form to edit the specified track.
     *
     * @param  Track $track The track to edit.
     *
     * @return \Illuminate\View\View The page to edit the specified track.
     */
    public function edit(Track $track) {
        return $this->showEditForm($track, true);
    }

    /**
     * Displays the details page of the specified track.
     *
     * @param Track $track The track to show the detail page.
     *
     * @return \Illuminate\View\View The details page of the specified track or the last page the user visited if the
     *                               track has not been published and the user has no permission to view it.
     */
    public function show(Track $track) {
        $track->load('categories', 'composer', 'album');

        return view('frontend.track.show', compact('track'));
    }

    /**
     * Stores a new track with the specified data in the database.
     *
     * @param TrackCreateRequest $request The data to create a new track.
     *
     * @return \Illuminate\Http\JsonResponse The stored track.
     */
    public function store(TrackCreateRequest $request) {
        $track = Track::create($request->all());
        $track->categories()->sync($request->get('categories', []));

        if (!empty($track)) {
            \Notification::send(User::ignore(Auth::id())->get(), (new TrackCreatedNotification($track, Auth::user())));
        }

        return response()->json($track, empty($track) ? 500 : 200);
    }

    /**
     * Updates the specified track in the database.
     *
     * @param TrackCreateRequest $request The data to update the track.
     * @param Track              $track   The track to update.
     *
     * @return \Illuminate\Http\JsonResponse The updated track.
     */
    public function update(TrackCreateRequest $request, Track $track) {
        if (Gate::denies('update', $track)) {
            return redirect()->back();
        }

        $track->fill($request->all());
        $dirty = $track->getDirty();
        $success = $track->save();

        if ($success && count($dirty) > 0) {
            \Notification::send(User::ignore(Auth::id())->get(), (new TrackUpdatedNotification($track, Auth::user(), array_keys($dirty))));
        }

        if ($request->has('categories')) {
            $track->categories()->sync($request->get('categories'));
        }

        return response()->json($track, $success ? 200 : 500);
    }

    /**
     * Deletes the specified track in the database.
     *
     * @param Track $track The track to delete.
     *
     * @return \Illuminate\Http\JsonResponse {@code true} if the specified track was deleted successfully, {@code
     *                                       false} otherwise.
     */
    public function destroy(Track $track) {
        if (Gate::denies('delete', $track)) {
            return redirect()->back();
        }

        $track->categories()->detach();
        $deleteSuccess = $track->delete();

        if ($deleteSuccess) {
            \Notification::send(User::ignore(Auth::id())->get(), (new TrackDeletedNotification($track, Auth::user())));

            return response()->json(true);
        } else {
            return response()->json(getJsonError(), 500);
        }
    }

}
