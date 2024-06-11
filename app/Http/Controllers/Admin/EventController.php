<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventAddRequest;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::query()->orderByDesc('created_at')->get();
        return view('admin.events.index', ['events' => $events]);
    }

    public function add()
    {
        return view('admin.events.add');
    }

    public function store(EventAddRequest $request)
    {
        $data = collect($request->validated())->except('event_images')->toArray();

        try {
            $event = Event::create($data);

            if ($request->event_images) {
                foreach($request->event_images as $image) {
                    $event->addMedia($image)->toMediaCollection('event-images');
                }
            }

            DB::commit();

            session()->flash('success', 'Event added successfully');
        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());
            DB::rollBack();
        }

        return redirect()->route('admin.events');
    }

    public function delete(Request $request)
    {
        $event = Event::findOrFail($request->id);

        $event->delete();

        session()->flash('success', 'Event deleted successfully');

        return redirect()->back();
    }
}
