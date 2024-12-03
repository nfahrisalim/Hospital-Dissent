@extends('Dokter.Layout.DokterLayout')

@section('DokterContent')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Patient Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Patient Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Information -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">{{ $patient->name }}</h3>
                            <p class="text-muted text-center">Patient</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Age</b> <a class="float-right">{{ \Carbon\Carbon::parse($patient->tanggal_lahir)->age }} years</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Gender</b> <a class="float-right">{{ ucfirst($patient->jenis_kelamin) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Height</b> <a class="float-right">{{ $patient->height }} cm</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Weight</b> <a class="float-right">{{ $patient->weight }} kg</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Blood Type</b> <a class="float-right">{{ $patient->blood_type }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#family_contact" data-toggle="tab">Family Contact</a></li>
                                <li class="nav-item"><a class="nav-link" href="#medical_history" data-toggle="tab">Medical History</a></li>
                                <li class="nav-item"><a class="nav-link" href="#patient_details" data-toggle="tab">Patient Details</a></li>
                            </ul>
                        </div><!-- /.card-header -->

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="family_contact">
                                    <form action="{{ route('dokter.patients.updateFamilyContact', $patient->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label for="family_contact_name">Family Contact Name</label>
                                            <input type="text" class="form-control" id="family_contact_name" name="family_contact_name" value="{{ $patient->family_contact_name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="family_contact_phone">Family Contact Phone</label>
                                            <input type="text" class="form-control" id="family_contact_phone" name="family_contact_phone" value="{{ $patient->family_contact_phone }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-success">Update Family Contact</button>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="medical_history">
                                    <div class="timeline timeline-inverse">
                                        @foreach($patient->medicalRecords as $record)
                                            <div class="time-label">
                                                <span class="bg-primary">
                                                    {{ \Carbon\Carbon::parse($record->tanggal_berobat)->format('d M, Y') }}
                                                </span>
                                            </div>

                                            <div>
                                                <i class="fas fa-notes-medical bg-info"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($record->tanggal_berobat)->format('H:i') }}</span>
                                                    <h3 class="timeline-header">Medical Action: {{ $record->tindakan_medis }}</h3>
                                                    <div class="timeline-body">
                                                        Medicines Prescribed:
                                                        <ul>
                                                            @foreach($record->medicines as $medicine)
                                                                <li>{{ $medicine->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="patient_details">
                                    <form action="{{ route('dokter.patients.updateDetails', $patient->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label for="height">Height (cm)</label>
                                            <input type="number" class="form-control" id="height" name="height" value="{{ $patient->height }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="weight">Weight (kg)</label>
                                            <input type="number" class="form-control" id="weight" name="weight" value="{{ $patient->weight }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="blood_type">Blood Type</label>
                                            <input type="text" class="form-control" id="blood_type" name="blood_type" value="{{ $patient->blood_type }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-success">Update Patient Details</button>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>

@endsection
