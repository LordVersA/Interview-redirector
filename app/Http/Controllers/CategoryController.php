<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $categories = Category::all();
        return view("category.index", ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('category.new', ['mode' => 'new']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();
        $category = new Category($data);
        Auth::user()->categories()->save($category);

        return redirect(route("category.index"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|Response
     */
    public function edit(Category $category)
    {
        return view('category.new', ['mode' => 'update', 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, int $id)
    {
        $category = Category::where('id', $id)->first();
//        dd($category);
        $category->update($request->validated());
        $category->save();
        return redirect(route("category.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}
