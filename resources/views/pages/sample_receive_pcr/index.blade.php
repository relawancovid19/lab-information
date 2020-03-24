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
            <a href="{{ route('sample_receive_pcr.create') }}" class="btn btn-primary"><i class="fas fa-plus pr-1"></i> Sampel Baru</a>
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
                                <th class="text-center">Waktu penerimaan sampel RNA</th>
                                <th class="text-center">Penerima Sampel</th>
                                <th class="text-center">Operator PCR</th>
                                <th class="text-center">Hasil Deteksi</th>
                                <th class="text-center">Kesimpulan Pemeriksaan</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sampleReceivePcrs as $key => $sampleReceivePcr)
                            <tr>
                                <td class="align-middle text-center">{{ $key+1 }}</td>
                                <td class="align-middle">{{ $sampleReceivePcr->registration->registration_number }}</td>
                                <td class="align-middle">{{ \Carbon\Carbon::parse($sampleReceivePcr->rna_datetime)->format('d/m/Y H:i') }}</td>
                                <td class="align-middle">{{ $sampleReceivePcr->sampling_officer }}</td>
                                <td class="align-middle">{{ $sampleReceivePcr->pcr_operator }}</td>
                                <td class="align-middle">{{ $sampleReceivePcr->result }}</td>
                                <td class="align-middle">{{ \App\Models\SampleReceivePcr::getConclusionLabel()[$sampleReceivePcr->conclusion] }}</td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('sample_receive_pcr.show', $sampleReceivePcr->getKey()) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Lihat Data"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('sample_receive_pcr.edit', $sampleReceivePcr->getKey()) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit Data"><i class="fas fa-edit"></i></a>
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
