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
                        <input type="text" name="name" class="form-control" value="{{ $vibe->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label><br>
                        <input type="radio" name="status" value="active" {{ $vibe->status == 'active' ? 'checked' : '' }}>
                        Active
                        <input type="radio" name="status" value="inactive" {{ $vibe->status == 'inactive' ? 'checked' : '' }}>
                        Inactive
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>

            </div>
        </div>
    </div>
        </div>
      </main>

@endsection
