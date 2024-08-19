<?php

namespace App\Http\Controllers;

use App\Models\AssignmentArea;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\District;

class AssignmentAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $data   = AssignmentArea::select();
    //     $search = request('search', false);
    //     if ($search) {
    //         $data->whereHas('anggota', function ($query) use ($search) {
    //             $query->where('name', 'like', '%' . $search . '%');
    //         })->orwhereHas('district', function ($query) use ($search) {
    //             $query->where('name', 'like', '%' . $search . '%');
    //         });
    //     }

    //     if (request()->get('cetak', null) == 1) {
    //         $pdf = Pdf::loadView('assignment_area.pdf', ['data' => $data->get()]);
    //         $pdf->setPaper('A4', 'Landscape');
    //         return $pdf->stream('cetak-laporan-penugasan-' . Carbon::now()->format('Y-m-d') . '.pdf');
    //     }

    //     return view('assignment_area.index', [
    //         'title' => 'Data Penugasan Petugas',
    //         'data' => $data->simplePaginate()
    //     ]);
    // }
    public function index(Request $request)
{
    $data = AssignmentArea::query();
    $search = $request->get('search', false);
    $year = $request->get('year', false); // Ambil parameter tahun

    // Pencarian berdasarkan kata kunci
    if ($search) {
        $data->whereHas('anggota', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->orWhereHas('district', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }

    // Filter berdasarkan tahun
    if ($year) {
        $data->whereYear('created_at', $year);
    }

    // Cek jika request untuk cetak laporan
    if ($request->get('cetak', null) == 1) {
        $pdf = Pdf::loadView('assignment_area.pdf', ['data' => $data->get()]);
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->stream('cetak-laporan-penugasan-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    return view('assignment_area.index', [
        'title' => 'Data Penugasan Petugas',
        'data' => $data->simplePaginate(),
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assignment_area.create', [
            'title' => 'Tambah Data Wilayah Penugasan',
            'data' => null,
            'districts' => District::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        AssignmentArea::create($request->all());
        return redirect()->route(auth()->user()->position->name . '.assignment-area.index')->with('success', 'Sukses');
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
        return view('assignment_area.edit', [
            'title' => 'Edit Data Wilayah Penugasan',
            'data' => AssignmentArea::findOrFail($id),
            'districts' => District::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        AssignmentArea::findOrFail($id)->update($request->all());
        return redirect()->route(auth()->user()->position->name . '.assignment-area.index')->with('success', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AssignmentArea::findOrFail($id)->delete();
        return redirect()->route(auth()->user()->position->name . '.assignment-area.index')->with('success', 'sukses');
    }
}