<?php

namespace App\Http\Controllers;

use App\Models\OfficerFacility;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OfficerFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $data = OfficerFacility::query();

    // Filter berdasarkan kata kunci (search)
    $search = $request->get('search', []);
    foreach ($search as $key => $value) {
        $data->where($key, 'like', '%' . $value . '%');
    }

    // Filter berdasarkan tahun
    if ($request->has('year') && $request->year != '') {
        $data->whereYear('created_at', $request->year);
    }

    // Filter berdasarkan tipe fasilitas
    if ($request->has('facility_type') && $request->facility_type != '') {
        $data->where('facility_type', $request->facility_type);
    }

    // Cek jika pencetakan PDF diminta
    if ($request->get('cetak', null) == 1) {
        $pdf = Pdf::loadView('facility_officer.pdf', ['data' => $data->get()]);
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->stream('cetak-laporan-facility-officer-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    // Paginate dan kembalikan ke view
    return view('facility_officer.index', [
        'title' => 'Data Fasilitas Petugas',
        'data' => $data->simplePaginate(10)
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('facility_officer.create', [
            'title' => 'Tambah Data Fasilitas Petugas',
            'data' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     foreach ($request->officer_id as $key => $value) {
    //         OfficerFacility::create([
    //             'type' => $request->type,
    //             'name' => $request->name,
    //             'description' => $request->description,
    //             'quantity' => $request->quantity,
    //             'maintenance_time' => $request->maintenance_time,
    //             'condition' => $request->condition,
    //             'officer_id' => $value,

    //         ]);
    //     }

    //     return redirect()->route(auth()->user()->position->name . '.facility-officer.index')->with('success', 'sukses');
    // }

    public function store(Request $request)
{
    $data = $request->validate([
        'type' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'quantity' => 'required|integer',
        'condition' => 'required|string',
        'maintenance_time' => 'required|date',
        'officer_id' => 'required|array',
        'image' => 'nullable', // Validasi untuk file gambar
    ]);

    // Proses upload file
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('facility_images', 'public');
    }

    // Simpan data fasilitas
    $facility = FacilityOfficer::create($data);

    // Relasi ke officer (jika ada)
    $facility->officers()->sync($request->officer_id);

    return redirect()->route('admin.facility-officer.index')->with('success', 'Data Fasilitas berhasil ditambahkan!');
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
        return view('facility_officer.edit', [
            'title' => 'Ubah Data Fasilitas Petugas',
            'data' => OfficerFacility::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->hasFile('image')) {
            $imageName  = time() . '_' . $request->image->getClientOriginalName();
            $filePath   = $request->file('image')->storeAs('facility', $imageName, 'public');
        }

        OfficerFacility::findOrFail($id)->update([
            'type' => $request->type,
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'maintenance_time' => $request->maintenance_time,
            'condition' => $request->condition,
            'officer_id' => $request->officer_id,
            'image' => $filePath
        ]);

        return redirect()->route(auth()->user()->position->name . '.facility-officer.index')->with('success', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        OfficerFacility::findOrFail($id)->delete();
        return redirect()->route(auth()->user()->position->name . '.facility-officer.index')->with('success', 'sukses');
    }
}