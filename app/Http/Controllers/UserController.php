<?php

namespace App\Http\Controllers;

use App\Exports\AnggotaExport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    // Menampilkan daftar anggota
    public function index(Request $request)
    {
        $data = User::with(['position', 'rank', 'branching'])->select();
        $search = $request->get('search', []);

        foreach ($search as $key => $value) {
            $data->where($key, 'like', '%' . $value . '%');
        }

        return view('anggota.index', [
            'title' => 'Daftar Anggota',
            'data' => $data->paginate()
        ]);
    }

    // Menampilkan form tambah anggota
    public function create()
    {
        return view('anggota.form-create', [
            'title' => 'Form Tambah Anggota'
        ]);
    }

    // Menyimpan data anggota baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'rank_id' => 'required',
            'position_id' => 'required'
        ], [
            'email.unique' => 'Email Telah Digunakan'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'fullname' => $request->fullname,
            'rank_id' => $request->rank_id,
            'position_id' => $request->position_id,
            'nrp' => $request->nrp,
            'phone_number' => $request->phone_number,
            'branching_id' => $request->branching_id
        ]);

        return redirect(route('admin.anggota.index'))->with('berhasil', 'Anggota Berhasil Ditambahkan');
    }

    // Menampilkan form edit anggota
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('anggota.form-edit', [
            'title' => 'Form Edit Anggota',
            'data' => $user
        ]);
    }

    // Memperbarui data anggota
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'rank_id' => 'required',
            'position_id' => 'required',
        ], [
            'email.unique' => 'Email Telah Digunakan'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'fullname' => $request->fullname,
            'rank_id' => $request->rank_id,
            'position_id' => $request->position_id,
            'nrp' => $request->nrp,
            'phone_number' => $request->phone_number,
            'branching_id' => $request->branching_id,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password
        ]);

        return redirect(route('admin.anggota.index'))->with('berhasil', 'Anggota Berhasil Diperbarui');
    }

    // Menghapus data anggota
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect(route('admin.anggota.index'))->with('berhasil', 'Anggota Berhasil Dihapus');
    }

    // Mengekspor data anggota ke file Excel
    public function exportExcel()
    {
        return Excel::download(new AnggotaExport, 'excel-anggota-' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }

    // Mencetak data anggota ke file PDF
    public function printPdf(Request $request)
    {
        $filterKey = $request->get('filter-key', null);
        $filterValue = $request->get('filter-value', null);

        $data = User::query();

        if ($filterKey !== null) {
            $data->orderBy($filterKey, $filterValue);
        }

        $pdf = Pdf::loadView('anggota.cetak', ['dataUrut' => $data->get()]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('cetak-anggota-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }
}