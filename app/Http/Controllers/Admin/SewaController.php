<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sewa;
use App\Models\Buku;
use Storage;
// import view
use Illuminate\view\view;


class SewaController extends Controller
{

    //Method untuk tampilkan data supplier
    public function index()
    {
        $sewa = Sewa::latest()->when(request()->q, function ($sewa) {
            $sewa = $sewa->where("nama_peminjam", "like", "%" . request()->q . "%");
        })->paginate(10);
        return view("admin.sewa.index", compact("sewa"));
    }

    // method untuk menganggil form input data
    public function create()
    {
        //kode utk ambil data dari buku
        $buku = Buku::latest()->get();
        return view("admin.sewa.create", compact("buku"));
    }

    // method untuk kirim data dari inputan form ke table kategori database
    public function store(Request $request)
    {
        // Code untuk memvalidasi inputan
        $this->validate($request, [
            'id' => 'required|unique:sewas',
            'nama_peminjam' => 'required|unique:sewas',
            'buku_id' => 'required',
            'tanggal_peminjaman' => 'required',
            'tanggal_pengembalian' => 'required',
        ]);

        //data input simpan kedalam tabel
        $sewa = Sewa::create([
            'id' => $request->id,
            'nama_peminjam' => $request->nama_peminjam,
            'buku_id' => $request->buku_id,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

        //Kondisi apakah data berhasil di simpan atau tidak
        if ($sewa) {
            // redirect dengan tampilkan pesan
            return redirect()->route('admin.sewa.index')->with(['success' => 'Data Berhasil Disimpan kedalam tabel buku']);
        } else {
            return redirect()->route('admin.sewa.index')->with(['error' => 'Data Berhasil Disimpan kedalam tabel buku']);
        }
    }

    //method untuk tampilkan data yang mau diubah
    public function edit(Sewa $sewa)
    {
        $buku = Buku::latest()->get();
        return view('admin.sewa.edit', compact('sewa','buku'));
    }

    // Buat method untuk kirimkan data yang di ubah di form inputan
    public function update(Request $request, Sewa $sewa)
    {
        // Code untuk memvalidasi inputan
        $this->validate($request, [
            // 'judul_buku' => 'required|unique:bukus',
            // 'id_pengarang' => 'required|unique:bukus',
            // 'tahun_terbit' => 'required|min:4',
            'id' => 'required',
            'nama_peminjam' => 'required' ,
            'buku_id' => 'required' ,
            'tanggal_peminjaman' => 'required' ,
            'tanggal_pengembalian' => 'required' ,
        ]);

        // Percabangan IF
        //update data di tabel supplier dengan data baru
        $sewa = Sewa::findOrFail($sewa->id);
        $sewa->update([
            'id' => $request->id,
            'nama_peminjam' => $request->nama_peminjam,
            'buku_id' => $request->buku_id,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

        //Kondisi Jika Berhasil atau Gagal ubah datanya
        if ($sewa) {
            // redirect dengan tampilkan pesan
            return redirect()->route('admin.sewa.index')->with('success', 'Data Berhasil Diubah Kedalam Tabel Supplier');
        } else {
            return redirect()->route('admin.sewa.index')->with('error', 'Data Gagal Diubah Kedalam Tabel Supplier');
        }
    }
    // Metodh untuk hapus data
    public function destroy($id)
    {
        $sewa = Sewa::findOrFail($id);
        $sewa->delete();

        // Kondisi Berhasi atau Gagal menghapus datanya
        if ($sewa) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
    //methode utk tampilkan view data secara detail
    public function show(string $id): View
    {
        $sewa = Sewa::findOrFail($id);
        return view('admin.sewa.show', compact('sewa'));
    }


}
