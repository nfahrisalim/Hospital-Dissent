@extends('Admin.Layout.AdminLayout')

@section('AdminContent')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Doctors</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Doctors</li>
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
                            <h3 class="card-title">Doctor Management Table</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Specialization</th>
                                        <th>Age</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($doctors as $doctor)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ asset('storage/' . $doctor->photo) }}" alt="Doctor Photo" width="50"></td>
                                            <td>{{ $doctor->name }}</td>
                                            <td>{{ $doctor->specialization }}</td>
                                            <td>{{ \Carbon\Carbon::parse($doctor->birthdate)->age }}</td>
                                            <td>
                                                <a href="/admin/doctors/{{ $doctor->id }}" class="btn btn-info btn-sm">View Profile</a>
                                                <a href="/admin/doctors/{{ $doctor->id }}/edit" class="btn btn-primary btn-sm">Edit Profile</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
