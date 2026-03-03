@extends('admin.layouts.master')

@section('title')
    Dashboard
@endsection

@push('styles')
    <style>
        .card-label {
            font-size: 10px;
        }
    </style>
@endpush

@section('content')
    <?php $user = auth()->user(); ?>

    <main class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            @if ($user && ($user->role == 1 || $user->role == 2))
                                <h4 class="page-title">Dashboard</h4>
                            @else
                                <h4 class="page-title">Admin Dashboard</h4>
                            @endif
                        </div>
                    </div>
                </div>

                @if (auth('admin')->check())
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-blue rounded shadow-lg">
                                                <i class="fe-user avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <h3 class="text-dark my-1">
                                                <span data-plugin="counterup">{{ $userCount }}</span>
                                            </h3>
                                            <p class="text-muted mb-0 card-label">Users</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-success rounded shadow-lg">
                                                <i class="fe-shield avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <h3 class="text-dark my-1">
                                                <span data-plugin="counterup">{{ $adminCount }}</span>
                                            </h3>
                                            <p class="text-muted mb-0 card-label">Admins</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Income Amounts</h4>
                                <div class="text-center pt-3">
                                    <div id="income-amounts" data-colors="#00acc1"></div>
                                    <div class="row mt-3 text-center">
                                        <div class="col-4">
                                            <p class="text-muted mb-1">Target</p>
                                            <h4>641</h4>
                                        </div>
                                        <div class="col-4">
                                            <p class="text-muted mb-1">Last week</p>
                                            <h4>234</h4>
                                        </div>
                                        <div class="col-4">
                                            <p class="text-muted mb-1">Last Month</p>
                                            <h4>3201</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Total Users</h4>
                                <div class="text-center pt-3">
                                    <div id="total-users" data-colors="#00acc1,#4b88e4,#e3eaef,#fd7e14"></div>
                                    <div class="row mt-3 text-center">
                                        <div class="col-4">
                                            <p class="text-muted mb-1">Target</p>
                                            <h4>18k</h4>
                                        </div>
                                        <div class="col-4">
                                            <p class="text-muted mb-1">Last week</p>
                                            <h4>3.25k</h4>
                                        </div>
                                        <div class="col-4">
                                            <p class="text-muted mb-1">Last Month</p>
                                            <h4>28k</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

@push('scripts')
@endpush
