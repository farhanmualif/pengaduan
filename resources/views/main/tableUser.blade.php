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
                                    @if (hasRole() == 'Admin')
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($datas != null)
                                    @forelse ($datas as $user)
                                        <tr>
                                            <td class="d-none d-xl-table-cell">{{ $user->id }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $user->name }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $user->email }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $user->created_at }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $user->group_name == 'Admin' ? 'bg-success' : 'bg-warning' }}">{{ $user->group_name }}
                                                </span>
                                            </td>
                                            @if (hasRole() == 'Admin')
                                                <td class="d-none d-xl-table-cell">
                                                    <a href="" class="btn btn-danger btn-sm" id="delete">
                                                        <i class="align-middle" data-feather="trash"></i>
                                                    </a>
                                                    <a href="{{ route('form-update-user', $user->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="align-middle" data-feather="edit-3"></i>
                                                    </a>
                                                </td>
                                            @elseif (hasRole() == 'User')
                                            <p>NaN</p>
                                            @endif
                                        </tr>
                                    @empty
                                        <button class="btn btn-danger" disabled>Data Kosong</button>
                                    @endforelse
                                @else
                                    <button class="btn btn-danger" disabled>Data Kosong</button>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
