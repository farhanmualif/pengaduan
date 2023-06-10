@extends('templates.index')
@section('content')
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Update User</h1>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <form action="{{ route('update', $data->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input class="form-control form-control-lg" type="text" name="name"
                                                value="{{ $data->name }}" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="email" name="email"
                                                value="{{ $data->email }}" />
                                        </div>
                                        @if (hasRole()=='User')
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password1" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Input Password Sekali Lagi</label>
                                            <input class="form-control form-control-lg" type="password" name="password2" />
                                        </div>
                                        @endif
                                        @if (hasRole() == 'Admin')
                                        <div class="mb-3">
                                            <label class="form-label">Role</label>
                                            <select class="form-select mb-3" id="role" name="role">
                                                <option selected value="{{ $group->id }}">{{ $group->name }}</option>
                                                @forelse ($groups as $group)
                                                    <option value="{{ $group->id }}">{{ $group->name }}
                                                    </option>
                                                @empty
                                                    <option value='null'>kosong</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @endif

                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
