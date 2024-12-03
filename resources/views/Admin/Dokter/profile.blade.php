@extends('Admin.Layout.AdminLayout')

@section('AdminContent')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Doctor Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Doctor Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Doctor Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $doctor->photo) }}" alt="Doctor Photo" width="100%" class="img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    <h4>{{ $doctor->name }}</h4>
                                    <p><strong>Specialization:</strong> {{ $doctor->specialization }}</p>
                                    <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($doctor->birthdate)->age }} years</p>
                                    <p><strong>Description:</strong> {{ $doctor->description ?? 'No description available' }}</p>
                                    <p><strong>Address:</strong> {{ $doctor->address ?? 'No address provided' }}</p>
                                </div>
                            </div>
                            <hr>
                            <a href="/admin/doctors/{{ $doctor->id }}/edit" class="btn btn-warning">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
