<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::query()->orderByDesc('created_at')->get();
        return view('admin.sliders.index', ['sliders' => $sliders]);
    }

    public function add()
    {
        return view('admin.sliders.add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slider_name' => ['required', 'unique:sliders,slider_name'],
            'images' => ['required', 'array'],
            'images.*' => ['required', 'file', 'mimes:png,jpg,jpeg']
        ]);

        DB::beginTransaction();

        try {
            $slider = Slider::create(collect($data)->except('images')->toArray());

            foreach ($request->images as $image) {
                $slider->addMedia($image)->toMediaCollection('sliders');
            }

            DB::commit();

            session()->flash('success', 'Slider added successfully');
        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());
            DB::rollBack();
        }


        return redirect()->route('admin.sliders');
    }

    public function delete(Request $request)
    {
        $slider = Slider::findOrFail($request->id);

        $slider->delete();

        session()->flash('success', 'Slider deleted successfully');

        return redirect()->back();
    }
}
