<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.jadwal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:jadwals',
        ]);

        $jadwal = new Jadwal;
        $jadwal->name     = $request->name;
        $jadwal->email    = $request->email;

        if(!$jadwal->save()) {
            return redirect()->back()->withError('Data gagal tersimpan.');
        }

        return redirect()->route('jadwal.index')->withSuccess('Data berhasil tersimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        return view('pages.jadwal.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:jadwals,email,' . $jadwal->id,
        ]);

        $jadwal->name     = $request->name;
        $jadwal->email    = $request->email;

        if(!$jadwal->update()) {
            return redirect()->back()->withError('Data gagal diubah.');
        }

        return redirect()->route('jadwal.index')->withSuccess('Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        if(!$jadwal->delete()) {
            return response()->json([
                'isError' => true,
                'message' => 'Data gagal dihapus.'
            ]);
        }

        return response()->json([
            'isError' => false,
            'message' => 'Data berhasil dihapus.'
        ]);
    }

    public function datatable()
    {
        $query = Jadwal::query();

        return DataTables::eloquent($query)
                            ->addColumn('aksi', function(Jadwal $jadwal) {
                                return '<a href="' . route('jadwal.edit', $jadwal->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-edit"></i></a>
                                        <button class="btn btn-danger btn-sm btn_delete" data-id="' . $jadwal->id . '"><i class="bx bx-trash"></i></button>';
                            })
                            ->rawColumns(['aksi'])
                            ->toJson();
    }
}
