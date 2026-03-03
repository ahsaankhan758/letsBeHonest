@extends('admin.layouts.master')

@section('title', 'User Details')

@section('content')
<main class="content-page">
    <div class="content mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card text-center">
                        <div class="card-body">

                            <img src="{{ $user->profile_photo ? asset('storage/'.$user->profile_photo) : asset('admin/assets/images/user.png') }}"
                                 class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                            <h4 class="mb-0">{{ $user->name ?? 'N/A' }}</h4>
                            {{-- <p class="text-muted">{{ '@'.$user->name ?? 'N/A' }}</p> --}}

                            <div class="text-start mt-3">
                                <h4 class="font-13 text-uppercase">About Me :</h4>
                                <p class="text-muted font-13 mb-3">
                                    {{ $user->bio ?? 'N/A' }}
                                </p>

                                <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">{{ $user->name ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Age :</strong> <span class="ms-2">{{ $user->age ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Gender :</strong> <span class="ms-2">{{ $user->gender ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2">{{ $user->email ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Location :</strong> <span class="ms-2">{{ $user->location ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Height :</strong> <span class="ms-2">{{ $user->height ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Weight :</strong> <span class="ms-2">{{ $user->weight ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Vibe ID :</strong> <span class="ms-2">{{ $user->vibe_id ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Interested :</strong> <span class="ms-2">{{ $user->interested ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Brings You Here :</strong> <span class="ms-2">{{ $user->brings_you_here ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>See Yourself :</strong> <span class="ms-2">{{ $user->see_yourself ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Gets You Excited :</strong> <span class="ms-2">{{ $user->gets_you_excited ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Open To :</strong> <span class="ms-2">{{ $user->open_to ?? 'N/A' }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Instagram URL :</strong> <span class="ms-2">{{ $user->instagram_url ?? 'N/A' }}</span></p>
                                {{-- <p class="text-muted mb-2 font-13"><strong>Profile Photo :</strong> <span class="ms-2">{{ $user->profile_photo ? 'Uploaded' : 'N/A' }}</span></p> --}}
                                <p class="text-muted mb-2 font-13"><strong>Active :</strong> <span class="ms-2">{{ $user->is_active ? 'Yes' : 'No' }}</span></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection