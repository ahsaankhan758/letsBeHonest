@extends('admin.layouts.master')

@section('title', 'Vibes')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Vibes List</h4>

                    <!-- Add Button -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVibeModal">
                        Add Vibe
                    </button>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-centered table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th width="120">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($vibes as $vibe)
                                        <tr>
                                            <td>{{ $vibe->name }}</td>
                                            <td>{{ ucfirst($vibe->status) }}</td>
                                            <td>
                                                <!-- Edit Icon -->
                                                <a href="{{ route('vibes.edit', $vibe->id) }}"
                                                    class="action-icon text-primary me-2">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>

                                                <!-- Delete Icon with confirmation -->
                                                <form action="{{ route('vibes.destroy', $vibe->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this vibe?');">
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
                                            <td colspan="3" class="text-center">No vibes found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $vibes->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Add Modal -->
    <div class="modal fade" id="addVibeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('vibes.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Add Vibe</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Status</label><br>
                            <input type="radio" name="status" value="active" checked> Active
                            <input type="radio" name="status" value="inactive"> Inactive
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
