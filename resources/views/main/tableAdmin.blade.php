@extends('templates.index')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Latest Projects</h5>
                        </div>
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th class="d-none d-xl-table-cell">Email</th>
                                    <th class="d-none d-md-table-cell">Created At</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @forelse ($users as $user)
                                        <td class="d-none d-xl-table-cell">{{ $user }}</td>
                                    @empty
                                        <button class="btn btn-danger">Not Found</button>
                                    @endforelse
                                    <td class="d-none d-xl-table-cell">
                                        <a href="" class="btn btn-danger btn-sm">
                                            <i class="align-middle" data-feather="trash"></i>
                                        </a>
                                        <a href="{{ url('form-update-user/') . $users[0] }}" class="btn btn-info btn-sm">
                                            <i class="align-middle" data-feather="edit-3"></i>
                                        </a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
