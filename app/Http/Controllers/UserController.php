<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create');
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);

        if(!$user->save()) {
            return redirect()->back()->withError('Data gagal tersimpan.');
        }

        return redirect()->route('user.index')->withSuccess('Data berhasil tersimpan.');
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
    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', Rules\Password::defaults()],
        ]);

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = ($request->has('password') && $request->password != '') ? Hash::make($request->password) : $user->password;

        if(!$user->update()) {
            return redirect()->back()->withError('Data gagal diubah.');
        }

        return redirect()->route('user.index')->withSuccess('Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(!$user->delete()) {
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
        $query = User::query();

        return DataTables::eloquent($query)
                            ->addColumn('aksi', function(User $user) {
                                return '<a href="' . route('user.edit', $user->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-edit"></i></a>
                                        <button class="btn btn-danger btn-sm btn_delete" data-id="' . $user->id . '"><i class="bx bx-trash"></i></button>';
                            })
                            ->rawColumns(['aksi'])
                            ->toJson();
    }
}
