@extends('Dokter.Layout.DokterLayout')

@section('DokterContent')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Doctor Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Doctor Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <!-- Display doctor's profile picture -->
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ asset('storage/images/'.$doctor->photo) }}" 
                                     alt="Doctor profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $doctor->name }}</h3>
                            <p class="text-muted text-center">{{ $doctor->specialization }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Gender</b> <a class="float-right">{{ $doctor->gender }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Age</b> <a class="float-right">{{ \Carbon\Carbon::parse($doctor->birthdate)->age }} years</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Experience</b> <a class="float-right">{{ $doctor->years_of_experience }} years</a>
                                </li>
                            </ul>

                            <a href="{{ route('doctor.edit', $doctor->id) }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>
                            <p class="text-muted">{{ $doctor->education }}</p>

                            <hr>

                            <strong><i class="fas fa-award mr-1"></i> Achievements</strong>
                            <p class="text-muted">{{ $doctor->achievements }}</p>

                            <hr>

                            <strong><i class="fas fa-cogs mr-1"></i> Specialization</strong>
                            <p class="text-muted">{{ $doctor->specialization }}</p>

                            <hr>

                            <strong><i class="fas fa-calendar-check mr-1"></i> Medical Experience</strong>
                            <p class="text-muted">{{ $doctor->medical_experience }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activities</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Patient Testimonials</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Activities Tab -->
                                <div class="active tab-pane" id="activity">
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="{{ asset('storage/images/'.$doctor->photo) }}" alt="doctor image">
                                            <span class="username">
                                                <a href="#">{{ $doctor->name }}</a>
                                            </span>
                                            <span class="description">Shared activity - {{ $doctor->last_activity_date }}</span>
                                        </div>
                                        <p>{{ $doctor->recent_activity }}</p>
                                    </div>
                                </div>

                                <!-- Testimonials Tab -->
                                <div class="tab-pane" id="timeline">
                                    @foreach($doctor->testimonials as $testimonial)
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="{{ asset('storage/images/'.$testimonial->patient_photo) }}" alt="patient image">
                                                <span class="username">
                                                    <a href="#">{{ $testimonial->patient_name }}</a>
                                                </span>
                                                <span class="description">{{ $testimonial->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p>{{ $testimonial->message }}</p>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Settings Tab -->
                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" action="{{ route('doctor.update', $doctor->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" name="name" value="{{ $doctor->name }}" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail" name="email" value="{{ $doctor->email }}" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div><!-- /.content-wrapper -->
