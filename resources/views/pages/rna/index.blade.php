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
                <h1 class="m-0 text-dark">Data Ekstrasi RNA</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('login') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Ekstrasi RNA</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="text-right">
            <a href="{{ route('sample_receive_taking.create') }}" class="btn btn-primary"><i class="fas fa-plus pr-1"></i> Data Baru</a>
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
                                <th class="text-center">Waktu Diterima</th>
                                <th class="text-center">Waktu Extrasi</th>
                                <th class="text-center">Operator Ekstrasi</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rnas as $key => $rna)
                            <tr>
                                <td class="align-middle text-center">{{ $key+1 }}</td>
                                <td class="align-middle">{{ $rna->taken_date_time }}</td>
                                <td class="align-middle">{{ $rna->extraction_started_date_time }}</td>
                                <td class="align-middle">{{ $rna->extraction_operator }}</td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('rna.show', $rna->getKey()) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Lihat Data"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('rna.edit', $rna->getKey()) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit Data"><i class="fas fa-edit"></i></a>
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
