@extends('templates.index')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row">
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

                            @if (session('failed'))
                                <button class="btn btn-danger" disabled="">
                                    {{ session('failed') }}
                                </button>
                            @endif

                            @foreach ([$datas['pengaduan']] as $data )
                            <form action="{{ route('pengaduan.store', $data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="container my-5">
                                    <div class="text-center">
                                        <img src="{{ asset('storage/foto-laporan/'.$data->foto_kejadian) }}" class="rounded" alt="..." id="image_click">
                                        <p class="my-3">Klik Untuk Ubah gambar</p>
                                    </div>
                                </div>

                                <div class="mb-3" style="width: 50%">
                                    <input class="form-control form-control-sm" type="file" name="file" id="input_file_hidden" hidden/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Judul pengaduan</label>
                                    <input class="form-control form-control-lg" type="text" name="judul_pengaduan"
                                        placeholder="Masukan judul pengaduan" value="{{ $data->judul_pengaduan }}"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tempat kejadian</label>
                                    <input class="form-control form-control-lg" type="text" name="tempat_kejadian"
                                        placeholder="Masukan judul kejadian" value="{{ $data->tempat_kejadian }}"/>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Kejadian</label>
                                    <input class="form-control form-control-lg" type="text" name="tempat_kejadian"
                                        placeholder="Masukan judul kejadian" value="{{ $data->tanggal_kejadian }}" disabled/>
                                </div>

                                <div class="mb-3">
                                    <input class="form-control form-control-lg" type="date" name="tanggal_kejadian" value="{{ $data->tanggal_kejadian }}"/>
                                </div>

                                <br>

                                <div class="mb-3">
                                    <label class="form-label">Kronologi kejadian</label>
                                    <input class="form-control form-control-lg" type="text" name="tempat_kejadian"
                                        placeholder="Masukan judul kejadian" value="{{ $data->kronologi_kejadian }}" disabled/>
                                </div>

                                <div class="mb-3">
                                    <textarea class="form-control" rows="4" placeholder="Textarea" name="kronologi_kejadian"
                                        placeholder="Jabarkan kejadian"></textarea>
                                </div>



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
