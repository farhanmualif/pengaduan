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
                            @foreach ([$datas['pengaduan']] as $data)
                            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Judul pengaduan</label>
                                    <input class="form-control form-control-lg" type="text" name="judul_pengaduan" value="{{ $data->judul_pengaduan }}"
                                        placeholder="Masukan judul pengaduan" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tempat kejadian</label>
                                    <input class="form-control form-control-lg" type="text" name="tempat_kejadian" value="{{ $data->tempat_kejadian }}"
                                        placeholder="Masukan judul kejadian" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal kejadian</label>
                                    <input class="form-control form-control-lg" type="date" name="tanggal_kejadian" value="{{ $data->tanggal_kejadian }}"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kronologi kejadian</label>
                                    <textarea class="form-control" rows="4" placeholder="Textarea" name="kronologi_kejadian" value="{{ $data->kronologi_kejadian }}"
                                        placeholder="Jabarkan kejadian"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Small file input example</label>
                                    <input class="form-control form-control-sm" id="formFileSm" type="file" value="{{ $data->foto_kejadian }}"
                                        name="file">
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
