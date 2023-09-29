@extends('layout.template') 
@section('konten')    

<div class="my-3 p-3 bg-body rounded shadow-sm">
    {{-- form pencarian --}}
    <div class="pb-3">
        <form action="/mahasiswa" class="d-flex" method="GET">
            <input type="search" class="form-control me-1" name="katakunci" value="{{ 
                Request::get("katakunci") }}" placeholder="Masukkan Kata Kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
    </div>

    {{-- tombol tambah data --}}
    <div class="pb-3">
        <a href="/mahasiswa/create" class="btn btn-primary">Tambah +</a>
    </div>

    {{-- start data --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-4">NIM</th>
                <th class="col-md-3">Nama</th>
                <th class="col-md-2">Jurusan</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $data->firstItem() ?>
            @foreach ($data as $item)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $item->nim }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jurusan }}</td>
                <td>
                    <a href="/mahasiswa/{{ $item->nim }}/edit" class="btn btn-warning btn-sm">Edit</a>
                    <form action="/mahasiswa/{{ $item->nim }}" class="d-inline" method="POST" onsubmit="return confirm('Apakah yakin akan menghapus data?')">
                        @csrf
                        @method("DELETE")
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                    </form>
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
    {{-- tombol pagination --}}
    {{ $data->withQueryString()->links() }}
</div>
@endsection