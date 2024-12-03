@extends('Pasien.Layout.PasienLayout')

@section('PasienContent')

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Rekam Medis Pasien</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Rekam Medis</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Rekam Medis</h3>
                        </div>
                        <div class="card-body">
                            @if($medicalRecords->isEmpty())
                                <p class="text-center">Tidak ada rekam medis yang ditemukan.</p>
                            @else
                                <h4>Rekam Medis Terbaru:</h4>
                                @if($latestMedicalRecord)
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Berobat</th>
                                                <th>Tindakan Medis</th>
                                                <th>Obat yang Diberikan</th>
                                                <th>Dokter yang Bertanggung Jawab</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $latestMedicalRecord->tanggal_berobat }}</td>
                                                <td>{{ $latestMedicalRecord->tindakan_medis }}</td>
                                                <td>
                                                    @foreach($latestMedicalRecord->medicines as $medicine)
                                                        <div>
                                                            <strong>{{ $medicine->name }}</strong><br>
                                                            @if($medicine->image)
                                                                <img src="{{ asset('storage/' . $medicine->image) }}" alt="{{ $medicine->name }}" width="50" height="50">
                                                            @endif
                                                            <p>{{ $medicine->pivot->jumlah }} pcs</p>
                                                            <p>{{ $medicine->pivot->keterangan }}</p>
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($latestMedicalRecord->dokter->photo)
                                                            <img src="{{ asset('storage/' . $latestMedicalRecord->dokter->photo) }}" alt="{{ $latestMedicalRecord->dokter->name }}" width="40" height="40" class="img-circle mr-2">
                                                        @else
                                                            <img src="{{ asset('images/default-profile.png') }}" alt="Default Photo" width="40" height="40" class="img-circle mr-2">
                                                        @endif
                                                        {{ $latestMedicalRecord->dokter->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <!-- Tombol untuk pemesanan obat -->
                                                    <a href="{{ route('pasien.medicine_order.create', $latestMedicalRecord->id) }}" class="btn btn-primary">Pesan Obat</a>

                                                    <!-- Tombol untuk melihat status pesanan -->
                                                    @if($latestMedicalRecord->medicineOrders->isNotEmpty())
                                                        <a href="{{ route('pasien.medicine_order.index', ['medicalRecordId' => $latestMedicalRecord->id]) }}" class="btn btn-info ml-2">Lihat Status Pesanan</a>
                                                    @else
                                                        <button class="btn btn-secondary ml-2" disabled>Tidak Ada Pesanan</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-center">Tidak ada rekam medis terbaru ditemukan.</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
