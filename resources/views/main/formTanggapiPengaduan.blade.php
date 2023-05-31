@extends('templates.index')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <p>
                    {{ Request::segment('1').' / '.Request::segment('3').' / '.Request::segment('2') }}
                </p>
                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">
                            <div class="text-center">
                                <h1 class="h2">{{ $datas['title'] }}</h1>
                            </div>

                            @if ($errors->any())
                                <button class="btn btn-danger" disabled="">
                                    @foreach ($errors->all() as $err)
                                        {{ $err }}
                                    @endforeach
                                </button>
                            @endif

                            @if (session('success'))
                                <button class="btn btn-success" disabled="">
                                    {{ session('success') }}
                                </button>
                            @endif

                            @if (session('failed'))
                                <button class="btn btn-danger" disabled="">
                                    {{ session('failed') }}
                                </button>
                            @endif

                            @foreach ([$datas['pengaduan']] as $data )
                            <form action="{{ route('tanggapi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="container my-5">
                                    <div class="text-center">
                                        <img src="{{ asset('storage/foto-laporan/'.$data->foto_kejadian) }}" class="rounded" alt="..." id="image_click" style="width: 300px">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Judul pengaduan</label>
                                    <input class="form-control form-control-lg" type="text" name="judul_pengaduan"
                                        placeholder="Masukan judul pengaduan" value="{{ $data->judul_pengaduan }}" disabled/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tempat kejadian</label>
                                    <input class="form-control form-control-lg" type="text" name="tempat_kejadian"
                                        placeholder="Masukan judul kejadian" value="{{ $data->tempat_kejadian }}" disabled/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Kejadian</label>
                                    <input class="form-control form-control-lg" type="text" name="tempat_kejadian"
                                        placeholder="Masukan judul kejadian" value="{{ $data->tanggal_kejadian }}" disabled/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kronologi kejadian</label>
                                    <input class="form-control form-control-lg" type="text" name="tempat_kejadian"
                                        placeholder="Masukan judul kejadian" value="{{ $data->kronologi_kejadian }}" disabled/>
                                </div>
                                {{-- initial id --}}
                                <input  value="{{ $data->id }}" name="pengaduan_id" hidden/>

                                <div class="mb-3">
                                    <label class="form-label">Tanggapi</label>
                                    <textarea class="form-control" rows="4" placeholder="Textarea" name="isi_tanggapi"
                                        placeholder="Jabarkan kejadian"></textarea>
                                </div>
                                <input type="text" value="{{ $data->id }}" name="pengaduan_id" hidden>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary">kirim</button>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
