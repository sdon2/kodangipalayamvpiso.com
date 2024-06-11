<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementAddRequest;
use App\Http\Requests\AnnouncementEditRequest;
use App\Models\Announcement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::query()->orderByDesc('created_at')->get();
        return view('admin.announcements.index', ['announcements' => $announcements]);
    }

    public function add()
    {
        return view('admin.announcements.add');
    }

    public function store(AnnouncementAddRequest $request)
    {
        $data = collect($request->validated())->except('announcement_file')->toArray();

        try {
            $announcement = Announcement::create($data);

            if ($request->announcement_file) {
                $announcement->addMedia($request->announcement_file)->toMediaCollection('announcement-files');
            }

            DB::commit();

            session()->flash('success', 'Announcement added successfully');
        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());
            DB::rollBack();
        }

        return redirect()->route('admin.announcements');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.announcements.edit', ['announcement' => $announcement]);
    }

    public function update($id, AnnouncementEditRequest $request)
    {
        $announcement = Announcement::findOrFail($id);

        $data = collect($request->validated())->except('announcement_file')->toArray();

        try {

            $announcement->update($data);

            if ($request->announcement_file) {
                $announcement->addMedia($request->announcement_file)->toMediaCollection('announcement-files');
            }

            DB::commit();

            session()->flash('success', 'Announcement updated successfully');
        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());
            DB::rollBack();
        }

        return redirect()->route('admin.announcements');
    }

    public function delete(Request $request)
    {
        $announcement = Announcement::findOrFail($request->id);

        $announcement->delete();

        session()->flash('success', 'Announcement deleted successfully');

        return redirect()->back();
    }

    public function removeAttachment($id)
    {
        $announcement = Announcement::findOrFail($id);

        if ($announcement->hasMedia('announcement-files')) {
            $announcement->getMedia('announcement-files')->first()->delete();
        }

        return response(['message' => 'Announcement updated successfuly']);
    }
}
