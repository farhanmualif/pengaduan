@extends('templates.index')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Detail Profil</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/img/default.png') }}" alt="Christina Mason"
                                class="img-fluid rounded-circle mb-2" width="128" height="128" />
                            <h5 class="card-title mb-0">{{ auth()->user()->name }}</h5>
                            <div class="text-muted mb-2">{{ hasRole() }}</div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <h5 class="h6 card-title">About</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Email <a
                                        href="#">{{ auth()->user()->email}}</a></li>

                                <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> Alamat <a
                                        href="#">-</a></li>
                            </ul>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <h5 class="h6 card-title">Elsewhere</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1"><a href="#">staciehall.co</a></li>
                                <li class="mb-1"><a href="#">Twitter</a></li>
                                <li class="mb-1"><a href="#">Facebook</a></li>
                                <li class="mb-1"><a href="#">Instagram</a></li>
                                <li class="mb-1"><a href="#">LinkedIn</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-xl-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Aktifitas</h5>
                        </div>
                            <div class="card-body h-100">
                                <div class="d-flex align-items-start">
                                    <img src="{{ asset('storage/img/default.png') }}" width="36" height="36"
                                        class="rounded-circle me-2" alt="Vanessa Tucker" />
                                    <div class="flex-grow-1">
                                        <small class="float-end text-navy">{{ $time->diffForHumans() }}</small>
                                        <strong>{{ auth()->user()->name }}</strong> melakukan <strong>{{ $activities->activity_name }}</strong><br />
                                        <small class="text-muted">{{ $activities->created_at }}</small><br />
                                    </div>
                                </div>
                                <hr />
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
