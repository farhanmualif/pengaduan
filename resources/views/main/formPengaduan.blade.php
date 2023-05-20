@extends('templates.index')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">
                            <div class="text-center">
                                <h1 class="h2">Form Pengaduan</h1>
                            </div>
                            <form action="post-pengaduan" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Judul pengaduan</label>
                                    <input class="form-control form-control-lg" type="text" name="judul"
                                        placeholder="Masukan judul kejadian" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal kejadian</label>
                                    <input class="form-control form-control-lg" type="date" name="tanggal_kejadian" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kronologi kejadian</label>
                                    <textarea class="form-control" rows="4" placeholder="Textarea" name="kronologi_kejadian"
                                        placeholder="Jabarkan kejadian"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto kejadian</label>
                                    <input class="form-control form-control-lg" type="file" name="foto_kejadian "
                                        placeholder="Enter your password" />
                                </div>

                                <div class="text-center mt-3">
                                    <a href="index.html" class="btn btn-lg btn-primary">kirim</a>
                                    <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
