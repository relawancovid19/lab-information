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
                    <li class="breadcrumb-item"><a href="{{ route('login') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Registrasi</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="text-right">
            <a href="{{ route('login') }}" class="btn btn-primary"><i class="fas fa-plus pr-1"></i> Registrasi Baru</a>
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
                                <th class="text-center">No. Registrasi</th>
                                <th class="text-center">Sampel Diambil</th>
                                <th class="text-center">Sampel Diambil Dari Fasyankes</th>
                                <th class="text-center">Penerima Sampel</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sampleReceiveTakings as $key => $sampleReceiveTaking)
                            <tr>
                                <td class="align-middle text-center">{{ $key+1 }}</td>
                                <td class="align-middle">{{ $sampleReceiveTaking->registrationNumber }}</td>
                                <td class="align-middle">{{ $sampleReceiveTaking->sampleTaken ? "Ya" : "Tidak" }}</td>
                                <td class="align-middle">{{ $sampleReceiveTaking->sampleTakenFromFasyankes ? "Ya" : "Tidak" }}</td>
                                <td class="align-middle">{{ $sampleReceiveTaking->sampleReceiverOfficer }}</td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('sample_receive_taking.show', $sampleReceiveTaking->getKey()) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Lihat Data"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('sample_receive_taking.edit', $sampleReceiveTaking->getKey()) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit Data"><i class="fas fa-edit"></i></a>
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
