@extends('Pasien.Layout.PasienLayout')

@section('PasienContent')

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pesan Obat</h1>
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
                            <h3 class="card-title">Pesan Obat untuk Rekam Medis Terbaru</h3>
                        </div>
                        <div class="card-body">
                            <!-- Tampilkan notifikasi jika ada -->
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif

                            <!-- Form Pemesanan Obat -->
                            <form action="{{ route('pasien.medicine_order.store', ['medicalRecordId' => $medicalRecord->id]) }}" method="POST">
                                @csrf
                                
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Obat</th>
                                            <th>Stok Tersedia</th>
                                            <th>Pemesanan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($prescribedMedicines as $medicine)
                                            <tr>
                                                <td>{{ $medicine->name }}</td>
                                                <td>{{ $medicine->stok }}</td>
                                                <td>
                                                    <input type="hidden" name="medicine_id[]" value="{{ $medicine->id }}">
                                                    <input type="number" name="quantity[{{ $medicine->id }}]" min="1" max="{{ $medicine->stok }}" class="form-control" required>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Notifikasi sebelum memesan -->
                                <div class="alert alert-info">
                                    Pastikan data yang Anda masukkan sudah benar sebelum memesan.
                                </div>

                                <button type="submit" class="btn btn-primary">Pesan Obat</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
