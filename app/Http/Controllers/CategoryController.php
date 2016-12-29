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

class CategoryController extends Controller {

    public function show(Category $category) {
        $tracks = Track::with('categories')->get();
        $categories = Category::all();
        $albums = Album::all();

        return view('frontend.track.index', compact('tracks', 'categories', 'category', 'albums'));
    }

    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\View\View The index page of the categories.
     */
    public function index() {
        $categories = Category::paginate(config('portfolio.backend.pagination_entries_per_page'));

        return view('backend.category.index', compact('categories'));
    }

    /**
     * Shows the form for creating a new category.
     *
     * @return \Illuminate\View\View The create page for a new category.
     */
    public function create() {
        $category = new Category();
        $isEditPage = false;

        return view('backend.category.edit', compact('category', 'isEditPage'));
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
            \Notification::send(User::all(), (new CategoryCreatedNotification($category, Auth::user())));
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
        $isEditPage = true;

        return view('backend.category.edit', compact('category', 'isEditPage'));
    }

    /**
     * Updates the specified category with the data from the specified request.
     *
     * @param CategoryUpdateRequest $request  The data to update the specified category.
     * @param Category              $category The category to update.
     *
     * @return \Illuminate\Http\JsonResponse The updated category.
     */
    public function update(CategoryUpdateRequest $request, Category $category) {
        if (Gate::denies('update', $category)) {
            return redirect()->back();
        }

        $category->fill($request->all());
        $dirty = $category->getDirty();
        $success = $category->save();

        if ($success && count($dirty) > 0) {
            \Notification::send(User::all(), (new CategoryUpdatedNotification($category, Auth::user(), array_keys($dirty))));
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
            \Notification::send(User::all(), (new CategoryDeletedNotification($category, Auth::user())));
            return response()->json(true);
        } else {
            return response()->json(getJsonError(), 500);
        }
    }
}
