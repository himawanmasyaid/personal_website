@extends('layouts.admin')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Work History</h1>
            {{--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>  --}}
            <a href="{{ route('works.create')}}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-sm text-white">Tambah Data</i>
            </a>
        </div>

        <div class="row">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-bordered" width="100%" collspacing="0">
                        <thread>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Role</th>
                                <th>Year</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thread>
                        <tbody>
                        {{-- foreach duakondisi, jika ada tampilkan data, jika tidak tampilkan apa --}}
                        @forelse ($items as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->role}}</td>
                                <td>{{$item->year}}</td>
                                <td>
                                    <img src="{{ Storage::url($item->image) }}" alt="" style="width:150px" class="img-thumbnail">
                                </td>
                                <td class="text-center">
                                    <a href="{{route('works.edit',$item->id)}}" class="btn btn-info">
                                    <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    {{--  <form action="{{route('works.destroy',$item->id)}}" method="post" class="d-inline"> 
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Data Kosong
                                </td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

