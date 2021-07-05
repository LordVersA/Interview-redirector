<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkStoreRequest;
use App\Http\Requests\LinkUpdateRequest;
use App\Models\Category;
use App\Models\Link;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $links = Link::all();
        return view("dashboard.index", ['links' => $links, "is_category" => false]);
    }


    public function create()
    {
        $categories = Category::all();
        return view("dashboard.new", ['categories' => $categories, "mode" => "new"]);
    }


    public function store(LinkStoreRequest $request)
    {
        $data = $request->validated();

        $is_active = false;
        if (isset($data['is_active']))
            $is_active = true;

        $link = new Link([
            'link' => $data['link'],
            'label' => $data['label'],
            "status_code" => $data['status_code'],
            'category_id' => $data['category'],
            'is_active' => $is_active
        ]);

        Auth::user()->links()->save($link);
        return redirect(route("link.index"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Link $link
     * @return View
     */
    public function edit(Link $link): View
    {
        $categories = Category::all();
        return view("dashboard.new", ['link' => $link, "categories" => $categories, "mode" => "update"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(LinkUpdateRequest $request, int $id)
    {
        $data = $request->validated();
        $is_active = false;
        if (isset($data['is_active']))
            $is_active = true;
        $data['is_active'] = $is_active;

        $link = Link::where("id", $id)->first();
        $link->fill($data);
        $link->is_active = $is_active;
        $link->save();

        return redirect(route("link.index"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Link $link
     * @return RedirectResponse
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return back();
    }

    public function redirect($params)
    {
        $link = Link::where('label', $params)->first();
        if ($link->is_active) {
            header('Location: ' . $link->link, true, $link->status_code);
            $link->increment('click_count', 1);
        } else {
            return "<h1>Link Is Not Active</h1>";
        }

    }

    public function getByCategory($label)
    {
        $category = Category::where('label', $label)->first();
        return view("dashboard . index", ['links' => $category->links, "is_category" => true]);

    }

}
