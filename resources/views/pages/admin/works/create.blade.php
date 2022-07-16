{{-- mengkoneksikan ke layout/admin --}}
@extends('layouts.admin')

{{-- memasukkan kontent --}}
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Paket Travel</h1>
    </div>

    {{-- nonttifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>                
                @endforeach
            </ul>
        </div>
        
    @endif
   <div class="card shadow">
       <div class="card-body">
            {{-- must used enctype="multipart/form-data" for uplod image --}}
           <form action="{{route('works.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter your project title" value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" class="form-control" name="role" placeholder="Enter your role" value="{{old('role')}}">
                </div>
                <div class="form-group">
                    <label for="description">Project Description</label>
                    <textarea name="description" id="description" rows="10" placeholder="Enter project description" class="d-block w-100 form-control">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="text" class="form-control" name="year" placeholder="Enter the year the project was created" value="{{old('year')}}">
                </div>
                <div class="form-group">
                    <label for="image">Choose Image (Max 2 MB)</label>
                    <input type="file" name="image" class="form-control" placeholder="image" value="{{ old('image') }}">
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-5 mb-3">
                    Simpan
                </button>
            </form>
       </div>
   </div>
    
</div>
<!-- /.container-fluid -->
@endsection