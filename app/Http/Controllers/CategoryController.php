<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Album;
use App\Models\Category;
use App\Models\Track;
use App\Models\User;
use App\Notifications\CategoryCreatedNotification;
use App\Notifications\CategoryDeletedNotification;
use App\Notifications\CategoryUpdatedNotification;
use Auth;
use Gate;
use Illuminate\Http\Request;

/**
 * CategoryController
 * -----------------------
 * Controller to handle the logic for the 'category' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class CategoryController extends Controller {

    /**
     * Display a listing of the categories.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View The index page of the categories.
     */
    public function index(Request $request) {
        $entries_count = $request->get('entries_count') ?? 10;

        $categories = Category::search($request->get('search'))
                              ->sortable(['created_at' => 'desc'])
                              ->paginate($entries_count);

        $newCategoryNotifications = \Auth::user()->unreadNotifications()->where('type',
            CategoryCreatedNotification::class)->get();
        $newCategoryKeys = $newCategoryNotifications->pluck('data.key');

        foreach ($newCategoryNotifications as $newCategoryNotification) {
            $newCategoryNotification->markAsRead();
        }

        return view('backend.category.index', compact('categories', 'newCategoryKeys', 'entries_count'));
    }

    /**
     * Displays the details page of the specified category.
     *
     * @param Category $category The category to show the detail page.
     *
     * @return \Illuminate\View\View The details page of the specified album.
     */
    public function show(Category $category) {
        $tracks = Track::with('categories')->get();
        $categories = Category::all();
        $albums = Album::all();

        return view('frontend.track.index', compact('tracks', 'categories', 'category', 'albums'));
    }

    /**
     * Shows the form for creating a new category.
     *
     * @return \Illuminate\View\View The create page for a new category.
     */
    public function create() {
        if (Gate::denies('store', Category::class)) {
            return redirect()->back();
        }

        return $this->showEditForm(new Category());
    }

    /**
     * Stores a new category with the specified data in the database.
     *
     * @param CategoryCreateRequest $request The data to create a new category.
     *
     * @return \Illuminate\Http\JsonResponse The stored category.
     */
    public function store(CategoryCreateRequest $request) {
        if (Gate::denies('store', Category::class)) {
            return redirect()->back();
        }

        $category = new Category();
        $category->fill($request->toArray())->save();
        $success = $category->save();

        if ($success) {
            \Notification::send(User::ignore(Auth::id())->get(), (new CategoryCreatedNotification($category, Auth::user())));
        }

        return response()->json($category, $success ? 200 : 500);
    }

    /**
     * Shows the form for editing the specified category.
     *
     * @param Category $category The category to edit.
     *
     * @return \Illuminate\View\View The category edit page.
     */
    public function edit(Category $category) {
        if (Gate::denies('update', $category)) {
            return redirect()->back();
        }

        return $this->showEditForm($category, true);
    }

    private function showEditForm(Category $category, $isEditPage = false) {
        return view('backend.category.edit', compact('category', 'isEditPage'));
    }

    /**
     * Updates the specified category with the data from the specified request.
     *
     * @param CategoryCreateRequest $request  The data to update the specified category.
     * @param Category              $category The category to update.
     *
     * @return \Illuminate\Http\JsonResponse The updated category.
     */
    public function update(CategoryCreateRequest $request, Category $category) {
        if (Gate::denies('update', $category)) {
            return redirect()->back();
        }

        $category->fill($request->all());
        $dirty = $category->getDirty();
        $success = $category->save();

        if ($success && count($dirty) > 0) {
            \Notification::send(User::ignore(Auth::id())->get(),
                (new CategoryUpdatedNotification($category, Auth::user(), array_keys($dirty))));
        }

        return response()->json($category);
    }

    /**
     * Deletes the specified category.
     *
     * @param Category $category The category to delete.
     *
     * @return \Illuminate\Http\JsonResponse {@code true} if the specified category was deleted successfully, {@code
     *                                       false} otherwise.
     */
    public function destroy(Category $category) {
        if (Gate::denies('delete', $category)) {
            return redirect()->back();
        }

        $deleteSuccess = $category->delete();

        if ($deleteSuccess) {
            \Notification::send(User::ignore(Auth::id())->get(), (new CategoryDeletedNotification($category, Auth::user())));

            return response()->json(true);
        } else {
            return response()->json(getJsonError(), 500);
        }
    }
}
