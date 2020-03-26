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
                <h1 class="m-0 text-dark">Data Sampel</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('login') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Sampel</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="text-right">
            <a href="{{ route('rdt_recording.create') }}" class="btn btn-primary"><i class="fas fa-plus pr-1"></i> Sampel Baru</a>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default color-palette-box">
            <div class="card-body">
                @if($errors->all())
                <div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i>
                    <b>Ups!</b>
                        @foreach($errors->all() as $error)
                        <br/>{{$error}}
                        @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check"></i>
                    <b>Berhasil!</b>
                    @foreach(session('success') as $success)
                        <br/>{{$success}}
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No.</th>
                                <th class="text-center">Pasien</th>
                                <th class="text-center">Tanggal Pertama Demam</th>
                                <th class="text-center">Hasil Tes Serum #1</th>
                                <th class="text-center">Hasil Tes Whole Blood #1</th>
                                <th class="text-center">Hasil Tes Serum #2</th>
                                <th class="text-center">Hasil Tes Whole Blood #2</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list??[] as $rdt)
                            <tr>
                                <td class="align-middle text-center">{{ $key+1 }}</td>
                                <td class="align-middle">{{ $rdt->patient->fullname }}</td>
                                <td class="align-middle">{{ date('d F Y',strtotime($rdt->date_fever_first)) }}</td>
                                <td class="align-middle">{{ $convert($rdt->first_serum_result) }}</td>
                                <td class="align-middle">{{ $convert($rdt->first_whole_blood_result) }}</td>
                                <td class="align-middle">{{ $convert($rdt->second_serum_result) }}</td>
                                <td class="align-middle">{{ $convert($rdt->second_whole_blood_result) }}</td>
                                <td class="align-middle" style="width: 75px">
                                    <a href="{{ route('rdt_recording.show', $rdt->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Lihat Data"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('rdt_recording.edit', $rdt->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit Data"><i class="fas fa-edit"></i></a>
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
