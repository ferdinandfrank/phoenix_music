<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsUpdateRequest;
use App\Models\Settings;
use App\Models\User;
use App\Notifications\SettingsUpdatedNotification;
use Auth;
use Gate;

/**
 * SettingsController
 * -----------------------
 * Controller to handle the logic for the 'settings' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class SettingsController extends Controller {

    /**
     * Displays the settings page.
     *
     * @return \Illuminate\View\View The settings page.
     */
    public function index() {
        if (Gate::denies('update', Settings::class)) {
            return redirect()->back();
        }

        $settingsData = Settings::all();
        $settings = [];
        foreach ($settingsData as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        return view('backend.settings.index', compact('settings'));
    }

    /**
     * Updates the specified page settings in the database.
     *
     * @param SettingsUpdateRequest $request The settings data to update.
     *
     * @return \Illuminate\Http\JsonResponse {@code true} if the update was successful, {@code false} otherwise.
     */
    public function update(SettingsUpdateRequest $request) {
        if (Gate::denies('update', Settings::class)) {
            return redirect()->back();
        }

        $success = Settings::updateAll($request->all());

        if ($success) {
            \Notification::send(User::ignore(Auth::id())->get(), (new SettingsUpdatedNotification(Auth::user())));
        }

        return response()->json($success, $success ? 200 : 500);
    }
}
