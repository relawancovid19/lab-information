@extends('layouts.app')

@section('extend-css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Registrasi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Registrasi</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div>
            @if(session('msg'))
                <div class="alert alert-info" role="alert">
                    {{ session('msg') }}
                </div>
            @endif
        </div>
        <div class="text-right">
            <a href="{{ route('registrations.create') }}" class="btn btn-primary"><i class="fas fa-plus pr-1"></i> Registrasi Baru</a>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default color-palette-box">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No.</th>
                                <th class="text-center">NIK</th>
                                <th class="text-center">No. Registrasi</th>
                                <th class="text-center">No. Sample</th>
                                <th class="text-center">Tanggal Registrasi</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registrations as $key => $register)
                            <tr>
                                <td class="align-middle text-center">{{ $key+1 }}</td>
                                <td class="align-middle">{{ $register->patient->nik }}</td>
                                <td class="align-middle">{{ $register->registration_number }}</td>
                                <td class="align-middle">{{ $register->sample_number }}</td>
                                <td class="align-middle">{{ \Carbon\Carbon::parse($register->registration_date)->format('d/m/Y') }}</td>
                                <td class="align-middle text-center">
                                    <form action="{{ route('registrations.destroy', $register->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('registrations.show', $register->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Lihat Data"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('registrations.edit', $register->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit Data"><i class="fas fa-edit"></i></a>
                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete Data"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extend-js')
<!-- DataTables -->
<script src="{{ url('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
    $("#datatable").DataTable();
</script>
@endsection
