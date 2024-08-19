<?php

namespace App\Http\Controllers;

use App\Models\IncomingLetter;
use App\Models\IncomingLetterAttachment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InComingLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = IncomingLetter::select();
        // $search = request()->get('search', []);
        // foreach ($search as $key => $value) {
        //     $data->where($key, 'like', '%' . $value . '%');
        // }

        if (request()->get('cetak', null) == 1) {
            $pdf = Pdf::loadView('incoming.pdf', ['data' => $data->get()]);
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream('cetak-incomint-letter-' . Carbon::now()->format('Y-m-d') . '.pdf');
        }

        return view('incoming.index', [
            'title' => 'Kelola Surat Masuk',
            'data' => $data->simplePaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('incoming.create', [
            'title' => 'Tambah Surat Masuk',
            'data' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $incomingLetter = IncomingLetter::create($request->all());

        foreach ($request->attachments as $index => $attachment) {

            $path = $attachment->store('incoming-letter-attachment', 'public');

            IncomingLetterAttachment::create([
                'path' => $path,
                'incoming_message_id' => $incomingLetter->id,
            ]);

        }

        return redirect()->route(auth()->user()->position->name . '.incoming-letter.index')->with('success', 'Sukses');
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
        return view('incoming.edit', [
            'title' => 'Ubah Surat Masuk',
            'data' => IncomingLetter::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $incomingLetter = IncomingLetter::findOrFail($id)->update($request->all());
        return redirect()->route(auth()->user()->position->name . '.incoming-letter.index')->with('success', 'Sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        IncomingLetter::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'sukses');
    }

    public function deleteAttachment($id)
    {
        IncomingLetterAttachment::findOrFail($id)->delete();
        return redirect()->route(auth()->user()->position->name . '.incoming-letter.index')->with('success', 'Sukses');
    }

    public function addAttachment(Request $request)
    {
        foreach ($request->attachments as $index => $attachment) {

            $path = $attachment->store('incoming-letter-attachment', 'public');

            IncomingLetterAttachment::create([
                'path' => $path,
                'incoming_message_id' => $request->incoming_message_id,
            ]);

        }

        return redirect()->route(auth()->user()->position->name . '.incoming-letter.index')->with('success', 'Sukses');
    }
}
