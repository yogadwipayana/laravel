<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class GuestController extends Controller
{
    public function index() {
        return view('guestForm');
    }

    public function create(Request $request) {
        
        try {
            $guest = Guest::create([
                'nama' => $request->input('nama'),
                'alamat' => $request->input('alamat'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'konfirmasi_kehadiran' => $request->input('konfirmasi_kehadiran')
            ]);
    
            return view('guestForm', ['message' => 'Data berhasil disimpan']);
        } catch (Exception $e) {
            return view('guestForm', ['message' => 'Data gagal disimpan']);
        }
    }

    public function show() {
        // $guests = Guest::all();
        $guests = DB::table('guest')->get();

        return view('guestDashboard', ['guests' => $guests]);
    }
}
