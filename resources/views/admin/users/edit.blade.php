@extends('admin.layouts.master')

@section('title', 'Edit User')

@section('content')
<main class="content-page">
    <div class="content mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm">
                        <div class="card-body">

                            <h4 class="mb-4 text-center">Edit User</h4>

                            {{-- Alerts --}}
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session('success') }}
                                    <button class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">

                                    {{-- Full Name --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    {{-- Age --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Age</label>
                                        <input type="number" name="age" class="form-control"
                                               value="{{ old('age', $user->age) }}">
                                    </div>

                                    {{-- Gender --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-select">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                               value="{{ old('email', $user->email) }}">
                                    </div>

                                    {{-- Profile Photo --}}
                                    <div class="col-12">
                                        <label class="form-label">Profile Photo</label>
                                        <div class="mb-2">
                                            @if($user->profile_photo)
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ asset('storage/'.$user->profile_photo) }}" class="rounded avatar-md img-thumbnail" alt="photo">
                                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                                            id="remove_photo" style="border-radius:50%; padding:2px 6px;">×</button>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="file" name="profile_photo" class="form-control" accept="image/*">
                                        <input type="hidden" name="remove_photo" id="remove_photo_input" value="0">
                                    </div>

                                    {{-- Location --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Location</label>
                                        <input type="text" name="location" class="form-control"
                                               value="{{ old('location', $user->location) }}">
                                    </div>

                                    {{-- Height --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Height</label>
                                        <input type="text" name="height" class="form-control"
                                               value="{{ old('height', $user->height) }}">
                                    </div>

                                    {{-- Weight --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Weight</label>
                                        <input type="text" name="weight" class="form-control"
                                               value="{{ old('weight', $user->weight) }}">
                                    </div>

                                    {{-- Vibe ID --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Vibe ID</label>
                                        <input type="text" name="vibe_id" class="form-control"
                                               value="{{ old('vibe_id', $user->vibe_id) }}">
                                    </div>

                                    {{-- Instagram --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Instagram URL</label>
                                        <input type="text" name="instagram_url" class="form-control"
                                               value="{{ old('instagram_url', $user->instagram_url) }}">
                                    </div>

                                    {{-- Active --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Active</label>
                                        <select name="is_active" class="form-select">
                                            <option value="1" {{ old('is_active', $user->is_active) ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ !old('is_active', $user->is_active) ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>

                                    {{-- Buttons --}}
                                    <div class="col-12 text-end mt-4">
                                        <button class="btn btn-primary">Update</button>
                                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Back</a>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- JS for remove profile photo --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const removeBtn = document.getElementById('remove_photo');
    const removeInput = document.getElementById('remove_photo_input');
    if(removeBtn) {
        removeBtn.addEventListener('click', () => {
            removeInput.value = 1; // mark for removal
            removeBtn.parentElement.remove();
        });
    }
});
</script>
@endsection