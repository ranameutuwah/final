@extends('layouts.app', ['title' => 'Edit Buku - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">

        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold capitalize">EDIT SEWA</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.sewa.update', $sewa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 mt-4">

                    <div>
                        <label class="text-gray-700" for="id">ID SEWA</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                            name="id" value="{{ old('id', $sewa->id) }}" placeholder="Id Sewa">
                        @error('id')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700" for="nama_peminjam">NAMA</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                            name="nama_peminjam" value="{{ old('nama_peminjam', $sewa->nama_peminjam) }}"
                            placeholder="Nama Peminjam">
                        @error('nama_peminjam')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700" for="buku_id">JUDUL BUKU</label>
                        <select class="form-select w-full mt-2 rounded-md bg-gray-200 focus:bg-white"
                            name="buku_id">
                            <option value="" disabled selected>Pilih Buku</option>
                            @foreach($buku as $bk)
                            <option value="{{ $bk->id }}">{{ $bk->judul_buku }}</option>
                            @endforeach
                        </select>
                        @error('buku_id')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700" for="tanggal_peminjaman">TANGGAL PEMINJAMAN</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="date"
                            name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman', $sewa->tanggal_peminjaman) }}"
                            placeholder="Tanggal Peminjaman">
                        @error('tanggal_peminjaman')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700" for="tanggal_pengembalian">TANGGAL PENGEMBALIAN</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="date"
                            name="tanggal_pengembalian"
                            value="{{ old('tanggal_pengembalian', $sewa->tanggal_pengembalian) }}"
                            placeholder="Tanggal Pengembalian">
                        @error('tanggal_pengembalian')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>


                </div>

                <div class="flex justify-start mt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">UPDATE</button>
                </div>
            </form>
        </div>

    </div>
</main>
@endsection