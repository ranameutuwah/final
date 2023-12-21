<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Pengarang;
use Illuminate\Http\Request;
use Storage;
use Illuminate\view\view;

class BukuController extends Controller
{
    //Method untuk tampilkan data Buku
    public function index()
    {
        $buku = Buku::latest()->when(request()->q, function ($buku) {
            $buku = $buku->where("judul_buku", "like", "%" . request()->q . "%");
        })->paginate(10);
        return view("admin.buku.index", compact("buku"));
    }

    // method untuk menganggil form input data
    public function create()
    {
        //kode utk ambil data dari pengarang
        $pengarang = Pengarang::latest()->get();
        return view("admin.buku.create", compact("pengarang"));
    }

    // method untuk kirim data dari inputan form ke table kategori database
    public function store(Request $request)
    {
        // Code untuk memvalidasi inputan
        $this->validate($request, [
            'id' => 'required|unique:bukus',
            'judul_buku' => 'required|unique:bukus',
            'pengarang_id' => 'required',
            'tahun_terbit' => 'required|min:4',
        ]);

        //data input simpan kedalam tabel
        $buku = Buku::create([
            'id' => $request->id,
            'judul_buku' => $request->judul_buku,
            'pengarang_id' => $request->pengarang_id,
            'tahun_terbit' => $request->tahun_terbit,
        ]);

        //Kondisi apakah data berhasil di simpan atau tidak
        if ($buku) {
            // redirect dengan tampilkan pesan
            return redirect()->route('admin.buku.index')->with(['success' => 'Data Berhasil Disimpan kedalam tabel buku']);
        } else {
            return redirect()->route('admin.buku.index')->with(['error' => 'Data Berhasil Disimpan kedalam tabel buku']);
        }
    }

    //method untuk tampilkan data yang mau diubah
    public function edit(Buku $buku)
    {
        $pengarang = Pengarang::latest()->get();
        return view('admin.buku.edit', compact('buku','pengarang'));
    }

    // Buat method untuk kirimkan data yang di ubah di form inputan
    public function update(Request $request, Buku $buku)
    {
        // Code untuk memvalidasi inputan
        $this->validate($request, [
            'id' => 'required',
            'judul_buku' => 'required',
            'pengarang_id' => 'required',
            'tahun_terbit' => 'required',

        ]);

        // Percabangan IF
        //update data di tabel buku dengan data baru
        $buku = Buku::findOrFail($buku->id);
        $buku->update([
            'id' => $request->id,
            'judul_buku' => $request->judul_buku,
            'pengarang_id' => $request->pengarang_id,
            'tahun_terbit' => $request->tahun_terbit,
        ]);

        //Kondisi Jika Berhasil atau Gagal ubah datanya
        if ($buku) {
            // redirect dengan tampilkan pesan
            return redirect()->route('admin.buku.index')->with('success', 'Data Berhasil Diubah Kedalam Tabel Supplier');
        } else {
            return redirect()->route('admin.supplier.index')->with('error', 'Data Gagal Diubah Kedalam Tabel Supplier');
        }
    }
    // Metodh untuk hapus data
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        // Kondisi Berhasi atau Gagal menghapus datanya
        if ($buku) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
    //methode utk tampilkan view data secara detail
    public function show(string $id): View
    {
        $buku = Buku::findOrFail($id);
        return view('admin.buku.show', compact('buku'));
    }


}
