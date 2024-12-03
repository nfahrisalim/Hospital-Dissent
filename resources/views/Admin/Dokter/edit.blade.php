@extends('Admin.Layout.AdminLayout')

@section('AdminContent')

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Doctor Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Doctor Profile</li>
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
                            <h3 class="card-title">Edit Doctor Profile</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                
                                <!-- Doctor's Photo -->
                                <div class="form-group">
                                    <label for="photo">Doctor's Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                    @if($doctor->photo)
                                        <img src="{{ asset('storage/' . $doctor->photo) }}" alt="Doctor's Photo" class="mt-2" width="100">
                                    @endif
                                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Specialization -->
                                <div class="form-group">
                                    <label for="specialization">Specialization</label>
                                    <input type="text" class="form-control" id="specialization" name="specialization" value="{{ old('specialization', $doctor->specialization) }}" required>
                                    @error('specialization') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description">{{ old('description', $doctor->description) }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Address -->
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address">{{ old('address', $doctor->address) }}</textarea>
                                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-success">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
