<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackCreateRequest;
use App\Http\Requests\TrackUpdateRequest;
use App\Models\Category;
use App\Models\Track;
use App\Models\User;
use App\Notifications\TrackCreatedNotification;
use App\Notifications\TrackDeletedNotification;
use App\Notifications\TrackUpdatedNotification;
use App\Utils\LocalDate;
use Auth;
use Gate;
use Settings;

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
     * @return \Illuminate\View\View The page with the track listing.
     */
    public function index() {

        $tracks = Track::with(['views', 'author'])->paginate(config('portfolio.backend.pagination_entries_per_page'));

        return view('backend.track.index', compact('tracks'));
    }

    /**
     * Shows the form to create a new track.
     *
     * @return \Illuminate\View\View The page to create a new track.
     */
    public function create() {
        $track = new Track();
        $isEditPage = false;

        return view('backend.track.edit', compact('track', 'isEditPage'));
    }

    /**
     * Shows the form to edit the specified track.
     *
     * @param  Track $track The track to edit.
     *
     * @return \Illuminate\View\View The page to edit the specified track.
     */
    public function edit(Track $track) {
        $isEditPage = true;

        return view('backend.track.edit', compact('track', 'isEditPage'));
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
        $track = Auth::user()->tracks()->create($request->all());
        $track->categories()->sync($request->get('categories', []));

        if (!empty($track)) {
            \Notification::send(User::all(), (new TrackCreatedNotification($track, Auth::user())));
        }

        return response()->json($track, empty($track) ? 500 : 200);
    }

    /**
     * Updates the specified track in the database.
     *
     * @param TrackUpdateRequest $request The data to update the track.
     * @param Track              $track    The track to update.
     *
     * @return \Illuminate\Http\JsonResponse The updated track.
     */
    public function update(TrackUpdateRequest $request, Track $track) {
        if (Gate::denies('update', $track)) {
            return redirect()->back();
        }

        $track->fill($request->all());
        $dirty = $track->getDirty();
        $success = $track->save();

        if ($success && count($dirty) > 0) {
            \Notification::send(User::all(), (new TrackUpdatedNotification($track, Auth::user(), array_keys($dirty))));
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
            \Notification::send(User::all(), (new TrackDeletedNotification($track, Auth::user())));
            return response()->json(true);
        } else {
            return response()->json(getJsonError(), 500);
        }
    }

}
