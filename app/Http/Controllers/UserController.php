<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Mail\RegistrationEmail;
use App\Models\DatabaseNotification;
use App\Models\User;
use App\Notifications\UserCreatedNotification;
use App\Notifications\UserDeletedNotification;
use App\Notifications\UserUpdatedNotification;
use Gate;

/**
 * UserController
 * -----------------------
 * Controller to handle the logic of the 'user' / 'author' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class UserController extends Controller {

    /**
     * Displays a list of all registered users.
     *
     * @return \Illuminate\View\View The page with a listing of all registered users.
     */
    public function index() {
        $users = User::paginate(config('portfolio.backend.pagination_entries_per_page'));

        return view('backend.user.index', compact('users'));
    }

    /**
     * Displays the profile page of the specified user.
     *
     * @param User $user The user to display.
     *
     * @return \Illuminate\View\View The profile page of the specified user.
     */
    public function show(User $user) {
        $user->load('tracks');
        return view('frontend.team.show', compact('user'));
    }

    /**
     * Shows the form to create a new user.
     *
     * @return \Illuminate\View\View The page to create a new user or the last page the user visited if the user has no
     *                               permission to create a new user.
     */
    public function create() {
        if (Gate::denies('store', User::class)) {
            return redirect()->back();
        }

        $user = new User();
        $isEditPage = false;

        return view('backend.user.edit', compact('user', 'isEditPage'));
    }

    /**
     * Displays the form the edit the specified user.
     *
     * @param User $user The user to edit.
     *
     * @return \Illuminate\View\View The page to edit the specified user.
     */
    public function edit(User $user) {
        if (Gate::denies('update', $user)) {
            return redirect()->back();
        }
        $isEditPage = true;

        return view('backend.user.edit', compact('user', 'isEditPage'));
    }

    /**
     * Stores a new user with the specified data in the database.
     *
     * @param UserCreateRequest $request The data to create a new user.
     *
     * @return \Illuminate\Http\JsonResponse The stored user.
     */
    public function store(UserCreateRequest $request) {
        if (Gate::denies('store', User::class)) {
            return redirect()->back();
        }

        $user = new User($request->all());

        $password = str_random(10);
        $user->password = $password;
        $user->save();

        if (!empty($user)) {
            \Mail::to($user->email)
                ->send(new RegistrationEmail($user, $password));

            \Notification::send(User::minManager()->get(), (new UserCreatedNotification($user, \Auth::user())));
        }

        return response()->json($user, empty($user) ? 500 : 200);
    }

    /**
     * Updates the specified user in the database.
     *
     * @param UserUpdateRequest $request The data to update the user.
     * @param User              $user    The user to update.
     *
     * @return \Illuminate\Http\JsonResponse The updated user.
     */
    public function update(UserUpdateRequest $request, User $user) {
        if (Gate::denies('update', $user)) {
            return redirect()->back();
        }

        $user->fill($request->toArray());
        $dirty = $user->getDirty();
        $success = $user->save();

        if ($success && count($dirty) > 0 && \Auth::user()->id != $user->id) {
            \Notification::send($user, (new UserUpdatedNotification($user, \Auth::user(), array_keys($dirty))));
        }

        return response()->json($user, $success ? 200 : 500);
    }

    /**
     * Deletes the specified user in the database.
     *
     * @param User $user The user to delete.
     *
     * @return \Illuminate\Http\JsonResponse {@code true} if the specified user was deleted successfully, {@code
     *                                       false} otherwise.
     */
    public function destroy(User $user) {
        if (Gate::denies('delete', $user)) {
            return redirect()->back();
        }

        $deleteSuccess = $user->delete();

        if ($deleteSuccess) {
            \Notification::send(User::minManager()->get(), (new UserDeletedNotification($user, \Auth::user())));
            return response()->json(true);
        } else {
            return response()->json(getJsonError(), 500);
        }
    }

    /**
     * Marks the unread notifications of the specified user as read and deletes the oldest notifications except
     * the newest five.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function markNotifications(User $user = null) {
        if (empty($user->id)) {
            if (!\Auth::check()) {
                return response()->json(false);
            }
            $user = \Auth::user();
        }
        $user->unreadNotifications->map(function ($notification) {
            $notification->markAsRead();
        });

        // Only keep 5 notifications per user in the db
        if (count($user->notifications) > 5) {
            DatabaseNotification::destroy($user->notifications()->limit(PHP_INT_MAX)->skip(5)->latest()->get()->pluck('id'));
        }

        return response()->json(true);
    }
}
