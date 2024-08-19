<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Rank;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $data = Position::select();

        $search = request()->get('search', []);
        foreach ($search as $key => $value) {
            $data->where($key, 'like', '%' . $value . '%');
        }

        // tampilan
        return view('position.index', [
            'title' => 'Daftar Master Jabatan',
            'data' => $data->paginate()
        ]);
    }

    public function create()
    {
        return view('position.create');
    }

    public function store(Request $request)
    {
        $jabatan = Position::create([
            'name' => $request->name
        ]);

        if ($jabatan) {
            return redirect(auth()->user()->position()->first()->name . '/jabatan');
        } else {
            return redirect()->back()->with('success', 'sukses');
        }
    }

    public function edit($id)
    {
        $data = Position::findOrFail($id); // ambil data

        // tampil form edit data
        return view('position.edit', [
            'title' => 'Edit Data Jabatan ',
            'data' => $data
        ]);
    }

    public function update($id, Request $request)
    {
        $data = Position::findOrFail($id); // cari dulu data nya
        $data->name = $request->name ?? ''; // ganti dengan data baru
        $update = $data->save(); // simpan datanya

        if ($update) {
            return redirect('danramil/jabatan');
        } else {
            return redirect()->back()->with('success', 'sukses');
        }
    }

    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete(); // model dan proses hapus data

        return redirect()->back()->with('success', 'sukses'); // routing kembali
    }
}