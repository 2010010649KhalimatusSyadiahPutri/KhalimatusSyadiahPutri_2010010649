<?php

namespace App\Http\Controllers;

use App\Models\OutcomingLetter;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OutComingLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = OutcomingLetter::select();
        $search = request()->get('search', []);
        foreach ($search as $key => $value) {
            $data->where($key, 'like', '%' . $value . '%');
        }

        if (request()->get('cetak', null) == 1) {
            $pdf = Pdf::loadView('outcoming.pdf', ['data' => $data->get()]);
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream('cetak-agenda-sura-keluar-' . Carbon::now()->format('Y-m-d') . '.pdf');
        }

        return view('outcoming.index', [
            'title' => 'Kelola Surat Keluar',
            'data' => $data->simplePaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('outcoming.create', [
            'title' => 'Tambah Surat Keluar',
            'data' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $outcoming = OutcomingLetter::create($request->all());
        return redirect()->route(auth()->user()->position->name . '.outcoming-letter.index')->with('success', 'sukses');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = OutcomingLetter::findOrFail($id);

        if (request()->get('cetak', null) == 1) {
            $pdf = Pdf::loadView('outcoming.letter', ['data' => $data]);
            $pdf->setPaper('A4');
            return $pdf->stream('cetak-surat-keluar-' . $data->reference_number . '.pdf');
        }

        return view('outcoming.show', [
            'title' => 'Kelola Surat Keluar',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('outcoming.edit', [
            'title' => 'Ubah Surat Keluar',
            'data' => OutcomingLetter::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        OutcomingLetter::findOrFail($id)->update($request->all());
        return redirect()->route(auth()->user()->position->name . '.outcoming-letter.index')->with('success', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $outcoming = OutcomingLetter::find($id)->delete();
        return redirect()->back()->with('success', 'sukses');
    }
}
