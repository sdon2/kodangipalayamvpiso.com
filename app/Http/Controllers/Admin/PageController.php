<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageAddRequest;
use App\Http\Requests\PageEditRequest;
use App\Models\Page;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function store(PageAddRequest $request)
    {
        $data = collect($request->validated())->except('featured_image')->toArray();

        $data['user_id'] = Auth::user()->id;

        DB::beginTransaction();

        try {
            $page = Page::create($data);

            if ($image = $request->featured_image) {
                $page->addMedia($image)->toMediaCollection('featured-images');
            }

            DB::commit();

            $response = ['message' => 'Page added successfully'];
        } catch (Exception $ex) {
            DB::rollBack();

            $response = ['error', $ex->getMessage()];
        }

        return response($response);
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', ['page' => $page]);
    }

    public function update(PageEditRequest $request)
    {
        $data = collect($request->validated())->except('featured_image')->toArray();

        $page = Page::findOrFail($request->id);

        try {

            $page->update($data);

            if ($image = $request->featured_image) {
                $page->clearMediaCollection('featured-images');
                $page->addMedia($image)->toMediaCollection('featured-images');
            }

            DB::commit();

            $response = ['message' => 'Page updated successfully'];
        } catch (Exception $ex) {
            DB::rollBack();

            $response = ['error', $ex->getMessage()];
        }

        return response($response);
    }

    public function delete(Request $request)
    {
        $page = Page::findOrFail($request->id);

        $page->delete();

        session()->flash('success', 'Page deleted successfully');

        return redirect()->back();
    }

    public function removeImage($id)
    {
        $page = Page::findOrFail($id);

        if ($page->hasMedia('featured-images')) {
            $page->getMedia('featured-images')->first()->delete();
        }

        return response(['message' => 'Image deleted successfuly']);
    }
}
