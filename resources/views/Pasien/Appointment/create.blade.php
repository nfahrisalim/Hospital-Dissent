@extends('Pasien.Layout.PasienLayout')

@section('PasienContent')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jadwalkan Janji Temu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Appointments</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pilih Waktu yang Tersedia untuk Dokter</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('pasien.appointments.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="availability_id">Pilih Waktu Ketersediaan</label>
                                    <select name="availability_id" id="availability_id" class="form-control" required>
                                        @foreach($doctorAvailabilities as $availability)
                                            <option value="{{ $availability->id }}">
                                                {{ \Carbon\Carbon::parse($availability->availability_date)->format('Y-m-d H:i') }} - 
                                                {{ \Carbon\Carbon::parse($availability->finish_time)->format('H:i') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Buat Janji Temu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
