@extends('Pasien.Layout.PasienLayout')

@section('PasienContent')

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Testimoni</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Testimoni</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial Form -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Testimoni</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pasien.testimonials.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="patient_name">Nama Pasien</label>
                                    <input type="text" name="patient_name" id="patient_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="content">Testimoni</label>
                                    <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
                                </div>
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}"> <!-- Hidden field for doctor_id -->
                                <button type="submit" class="btn btn-primary">Kirim Testimoni</button>
                            </form>                                                                                                                                                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
