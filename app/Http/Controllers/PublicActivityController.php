<?php

namespace App\Http\Controllers;

use App\Models\PublicActivity;
use App\Models\PublicActivityAttachment;
use App\Models\PublicActivityHistory;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PublicActivity::select();
        $search = request()->get('search', []);
        foreach ($search as $key => $value) {
            $data->where($key, 'like', '%' . $value . '%');
        }

        if (request()->get('cetak', null) == 1) {
            $pdf = Pdf::loadView('public_activity.pdf', ['data' => $data->get()]);
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream('cetak-public-activity-' . Carbon::now()->format('Y-m-d') . '.pdf');
        }

        return view('public_activity.index', [
            'title' => 'Kegiatan Masyarakat',
            'data' => $data->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('public_activity.create', [
            'title' => 'Tambah Kegiatan Masyarakat',
            'data' => null,
            'officer' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $publicActivity         = PublicActivity::create($request->all());
        $publicActivityStatus   = PublicActivityHistory::create([
            'status' => $request->status,
            'public_activity_id' => $publicActivity->id,
        ]);

        foreach (($request->attachments ?? []) as $attachment) {

            $path = $attachment->store('public-activity-attachment', 'public');

            PublicActivityAttachment::create([
                'path' => $path,
                'public_activity_history_id' => $publicActivityStatus->id,
                'public_activity_id' => $publicActivity->id,
            ]);

        }

        return redirect()->route(auth()->user()->position->name . '.public-activity.index')->with('success', 'sukses');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('public_activity.edit', [
            'title' => 'Ubah Kegiatan Masyarakat',
            'data' => PublicActivity::findOrFail($id),
            'officer' => User::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $publicActivity = PublicActivity::findOrFail($id)->update($request->all());
        return redirect()->route(auth()->user()->position->name . '.public-activity.index')->with('success', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publicActivity = PublicActivity::findOrFail($id)->delete();
        return redirect()->route(auth()->user()->position->name . '.public-activity.index')->with('success', 'sukses');
    }

    public function updateStatus(Request $request)
    {
        $publicActivity = PublicActivity::findOrFail($request->activity_id);
        $publicActivityStatus   = PublicActivityHistory::create([
            'status' => $request->status,
            'public_activity_id' => $publicActivity->id,
        ]);

        foreach ($request->attachments as $attachment) {

            $path = $attachment->store('public-activity-attachment', 'public');

            PublicActivityAttachment::create([
                'path' => $path,
                'public_activity_history_id' => $publicActivityStatus->id,
                'public_activity_id' => $publicActivity->id,
            ]);

        }

        return redirect()->route(auth()->user()->position->name . '.public-activity.index')->with('success', 'sukses');
    }

    public function deleteAttachment($id)
    {
        $attachment = PublicActivityAttachment::findOrFail($id);
        $attachment->delete();
        return redirect()->back()->with('success', 'sukses');
    }
}
