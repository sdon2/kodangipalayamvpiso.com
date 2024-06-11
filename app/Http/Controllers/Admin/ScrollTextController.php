<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScrollText;
use Illuminate\Http\Request;

class ScrollTextController extends Controller
{
    public function index(Request $request)
    {
        $scroll_texts = ScrollText::query()->orderByDesc('created_at')->get();
        return view('admin.scroll-texts.index', ['scroll_texts' => $scroll_texts]);
    }

    public function add()
    {
        return view('admin.scroll-texts.add');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['scroll_text' => ['required']]);

        ScrollText::create($data);

        return response(['message' => 'Scroll text created successfuly']);
    }

    public function delete(Request $request)
    {
        $scroll_text = ScrollText::query()->findOrFail($request->id);

        $scroll_text->delete();

        session()->flash('success', 'Scroll text deleted successfully');
        return redirect()->back();
    }
}
