@extends('layouts.app')

@section('extend-css')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <style>
        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        .boxSizingBorder {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;

            width: 100%;
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pengambilan / Penerimaan Sampel</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sample_receive_pcr.index') }}">Pengambilan / Penerimaan Sampel</a></li>
                        <li class="breadcrumb-item active">Detail Data</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="text-right">
                <a href="{{ route('sample_receive_pcr.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left pr-1"></i> Kembali</a>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <form id="pengambilanPenerimaanSampelForm" class="form-horizontal" action="{{ route('sample_receive_pcr.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="registration_id" class="col-sm-3 col-form-label">No. Registrasi</label>
                            <div class="col-sm-9">
                                {{ $sampleReceivePcr->registration->registration_number }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sample_number" class="col-sm-3 col-form-label">No. Sampel</label>
                            <div class="col-sm-9">
                                {{ $sampleReceivePcr->sample_number }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rna_date" class="col-sm-3 col-form-label">Tanggal penerimaan sampel RNA</label>
                            <div class="col-sm-9">
                                {{ \Carbon\Carbon::parse($sampleReceivePcr->rna_datetime)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rna_time" class="col-sm-3 col-form-label">Jam penerimaan sampel</label>
                            <div class="col-sm-9">
                                {{ \Carbon\Carbon::parse($sampleReceivePcr->rna_datetime)->format('H:i') }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Laboratorium penerima sampel</label>
                            <div class="col-sm-9">
                                {{ $sampleReceivePcr->from_lab }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sampling_officer" class="col-sm-3 col-form-label">Petugas penerima sampel</label>
                            <div class="col-sm-9">
                                {{ $sampleReceivePcr->sampling_officer }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pcr_operator" class="col-sm-3 col-form-label">Operator PCR</label>
                            <div class="col-sm-9">
                                {{ $sampleReceivePcr->pcr_operator }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="check_start_date" class="col-sm-3 col-form-label">Tanggal mulai pemeriksaan</label>
                            <div class="col-sm-9">
                                {{ \Carbon\Carbon::parse($sampleReceivePcr->check_start_datetime)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="check_start_time" class="col-sm-3 col-form-label">Jam mulai pemeriksaan</label>
                            <div class="col-sm-9">
                                {{ \Carbon\Carbon::parse($sampleReceivePcr->check_start_datetime)->format('H:i') }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="check_type" class="col-sm-3 col-form-label">Metode pemeriksaan</label>
                            <div class="col-sm-9">
                                {{ $sampleReceivePcr->check_type }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="check_kit" class="col-sm-3 col-form-label">Nama kit pemeriksaan</label>
                            <div class="col-sm-9">
                                {{ $sampleReceivePcr->check_kit }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gen_target" class="col-sm-3 col-form-label">Target gen</label>
                            <div class="col-sm-9">
                                {{ $sampleReceivePcr->gen_target }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="check_finish_date" class="col-sm-3 col-form-label">Tanggal selesai pemeriksaan</label>
                            <div class="col-sm-9">
                                {{ \Carbon\Carbon::parse($sampleReceivePcr->check_finish_datetime)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="check_finish_time" class="col-sm-3 col-form-label">Jam selesai pemeriksaan</label>
                            <div class="col-sm-9">
                                {{ \Carbon\Carbon::parse($sampleReceivePcr->check_finish_datetime)->format('H:i') }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="result" class="col-sm-3 col-form-label">Hasil deteksi</label>
                            <div class="col-sm-9">
                                {{ $sampleReceivePcr->result }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kesimpulan pemeriksaan</label>
                            <div class="col-sm-9">
                                {{ \App\Models\SampleReceivePcr::getConclusionLabel()[$sampleReceivePcr->conclusion] }}
                            </div>
                        </div>

                        <div class="row">
                            <label for="notes" class="col-sm-3 col-form-label">Catatan</label>
                            <div class="col-sm-9">
                                {{ $sampleReceivePcr->notes }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extend-js')
    <!-- Moment Js -->
    <script src="{{ url('plugins/moment/moment.min.js') }}"></script>

    <!-- Datetime Picker -->
    <script src="{{ url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js') }}"></script>
    <script>
        $.fn.datetimepicker.Constructor.Default = $.extend({}, $.fn.datetimepicker.Constructor.Default, {
            format: "YYYY-MM-DD HH:mm",
            icons: {
                time: 'fa fa-clock',
                date: 'fa fa-calendar',
                up: 'fa fa-arrow-up',
                down: 'fa fa-arrow-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-calendar-check-o',
                clear: 'fa fa-delete',
                close: 'fa fa-times'
            },
        });
    </script>
@endsection
