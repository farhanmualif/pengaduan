@extends('templates.index')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                    <div class="card flex-fill">

                        <div class="card-header text-center">
                            @if ($message = Session::get('success'))
                                <button class="btn btn-success" disabled="">
                                    {{ $message }}
                                </button>
                            @endif
                            <h5 class="card-title mb-3">Data Laporan</h5>
                        </div>
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th class="d-none d-xl-table-cell w-50">Nama Pengadu</th>
                                    <th class="d-none d-xl-table-cell w-50">Email pengadu</th>
                                    <th class="d-none d-xl-table-cell w-50">Judul Pengaduan</th>
                                    <th class="d-none d-xl-table-cell w-50">Tempat Kejadian</th>
                                    <th class="d-none d-xl-table-cell w-50">tanggal ditanggapi</th>
                                    <th class="d-none d-md-table-cell w-50">Isi Tanggapi</th>
                                    <th class="d-none d-md-table-cell w-50">Foto kejadian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $data)
                                    <tr>
                                        <td>{{ $data->name }}</td>
                                        <td class="d-none d-xl-table-cell">{{ $data->email }}</td>
                                        <td class="d-none d-xl-table-cell">{{ $data->judul_pengaduan }}</td>
                                        <td>{{ $data->tempat_kejadian }}</span></td>
                                        <td><span class="badge bg-success">{{ $data->tanggal_kejadian }}</span></td>
                                        <td>{{ $data->isi_tanggapi }}</span></td>
                                        <td class="d-none d-md-table-cell">
                                            <img src="{{ asset('/storage/foto-laporan/' . $data->foto_kejadian) }}"
                                                class="rounded mx-auto d-block" alt="foto-kejadian" style="height: 100px">
                                        </td>
                                    </tr>
                                @empty
                                    <button class="btn btn-danger" disabled="">
                                        Tidak ada data
                                    </button>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
