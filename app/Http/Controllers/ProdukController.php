<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProdukController extends Controller
{
    public function index(Request $request) {
        // Query builder untuk produk
        $query = DB::table('produks');

        // Filter berdasarkan pencarian nama
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Ambil data produk dengan sorting
        $produks = $query->orderBy('created_at', 'desc')->get();

        return view('produk.index', compact('produks'));
    }

    public function create() {
        return view('produk.create');
    }

    public function store(Request $request) {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'qty' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
            'id_kategori' => 'nullable|integer'
        ]);

        // Insert data ke database
        DB::table('produks')->insert([
            'nama' => $request->input('nama'),
            'kategori' => $request->input('kategori'),
            'id_kategori' => $request->input('id_kategori', 1),
            'qty' => $request->input('qty'),
            'harga_beli' => $request->input('harga_beli'),
            'harga_jual' => $request->input('harga_jual'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect('/produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id) {
        // Ambil data produk berdasarkan ID
        $produk = DB::table('produks')->where('id', $id)->first();

        // Jika produk tidak ditemukan
        if (!$produk) {
            return redirect('/produk')->with('error', 'Produk tidak ditemukan!');
        }

        // Tampilkan form edit
        return view('produk.edit', compact('produk'));
    }

    public function updateProduk(Request $request, $id) {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'qty' => 'required|integer|min:0',
            'harga_beli' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
            'id_kategori' => 'nullable|integer'
        ]);

        // Update data produk
        DB::table('produks')
            ->where('id', $id)
            ->update([
                'nama' => $request->input('nama'),
                'kategori' => $request->input('kategori'),
                'id_kategori' => $request->input('id_kategori', 1),
                'qty' => $request->input('qty'),
                'harga_beli' => $request->input('harga_beli'),
                'harga_jual' => $request->input('harga_jual'),
                'updated_at' => now()
            ]);

        // Redirect dengan pesan sukses
        return redirect('/produk')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id) {
        // Ambil data produk untuk mendapatkan nama (untuk pesan konfirmasi)
        $produk = DB::table('produks')->where('id', $id)->first();

        if (!$produk) {
            return redirect('/produk')->with('error', 'Produk tidak ditemukan!');
        }

        // Hapus produk
        DB::table('produks')->where('id', $id)->delete();

        // Redirect dengan pesan sukses
        return redirect('/produk')->with('success', 'Produk "' . $produk->nama . '" berhasil dihapus!');
    }

    // public function show($id) {
    //     $produks = DB::table('produks')
    //                 ->select('id', 'nama', 'harga_jual', 'harga_beli')
    //                 ->where('id', $id)
    //                 ->first();

    //     dd($produks);
    // }

    // public function update(Request $request) {
    //     $produks = DB::table('produks')
    //                 ->insert([
    //                     'nama' => $request->input('nama'),
    //                     'id_kategori' => $request->input('id_kategori'),
    //                     'qty' => $request->input('qty'),
    //                     'harga_beli' => $request->input('harga_beli'),
    //                     'harga_jual' => $request->input('harga_jual')
    //                 ]);

    //     $produks = DB::table('produks')
    //                 ->where('id', $request->input('id'))
    //                 ->update(['id_kategori' => 2]);
    // }
}
