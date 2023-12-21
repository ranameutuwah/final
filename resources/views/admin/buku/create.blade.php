@extends('layouts.app', ['title' => 'Tambah Buku - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">

        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold  capitalize">TAMBAH BUKU</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4">

                    <div>
                        <label class="text-gray-700" for="id">NOMOR BUKU</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                            name="id" value="{{ old('id') }}" placeholder="Judul Buku">
                        @error('id')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700" for="judul_buku">JUDUL BUKU</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                            name="judul_buku" value="{{ old('judul_buku') }}" placeholder="Judul Buku">
                        @error('judul_buku')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>
                    <!-- <div>
                        <label class="text-gray-700" for="pengarang_id">NAMA PENGARANG</label>
                        <select class="w-full border bg-gray-200 focus:bg-white rounded px-3 py-2 outline-none"name="pengarang_id">
                            @foreach($pengarang as $pg)
                                <option class="py-1"value="{{ $pg->id }}">{{ $pg->nama_pengarang }}</option>
                            @endforeach
                        </select>
                        @error('pengarang_id')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div> -->
                    <div>
                        <label class="text-gray-700" for="pengarang_id">NAMA PENGARANG</label>
                        <select class="form-select w-full mt-2 rounded-md bg-gray-200 focus:bg-white"
                            name="pengarang_id">
                            <option value="" disabled selected>Pilih Pengarang</option>
                            @foreach($pengarang as $pg)
                            <option value="{{ $pg->id }}">{{ $pg->nama_pengarang }}</option>
                            @endforeach
                        </select>
                        @error('pengarang_id')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>        

                    <div>
                        <label class="text-gray-700" for="tahun_terbit">TAHUN TERBIT</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text"
                            name="tahun_terbit" value="{{ old('tahun_terbit') }}" placeholder="Tahun Terbit ">
                        @error('tahun_terbit')
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
                        class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">SIMPAN</button>
                </div>
            </form>
        </div>

    </div>
</main>
@endsection