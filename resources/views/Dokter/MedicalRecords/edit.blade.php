@extends('Dokter.Layout.DokterLayout')
@section('DokterContent')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Medical Record</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Medical Record</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Medical Record</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dokter.medical_records.update', $medicalRecord->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="pasien_id">Pasien</label>
                            <select class="form-control" id="pasien_id" name="pasien_id" required>
                                <option value="" disabled>Select a patient</option>
                                @foreach($pasiens as $pasien)
                                    <option value="{{ $pasien->id }}" {{ $pasien->id == $medicalRecord->pasien_id ? 'selected' : '' }}>{{ $pasien->name }} ({{ $pasien->tanggal_lahir }} - {{ $pasien->jenis_kelamin }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_berobat">Tanggal Berobat</label>
                            <input type="date" class="form-control" id="tanggal_berobat" name="tanggal_berobat" value="{{ $medicalRecord->tanggal_berobat }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tindakan_medis">Tindakan Medis</label>
                            <textarea class="form-control" id="tindakan_medis" name="tindakan_medis" rows="4" required>{{ $medicalRecord->tindakan_medis }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="medicines">Obat</label>
                            <select class="form-control select2" id="medicines" name="medicines[]" multiple="multiple" required>
                                @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}" {{ in_array($medicine->id, $medicalRecord->medicines->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $medicine->name }} (Expires: {{ $medicine->expiration_date }})</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('dokter.medical_records.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
