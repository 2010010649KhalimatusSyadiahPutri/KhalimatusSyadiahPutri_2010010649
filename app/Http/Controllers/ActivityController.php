<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data   = Activity::with('user')->select();
        $search = request('search', false);

        if ($search) {
            $data->where('description', 'like', '%' . $search . '%');

            $data->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        if (request()->get('cetak', null) == 1) {
            $pdf = Pdf::loadView('activity.cetak', ['data' => $data->get()]);
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream('cetak-laporan-aktivitas-' . Carbon::now()->format('Y-m-d') . '.pdf');
        }

        return view('activity.index', [
            'title' => 'Kegiatan Petugas',
            'data' => $data->simplePaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activity.form-create', [
            'title' => 'Form Tambah Kegiatan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $imageName  = time() . '_' . $request->image->getClientOriginalName();
            $filePath   = $request->file('image')->storeAs('activity', $imageName, 'public');
        }

        Activity::create([
            'date' => $request->date,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $filePath ?? null,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route(auth()->user()->position->name . '.activity.index')->with('success', 'Sukses');
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
        return view('activity.edit', [
            'title' => 'Ubah Kegiatan',
            'data' => Activity::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->hasFile('image')) {
            $imageName  = time() . '_' . $request->image->getClientOriginalName();
            $filePath   = $request->file('image')->storeAs('activity', $imageName, 'public');
        }

        $data = Activity::findOrFail($id);

        $data->update([
            'date' => $request->date,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $filePath ?? null,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route(auth()->user()->position->name . '.activity.index')->with('success', 'Sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Activity::findOrFail($id);
        $data->delete();

        return redirect()->route(auth()->user()->position->name . '.activity.index')->with('success', 'Sukses');
    }
}
