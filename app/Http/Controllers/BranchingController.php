<?php

namespace App\Http\Controllers;

use App\Models\Branching;
use Illuminate\Http\Request;

class BranchingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Branching::select();
        $search = request()->get('search', []);
        foreach ($search as $key => $value) {
            $data->where($key, 'like', '%' . $value . '%');
        }

        return view('branching.index', [
            'title' => 'Daftar Master Kecabangan',
            'data' => $data->simplePaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branching.create', [
            'title' => 'Tambah Data Kecabangan',
            'data' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Branching::create($request->all());
        return redirect()->route('admin.branching.index')->with('success', 'sukses');
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
        return view('branching.edit', [
            'title' => 'Edit Data Kecabangan',
            'data' => Branching::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Branching::findOrFail($id)->update($request->all());
        return redirect()->route('admin.branching.index')->with('success', 'sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Branching::findOrFail($id)->delete();
        return redirect()->route('admin.branching.index')->with('success', 'sukses');
    }
}