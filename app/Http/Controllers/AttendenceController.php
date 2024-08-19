<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Attendence::select();
        if (auth()->user()->position->name != 'admin') {
            $data->where('anggota_id', auth()->user()->id);
        }

        if (request()->get('cetak', null) == 1) {
            $pdf = Pdf::loadView('attendence.pdf', ['data' => $data->get()]);
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream('cetak-laporan-kehadiran-' . Carbon::now()->format('Y-m-d') . '.pdf');
        }

        return view('attendence.index', [
            'title' => 'Daftar Kehadiran Petugas',
            'data' => $data->orderBy('created_at', 'desc')->simplePaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attendence.create', [
            'title' => 'Absensi',
            'data' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attendence = Attendence::create($request->only('status', 'notes', 'anggota_id'));
        return redirect()->route(auth()->user()->position->name . '.absensi.index')->with('sucess', 'sukses');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
