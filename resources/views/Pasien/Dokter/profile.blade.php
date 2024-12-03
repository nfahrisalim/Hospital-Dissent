@extends('Pasien.Layout.PasienLayout')

@section('PasienContent')

<div class="content-wrapper">
    <!-- Doctor Profile Section -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profil Dokter</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profil Dokter</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Doctor Information -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Doctor Profile Picture -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/' . $doctor->photo) }}" alt="Doctor Profile Picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $doctor->name }}</h3>
                            <p class="text-muted text-center">{{ $doctor->specialization }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Usia</b> <a class="float-right">{{ \Carbon\Carbon::parse($doctor->birthdate)->age }} tahun</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Deskripsi</b> <a class="float-right">{{ $doctor->description ?? 'Tidak ada deskripsi' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Alamat</b> <a class="float-right">{{ $doctor->address ?? 'Tidak ada alamat yang diberikan' }}</a>
                                </li>
                            </ul>
                            <a href="{{ route('pasien.testimonials.create', ['doctorId' => $doctor->id]) }}" class="btn btn-primary btn-block">Tambah Testimoni</a>
                        </div>
                    </div>
                </div>

                <!-- Doctor Testimonials Section -->
                <div class="col-md-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Testimoni Pasien</h3>
                        </div>
                        <div class="card-body">
                            @if($doctor->testimonials && $doctor->testimonials->isNotEmpty())
                                @foreach ($doctor->testimonials as $testimonial)
                                    <div class="media">
                                        <img class="mr-3" src="https://via.placeholder.com/50" alt="Patient Avatar">
                                        <div class="media-body">
                                            <h5 class="mt-0">{{ $testimonial->user->name }}</h5>
                                            <p>{{ $testimonial->testimoni }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            @else
                                <p>Belum ada testimoni dari pasien.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
