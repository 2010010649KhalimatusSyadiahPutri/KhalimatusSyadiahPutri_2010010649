<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    public function index()
    {
        $pangkat = Rank::select();

        $search = request()->get('search', []);
        foreach ($search as $key => $value) {
            $pangkat->where($key, 'like', '%' . $value . '%');
        }

        return view('pangkat.index', [
            'title' => 'Daftar Master Pangkat',
            'data' => $pangkat->paginate()
        ]);
    }

    public function create()
    {
        return view('pangkat.create', [
            'title' => 'Tambah Data Pangkat',
            'data' => null
        ]);
    }

    public function store(Request $request)
    {
        Rank::create($request->all());
        return redirect()->route('admin.rank.index')->with('success', 'sukses');
    }

    public function edit($id)
    {
        return view('pangkat.edit', [
            'title' => 'Edit Data Pangkat',
            'data' => Rank::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        Rank::findOrFail($id)->update($request->all());
        return redirect()->route('admin.rank.index')->with('success', 'sukses');
    }

    public function destroy($id)
    {
        Rank::findOrFail($id)->delete();
        return redirect()->route('admin.rank.index')->with('success', 'sukses');
    }
}