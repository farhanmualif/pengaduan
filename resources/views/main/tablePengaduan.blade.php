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
                            <h5 class="card-title mb-0">Data Laporan</h5>

                        </div>
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th class="d-none d-xl-table-cell">Tempat Kejadian</th>
                                    <th class="d-none d-xl-table-cell">Kronologi</th>
                                    <th>tanggal kejadian</th>
                                    <th class="d-none d-md-table-cell">foto kejadian</th>
                                    <th class="d-none d-md-table-cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $data)
                                    <tr>
                                        <td>{{ $data->judul_pengaduan }}</td>
                                        <td class="d-none d-xl-table-cell">{{ $data->tempat_kejadian }}</td>
                                        <td class="d-none d-xl-table-cell">{{ $data->kronologi_kejadian }}</td>
                                        <td><span class="badge bg-success">{{ $data->tanggal_kejadian }}</span></td>
                                        <td class="d-none d-md-table-cell">
                                            <img src="{{ asset('/storage/foto-laporan/' . $data->foto_kejadian) }}"
                                                class="rounded mx-auto d-block" alt="foto-kejadian" style="height: 100px">
                                        </td>
                                        @if (hasRole() == 'User')
                                            <td class="d-none d-md-table-cell">
                                                <a href="{{ route('pengaduan.edit', $data->id) }}" class="btn btn-info btn">
                                                    <i class="align-middle" data-feather="edit-3"></i>
                                                </a>
                                            </td>
                                        @elseif (hasRole() == 'Admin')
                                            <td class="d-none d-md-table-cell">
                                                <a href="{{ url('tanggapi-pengaduan', $data->id) }}" class="btn btn-info btn">
                                                    <i class="align-middle" data-feather="edit-3"></i>
                                                </a>
                                            </td>
                                        @endif

                                        <td>
                                                <form onsubmit="return confirm('ingin menghapus data? {{ $data->judul_pengaduan }}')" action="{{ route('pengaduan.destroy', $data->id) }}" method="post" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn">
                                                        <i class="align-middle" data-feather="trash"></i>
                                                    </button>
                                                </form>
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
