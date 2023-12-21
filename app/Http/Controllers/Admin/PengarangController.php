<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengarang;
use Illuminate\Http\Request;
use Storage;
// import view
use Illuminate\view\view;

class PengarangController extends Controller
{
    //Method untuk tampilkan data supplier
    public function index()
    {
        $pengarang = Pengarang::latest()->when(request()->q, function ($pengarang) {
            $pengarang = $pengarang->where("nama_pengarang", "like", "%" . request()->q . "%");
        })->paginate(10);
        return view("admin.pengarang.index", compact("pengarang"));
    }

    // method untuk menganggil form input data
    public function create()
    {
        return view("admin.pengarang.create");
    }

    // method untuk kirim data dari inputan form ke table kategori database
    public function store(Request $request)
    {
        // Code untuk memvalidasi inputan
        $this->validate($request, [
            'id' => 'required|unique:pengarangs',
            'nama_pengarang' => 'required|unique:pengarangs',
        ]);

        //data input simpan kedalam tabel
        $pengarang = Pengarang::create([
            'id' => $request->id,
            'nama_pengarang' => $request->nama_pengarang,
        ]);

        //Kondisi apakah data berhasil di simpan atau tidak
        if ($pengarang) {
            // redirect dengan tampilkan pesan
            return redirect()->route('admin.pengarang.index')->with(['success' => 'Data Berhasil Disimpan kedalam tabel buku']);
        } else {
            return redirect()->route('admin.pengarang.index')->with(['error' => 'Data Berhasil Disimpan kedalam tabel buku']);
        }
    }

    //method untuk tampilkan data yang mau diubah
    public function edit(Pengarang $pengarang)
    {
        return view('admin.pengarang.edit', compact('pengarang'));
    }

    // Buat method untuk kirimkan data yang di ubah di form inputan
    public function update(Request $request, Pengarang $pengarang)
    {
        // Code untuk memvalidasi inputan
        $this->validate($request, [
            'id' => 'required',
            'nama_pengarang' => 'required',
        ]);

        // Percabangan IF
        //update data di tabel supplier dengan data baru
        $pengarang = Pengarang::findOrFail($pengarang->id);
        $pengarang->update([
            'id' => $request->id,
            'nama_pengarang' => $request->nama_pengarang,
        ]);

        //Kondisi Jika Berhasil atau Gagal ubah datanya
        if ($pengarang) {
            // redirect dengan tampilkan pesan
            return redirect()->route('admin.pengarang.index')->with('success', 'Data Berhasil Diubah Kedalam Tabel Supplier');
        } else {
            return redirect()->route('admin.supplier.index')->with('error', 'Data Gagal Diubah Kedalam Tabel Supplier');
        }
    }
        // Metodh untuk hapus data
        public function destroy($id)
        {
            $pengarang = Pengarang::findOrFail($id);
            $pengarang->delete();
    
            // Kondisi Berhasi atau Gagal menghapus datanya
            if ($pengarang) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'error']);
            }
        }
        //methode utk tampilkan view data secara detail
        public function show(string $id): View
        {
            $pengarang = Pengarang::findOrFail($id);
            return view('admin.pengarang.show', compact('pengarang'));
        }
    

}
