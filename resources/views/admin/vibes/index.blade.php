@extends('admin.layouts.master')

@section('title', 'Vibes')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                {{-- Success Alert --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show auto-dismiss">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Error / Danger Alert --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show auto-dismiss">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show auto-dismiss">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
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

                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input toggle-status" type="checkbox"
                                                            data-id="{{ $vibe->id }}"
                                                            {{ $vibe->status == 'active' ? 'checked' : '' }}>
                                                    </div>

                                                    <span
                                                        class="badge status-badge 
                                                        {{ $vibe->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ ucfirst($vibe->status) }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td>
                                                <a href="{{ route('vibes.edit', $vibe->id) }}"
                                                    class="action-icon text-primary me-2">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>

                                                <form action="{{ route('vibes.destroy', $vibe->id) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Are you sure?');">
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
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.toggle-status').forEach(function(element) {

                element.addEventListener('change', function() {

                    let vibeId = this.getAttribute('data-id');
                    let checkbox = this;
                    let badge = this.closest('td').querySelector('.status-badge');

                    fetch("{{ route('vibes.toggleStatus', ':id') }}".replace(':id', vibeId), {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            }
                        })
                        .then(response => response.json())
                        .then(data => {

                            if (data.status === 'active') {
                                badge.classList.remove('bg-danger');
                                badge.classList.add('bg-success');
                                badge.innerText = 'Active';
                            } else {
                                badge.classList.remove('bg-success');
                                badge.classList.add('bg-danger');
                                badge.innerText = 'Inactive';
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Status Updated',
                                text: 'Vibe is now ' + data.status,
                                timer: 1500,
                                showConfirmButton: false
                            });

                        });

                });

            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let alerts = document.querySelectorAll('.auto-dismiss');

            alerts.forEach(function(alert) {
                setTimeout(function() {
                    let bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 3000);
            });

        });
    </script>
@endsection
