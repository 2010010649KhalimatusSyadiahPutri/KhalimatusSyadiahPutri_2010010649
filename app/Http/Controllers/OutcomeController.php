<?php

namespace App\Http\Controllers;

use App\Models\Operational;
use Carbon\Carbon;
use App\Models\Outcome;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OutcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data   = Outcome::with(['user', 'sumber_dana'])->select();
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
            return $pdf->stream('cetak-laporan-pengeluaran-' . Carbon::now()->format('Y-m-d') . '.pdf');
        }

        return view('keuangan.pengeluaran.index', [
            'title' => 'Laporan Pengeluaran Operasional',
            'data' => $data->simplePaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $operasional = Operational::select();
        if (auth()->user()->position->name != 'admin') {
            $operasional->where('user_id', auth()->user()->id);
        }

        return view('keuangan.pengeluaran.create', [
            'title' => 'Tambah Pengeluaran Operasional',
            'data' => null,
            'operasional' => $operasional->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('report')) {
            $imageName  = time() . '_' . $request->report->getClientOriginalName();
            $filePath   = $request->file('report')->storeAs('outcome', $imageName, 'public');
        }
        
        Outcome::create([
            'date' => $request->date ?? Carbon::now()->format('Y-m-d'),
            'type' => $request->type,
            'total' => $request->total,
            'description' => $request->description,
            'report' => $filePath ?? null,
            'operational_id' => $request->operational_id,
            'user_id' => $request->user_id ?? auth()->user()->id
        ]);

        return redirect()->route(auth()->user()->position->name . '.keuangan.pengeluaran.index')->with('success', 'Sukses');
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
        $operasional = Operational::select();
        if (auth()->user()->position->name != 'admin') {
            $operasional->where('user_id', auth()->user()->id);
        }

        return view('keuangan.pengeluaran.edit', [
            'title' => 'Ubah Pengeluaran Operasional',
            'data' => Outcome::findOrFail($id),
            'operasional' => $operasional->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->hasFile('report')) {
            $imageName  = time() . '_' . $request->report->getClientOriginalName();
            $filePath   = $request->file('report')->storeAs('outcome', $imageName, 'public');
        }
        
        $update = Outcome::findOrFail($id); 
        $update->update([
            'date' => $request->date,
            'type' => $request->type,
            'total' => $request->total,
            'description' => $request->description,
            'report' => $filePath ?? null,
            'operational_id' => $request->operational_id,
            'user_id' => $request->user_id ?? auth()->user()->id
        ]);

        return redirect()->route(auth()->user()->position->name . '.keuangan.pengeluaran.index')->with('success', 'Sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Outcome::findOrFail($id);
        $data->delete();

        return redirect()->route(auth()->user()->position->name . '.keuangan.pengeluaran.index')->with('success', 'Sukses');
    }
}
