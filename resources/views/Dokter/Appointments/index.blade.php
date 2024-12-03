@extends('Dokter.Layout.DokterLayout')

@section('DokterContent')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Your Availability</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Appointments</li>
                    </ol>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Set Your Availability</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dokter.appointments.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="availability_date">Select Start Date</label>
                                    <input type="date" id="availability_date" name="availability_date" class="form-control" min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="availability_time">Select Start Time</label>
                                    <input type="time" id="availability_time" name="availability_time" class="form-control" required>
                                </div>
                            
                                <div class="form-group">
                                    <label for="finish_date">Select Finish Date</label>
                                    <input type="date" id="finish_date" name="finish_date" class="form-control" min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="finish_time">Select Finish Time</label>
                                    <input type="time" id="finish_time" name="finish_time" class="form-control" required>
                                </div>
                            
                                <div class="form-group">
                                    <label for="status">Select Status</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Cuti">Cuti</option>
                                        <option value="Istirahat">Istirahat</option>
                                        <option value="Darurat">Darurat</option>
                                        <option value="Operasi">Operasi</option>
                                        <option value="Rapat">Rapat</option>
                                    </select>
                                </div>
                            
                                <button type="submit" class="btn btn-primary">Set Availability</button>
                            </form>                                                      
                        </div>
                    </div>
                </div>

                <!-- Display Doctor's Availability -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Current Availability</h4>
                        </div>
                        <div class="card-body">
                            @foreach($doctorAvailabilities as $availability)
                                <div class="alert alert-info">
                                    <strong>{{ \Carbon\Carbon::parse($availability->availability_date)->format('Y-m-d H:i') }} - 
                                    {{ \Carbon\Carbon::parse($availability->finish_time)->format('Y-m-d H:i') }}</strong><br>
                                    Status: {{ $availability->status }}
                                    <form action="{{ route('dokter.appointments.destroy', $availability->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
