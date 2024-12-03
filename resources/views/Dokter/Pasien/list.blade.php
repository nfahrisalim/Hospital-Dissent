@extends('Dokter.Layout.DokterLayout')

@section('DokterContent')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Patient List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Patient List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- Search Bar -->
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="patient_search" class="form-control float-right" placeholder="Search Patient" id="search-patient">
                            <div class="input-group-append">
                                <button class="btn btn-default" type="submit" onclick="searchPatient()">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Patient Management Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                        </tr>
                                    </thead>
                                    <tbody id="patient-list">
                                        @foreach($patients as $patient)
                                            <tr>
                                                <td><a href="{{ route('dokter.patients.show', $patient->id) }}">{{ $patient->name }}</a></td>
                                                <td>{{ \Carbon\Carbon::parse($patient->dob)->age }} years</td>
                                                <td>{{ $patient->jenis_kelamin }}</td> <!-- Display the actual gender value -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Optional: Add custom search logic (this can be further optimized with AJAX) -->
    <script>
        function searchPatient() {
            const searchQuery = document.getElementById('search-patient').value.toLowerCase();
            const rows = document.querySelectorAll('#patient-list tr');
            
            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const age = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const gender = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                if (name.includes(searchQuery) || age.includes(searchQuery) || gender.includes(searchQuery)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
@endsection
