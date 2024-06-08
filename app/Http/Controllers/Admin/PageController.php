<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPageRequest;
use App\Http\Requests\EditPageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::query()->orderByDesc('created_at')->get();
        return view('admin.pages.index', ['pages' => $pages]);
    }

    public function add()
    {
        return view('admin.pages.add');
    }

    public function store(AddPageRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::user()->id;

        Page::create($data);

        return response(['message' => 'Page created successfuly']);
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', ['page' => $page]);
    }

    public function update(EditPageRequest $request)
    {
        $data = $request->validated();

        $page = Page::findOrFail($request->id);

        $page->update($data);

        return response(['message' => 'Page updated successfuly']);
    }

    public function delete(Request $request)
    {
        $page = Page::findOrFail($request->id);

        $page->delete();

        session()->flash('success', 'Page deleted successfully');

        return redirect()->back();
    }
}
