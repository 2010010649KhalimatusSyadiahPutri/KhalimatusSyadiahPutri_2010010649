<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Operational;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OperasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data   = Operational::with('user')->select();
        $search = request('search', null);

        if ($search) {
            $data->where('description', 'like', '%' . $search . '%'); // berdasarkan deskripsinya

            $data->orWhere('type', 'like', '%' . $search . '%'); // berdasarkan jenis pemasukan

            $data->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }); // berdasarkan user nya
        }

        if (request()->get('cetak', null) == 1) {
            $pdf = Pdf::loadView('keuangan.operasional.cetak', ['data' => $data->get()]);
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream('cetak-laporan-pemasukan-' . Carbon::now()->format('Y-m-d') . '.pdf');
        }

        return view('keuangan.operasional.index', [
            'title' => 'Pengelolaan Dana Kegiatan',
            'data' => $data->simplePaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('keuangan.operasional.create', [
            'title' => 'Form Alokasi Dana Operasional'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Operational::create([
            'date' => $request->date,
            'type' => $request->type,
            'total' => $request->total,
            'description' => $request->description,
            'user_id' => $request->user_id ?? auth()->user()->id
        ]);

        return redirect()->route(auth()->user()->position->name . '.keuangan.operasional.index')->with('success', 'Sukses');
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
        return view('keuangan.operasional.edit', [
            'title' => 'Ubah Data',
            'data' => Operational::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Operational::findOrFail($id);
        $update->update([
            'date' => $request->date,
            'type' => $request->type,
            'total' => $request->total,
            'description' => $request->description,
            'user_id' => $request->user_id ?? auth()->user()->id
        ]);

        return redirect()->route(auth()->user()->position->name . '.keuangan.operasional.index')->with('success', 'Sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Operational::findOrFail($id);
        $data->delete();

        return redirect()->route(auth()->user()->position->name . '.keuangan.operasional.index')->with('success', 'Sukses');
    }

    /**
     * report the operation and outcome of the operation
     */
    public function report(string $id)
    {
        return view('keuangan.operasional.neraca', [
            'title' => 'Neraca',
            'data' => Operational::findOrFail($id),
        ]);
    }
}
