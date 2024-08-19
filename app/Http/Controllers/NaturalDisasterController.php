<?php

namespace App\Http\Controllers;

use App\Models\NaturalDisaster;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NaturalDisasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = NaturalDisaster::select();
        $search = request()->get('search', []);
        foreach ($search as $key => $value) {
            $data->where($key, 'like', '%' . $value . '%');
        }

        if (request()->get('cetak', null) == 1) {
            $pdf = Pdf::loadView('natural_disaster.pdf', ['data' => $data->get()]);
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream('cetak-laporan-penugasan-' . Carbon::now()->format('Y-m-d') . '.pdf');
        }

        return view('natural_disaster.index', [
            'title' => 'Bencana Alam',
            'data' => $data->simplePaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('natural_disaster.create', [
            'title' => 'Tambah Bencana Alam',
            'data' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $disaster = NaturalDisaster::create($request->all());
        return redirect()->route(auth()->user()->position->name . '.natural-disaster.index')->with('success', 'sukses');
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
        return view('natural_disaster.edit', [
            'title' => 'Ubah Bencana Alam',
            'data' => NaturalDisaster::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $disaster = NaturalDisaster::findOrFail($id)->update($request->all());
        return redirect()->route(auth()->user()->position->name . '.natural-disaster.index')->with('success', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $disaster = NaturalDisaster::findOrFail($id)->delete();
        return redirect()->route(auth()->user()->position->name . '.natural-disaster.index')->with('success', 'sukses');
    }
}
