@extends('Pasien.Layout.PasienLayout')

@section('PasienContent')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Find Available Doctors</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Find Available Doctors</li>
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
                                <h4 class="card-title">Search for Available Doctors</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('pasien.appointments.index') }}" method="GET">
                                    @csrf
                                    <div class="form-group">
                                        <label for="date">Select Date</label>
                                        <input type="date" id="date" name="date" class="form-control" value="{{ old('date', $date ?? '') }}" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Search</button>
                                </form>

                                @if(isset($availableDoctors) && $availableDoctors->isNotEmpty())
                                    <h3 class="mt-4">Available Doctors on {{ $date }}</h3>
                                    <ul class="list-group mt-3">
                                        @foreach($availableDoctors as $doctor)
                                            <li class="list-group-item">
                                                <a href="{{ route('pasien.appointments.create', ['doctorId' => $doctor->id]) }}">
                                                    {{ $doctor->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @elseif(isset($date))
                                    <p class="mt-3">No doctors available on this date.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
