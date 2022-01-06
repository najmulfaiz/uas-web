<?php

namespace App\Http\Controllers;

use App\Models\Dosis;
use App\Models\Jadwal;
use App\Models\JadwalDosis;
use App\Models\JenisVaksin;
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
        $dosis = Dosis::all();
        $vaksin = JenisVaksin::all();

        return view('pages.jadwal.create', compact('dosis', 'vaksin'));
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
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'jenis_vaksin' => 'required',
            'penyelenggara' => 'required|string|max:255',
            'lat' => 'required|string|max:255',
            'lng' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $jadwal = new Jadwal;
        $jadwal->tanggal         = $request->tanggal;
        $jadwal->waktu_mulai     = $request->waktu_mulai;
        $jadwal->waktu_selesai   = $request->waktu_selesai;
        $jadwal->jenis_vaksin_id = $request->jenis_vaksin;
        $jadwal->penyelenggara   = $request->penyelenggara;
        $jadwal->lat             = $request->lat;
        $jadwal->lng             = $request->lng;
        $jadwal->alamat          = $request->alamat;

        if(!$jadwal->save()) {
            return redirect()->back()->withError('Data gagal tersimpan.');
        }

        foreach($request->dosis as $dosis_id) {
            JadwalDosis::create([
                'jadwal_id' => $jadwal->id,
                'dosis_id' => $dosis_id
            ]);
        }

        return redirect()->route('jadwal.index')->withSuccess('Data berhasil tersimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        return $jadwal;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        $dosis = Dosis::all();
        $vaksin = JenisVaksin::all();

        return view('pages.jadwal.edit', compact('jadwal', 'dosis', 'vaksin'));
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
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'jenis_vaksin' => 'required',
            'penyelenggara' => 'required|string|max:255',
            'lat' => 'required|string|max:255',
            'lng' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $jadwal->tanggal         = $request->tanggal;
        $jadwal->waktu_mulai     = $request->waktu_mulai;
        $jadwal->waktu_selesai   = $request->waktu_selesai;
        $jadwal->jenis_vaksin_id = $request->jenis_vaksin;
        $jadwal->penyelenggara   = $request->penyelenggara;
        $jadwal->lat             = $request->lat;
        $jadwal->lng             = $request->lng;
        $jadwal->alamat          = $request->alamat;

        if(!$jadwal->update()) {
            return redirect()->back()->withError('Data gagal diubah.');
        }

        JadwalDosis::where('jadwal_id', $jadwal->id)->delete();
        foreach($request->dosis as $dosis_id) {
            JadwalDosis::create([
                'jadwal_id' => $jadwal->id,
                'dosis_id' => $dosis_id
            ]);
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
                            ->addColumn('waktu', function(Jadwal $jadwal) {
                                return $jadwal->waktu_mulai . ' s/d ' . $jadwal->waktu_selesai;
                            })
                            ->addColumn('jenis_vaksin', function(Jadwal $jadwal) {
                                return $jadwal->jenis_vaksin->nama;
                            })
                            ->addColumn('dosis', function(Jadwal $jadwal) {
                                $tag = '';
                                foreach($jadwal->jadwal_dosis as $jadwal_dosis) {
                                    $tag .= '<span class="badge bg-info">' . $jadwal_dosis->dosis->nama . '</span>&nbsp;';
                                }

                                return $tag;
                            })
                            ->addColumn('aksi', function(Jadwal $jadwal) {
                                return '<a href="' . route('jadwal.show', $jadwal->id) . '" class="btn btn-info btn-sm"><i class="bx bx-info-circle"></i></a>
                                        <a href="' . route('jadwal.edit', $jadwal->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-edit"></i></a>
                                        <button class="btn btn-danger btn-sm btn_delete" data-id="' . $jadwal->id . '"><i class="bx bx-trash"></i></button>';
                            })
                            ->rawColumns(['dosis', 'aksi'])
                            ->toJson();
    }
}
