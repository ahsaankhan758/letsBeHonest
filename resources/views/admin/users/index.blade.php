@extends('admin.layouts.master')

@section('title', 'Users')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Users List</h4>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">

                        <div class="row justify-content-between mb-3">
                            <div class="col-md-4">
                                <form method="GET" action="{{ route('users.index') }}" class="position-relative">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control" placeholder="Search name, location, gender...">
                                    <span class="mdi mdi-magnify position-absolute" style="right:10px; top:10px;"></span>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="selectAll">
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Location</th>
                                        <th>Bio</th>
                                        <th style="width:120px;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($users as $user)
                                        <tr>

                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input user-checkbox"
                                                        value="{{ $user->id }}">
                                                </div>
                                            </td>

                                            <td class="table-user">
                                                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('admin/assets/images/user.png') }}"
                                                    class="me-2 rounded-circle" width="40" height="40">
                                                <span class="fw-semibold">{{ $user->name }}</span>
                                            </td>

                                            <td>{{ $user->age }}</td>
                                            <td>{{ ucfirst($user->gender) }}</td>
                                            <td>{{ $user->location }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($user->bio, 40) }}</td>

                                            <td>
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="action-icon text-info me-2">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>

                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="action-icon text-primary me-2">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>

                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="border-0 bg-transparent action-icon text-danger">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No users found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('selectAll').addEventListener('click', function() {
            let checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>

@endsection
