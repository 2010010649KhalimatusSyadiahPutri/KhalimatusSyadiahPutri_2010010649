<?php

namespace App\Http\Controllers;

use App\Models\PendataanKegiatan;
// use App\Models\Officer;
use App\Models\AssignmentArea;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PendataanKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PendataanKegiatan::select();
        $search = request()->get('search', []);
        foreach ($search as $key => $value) {
            $data->where($key, 'like', '%' . $value . '%');
        }

        if (request()->get('cetak', null) == 1) {
            $pdf = Pdf::loadView('pendataan_kegiatan.pdf', ['data' => $data->get()]);
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream('cetak-pendataan-kegiatan-' . Carbon::now()->format('Y-m-d') . '.pdf');
        }

        return view('pendataan_kegiatan.index', [
            'title' => 'Pendataan Kegiatan',
            'data' => $data->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pendataan_kegiatan.create', [
            'title' => 'Tambah Kegiatan',
            'data' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PendataanKegiatan::create([
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'user_id' => $request->user_id ?? auth()->user()->id
        ]);

        return redirect()->route(auth()->user()->position->name . '.pendataan-kegiatan.index')->with('success', 'sukses');
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
    // public function edit(string $id)
    // {
    //         return view('pendataan_kegiatan.edit', [
    //         'title' => 'Ubah Kegiatan',
    //         'data' => PendataanKegiatan::findOrFail($id),
    //     ]);
    // }

    public function edit(string $id)
    {
        // Ambil data kegiatan berdasarkan ID
        $data = PendataanKegiatan::findOrFail($id);
    
        // Ambil semua data officer
        // $officer = Officer::all(); // Sesuaikan dengan nama model Officer Anda
    
        // Kirimkan data kegiatan dan data officer ke view
        return view('pendataan_kegiatan.edit', [
            'title' => 'Ubah Kegiatan',
            'data' => $data,
            // 'officer' => $officer, // Tambahkan variabel officer
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        PendataanKegiatan::findOrFail($id)->update([
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'user_id' => $request->user_id ?? auth()->user()->id
        ]);

        return redirect()->route(auth()->user()->position->name . '.pendataan-kegiatan.index')->with('success', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PendataanKegiatan::findOrFail($id)->delete();
        return redirect()->route(auth()->user()->position->name . '.pendataan-kegiatan.index')->with('success', 'sukses');
    }
}