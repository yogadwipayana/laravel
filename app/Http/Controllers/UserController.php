<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($id = null) {
        $user = null;

        if($id) {
            $user = User::find($id);
        }

        return view('form', ['data' => $user]);
    }

    public function create(Request $request) {
        $user = User::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'prodi' => $request->input('prodi')
        ]);

        return redirect('/dashboard');
    }

    public function show() {
        $users = User::select('id', 'nama', 'email', 'no_hp', 'alamat', 'jenis_kelamin', 'prodi')->get();

        return view('dashboard', ['users' => $users]);
    }

    public function destroy($id) {
        User::destroy($id);

        return redirect('/dashboard');
    }

    public function update(Request $request, $id) {
        $user = User::where('id', $id)->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'prodi' => $request->input('prodi')
        ]);

        return redirect('/dashboard');
    }

    public function test() {
        $user = new User;
        
        $user->nama = "yoga";
        $user->email = "yoga@gmail.com";
        $user->no_hp = "081234567890";
        $user->alamat = "Panjer";
        $user->jenis_kelamin = "laki-laki";
        $user->prodi = "informatika";

        $user->save();

        return response()->json(['success']);
    }
}
