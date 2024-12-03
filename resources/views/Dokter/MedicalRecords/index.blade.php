@extends('Dokter.Layout.DokterLayout')

@section('DokterContent')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage Medical Records</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Manage Medical Records</li>
                        </ol>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <a href="{{ route('dokter.medical_records.create') }}" class="btn btn-success">Create New Medical Record</a>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Medical Records Table</h3>

                    <div class="card-tools">
                        <form action="{{ route('dokter.medical_records.index') }}" method="GET">
                            <div class="input-group input-group-sm" style="width: 300px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="Search by patient name" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th style="width: 20%">Pasien Name</th>
                                <th style="width: 15%">Jenis Kelamin</th>
                                <th style="width: 15%">Tanggal Lahir</th>
                                <th style="width: 10%">Umur</th>
                                <th style="width: 15%">Tanggal Berobat</th>
                                <th>Tindakan Medis</th>
                                <th>Obat</th>
                                <th style="width: 20%" class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicalRecords as $record)
                                <tr>
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->pasien->name }}</td>
                                    <td>{{ $record->pasien->jenis_kelamin }}</td>
                                    <td>{{ $record->pasien->tanggal_lahir }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->pasien->tanggal_lahir)->age }} years</td>
                                    <td>{{ $record->tanggal_berobat }}</td>
                                    <td>{{ $record->tindakan_medis }}</td>
                                    <td>
                                        @foreach($record->medicines as $medicine)
                                            {{ $medicine->name }} (Stok: {{ $medicine->pivot->jumlah ?? 1 }}){{ !$loop->last ? ',' : '' }}
                                            @if($medicine->pivot->keterangan)
                                                - {{ $medicine->pivot->keterangan }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="project-actions text-right">
                                        <!-- Edit Button -->
                                        <a href="{{ route('dokter.medical_records.edit', $record->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        
                                        <!-- Detail Button -->
                                        <a href="{{ route('dokter.patients.show', $record->pasien->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('dokter.medical_records.destroy', $record->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this medical record?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
