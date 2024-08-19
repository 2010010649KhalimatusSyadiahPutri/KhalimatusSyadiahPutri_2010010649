<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PengelolaanDana;
use Barryvdh\DomPDF\Facade\Pdf;

class PengelolaanDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PengelolaanDana::select();
        $search = request()->get('search', []);
        foreach ($search as $key => $value) {
            $data->where($key, 'like', '%' . $value . '%');
        }

        if (request()->get('cetak', null) == 1) {
            $pdf = Pdf::loadView('pengelolaan_dana.pdf', ['data' => $data->get()]);
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream('cetak-pengelolaan-dana-' . Carbon::now()->format('Y-m-d') . '.pdf');
        }

        return view('pengelolaan_dana.index', [
            'title' => 'Pengelolaan Dana',
            'data' => $data->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengelolaan_dana.create', [
            'title' => 'Pengelolaan Dana',
            'data' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            PengelolaanDana::create([
                'tanggal' => $request->tanggal,
                'jenis' => $request->jenis,
                'keterangan' => $request->deskripsi,
                'nominal' => $request->nominal,
            ]);
            
            return redirect()->route(auth()->user()->position->name . '.pengelolaan-dana.index')->with('success', 'sukses');
        } catch (\Throwable $th) {
            throw $th;
        }
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
        return view('pengelolaan_dana.edit', [
            'title' => 'Ubah Data Pengelolaan Dana',
            'data' => PengelolaanDana::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        PengelolaanDana::findOrFail($id)->update([
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'keterangan' => $request->deskripsi,
            'nominal' => $request->nominal,
        ]);

        return redirect()->route(auth()->user()->position->name . '.pengelolaan-dana.index')->with('success', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PengelolaanDana::findOrFail($id)->delete();
        return redirect()->route(auth()->user()->position->name . '.pengelolaan-dana.index')->with('success', 'sukses');
    }
}
