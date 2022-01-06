<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Jadwal::where('tanggal', '>=', date('Y-m-d'))->get();

        return view('home', compact('data'));
    }
}
