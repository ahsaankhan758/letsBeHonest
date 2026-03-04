@extends('admin.layouts.master')

@section('title', 'Edit Vibe')

@section('content')

    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">

                        <h4>Edit Vibe</h4>

                        <form method="POST" action="{{ route('vibes.update', $vibe->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $vibe->name }}"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted mb-2">Status</label>

                                <div class="p-3 rounded-3 border d-flex align-items-center justify-content-between"
                                    style="background: #f8f9fa;">

                                    <span class="fw-semibold">Current Status</span>

                                    @if ($vibe->status == 'active')
                                        <span class="badge rounded-pill bg-success px-3 py-2">
                                            <i class="mdi mdi-check-circle me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-danger px-3 py-2">
                                            <i class="mdi mdi-close-circle me-1"></i> Inactive
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                            <button href="{{ route('vibes.index') }}" class="btn btn-light"> Back
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
