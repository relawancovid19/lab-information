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
                        <li class="breadcrumb-item"><a href="{{ route('sample_receive_taking.index') }}">Pengambilan / Penerimaan Sampel</a></li>
                        <li class="breadcrumb-item active">Detail Data</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="text-right">
                <a href="{{ route('sample_receive_taking.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left pr-1"></i> Kembali</a>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <form id="pengambilanPenerimaanSampelForm" class="form-horizontal" action="{{ route('sample_receive_taking.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="registration_number" class="col-sm-3 col-form-label">No. Registrasi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                {{ $sampleReceiveTaking->registrationNumber }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sampel diambil <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                {{ $sampleReceiveTaking->sampleTaken ? "Ya" : "Tidak" }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sampel diterima dari Fasyankes rujukan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                {{ $sampleReceiveTaking->sampleTakenFromFasyankes ? "Ya" : "Tidak" }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sample_receiver_officer" class="col-sm-3 col-form-label">Petugas penerima sampel <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                {{ $sampleReceiveTaking->sampleReceiverOfficer }}
                            </div>
                        </div>

                        <hr />
                        @foreach ($sampleReceiveTaking->sampleTypes as $sampleType)
                            @php
                                $pivot = $sampleType->pivot;
                                if(!$pivot) {
                                    continue;
                                }

                                if (!$pivot->isDone) {
                                    continue;
                                }
                            @endphp
                            <div class="form-group row">
                                <label for="dinkes_sender" class="col-sm-3 col-form-label">{{$sampleType->sampleName}}</label>
                                <div class="col-sm-9">
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            {{ $pivot->isDone ? "Sampel Tersedia" : "Sampel Tidak Tersedia"}}

                                            <div class="row">
                                                <label for="{{$sampleType->slugSampleName}}_sampling_officer" class="col-sm-2">
                                                    Petugas Pengambil Sampel
                                                </label>

                                                {{ $pivot->samplingOfficer }}
                                            </div>

                                            <div class="row" id="{{$sampleType->slugSampleName}}_datetime_picker" data-target-input="nearest">
                                                <label for="{{$sampleType->slugSampleName}}_sampling_date" class="col-sm-2">
                                                    Waktu Pengambilan Sampel
                                                </label>

                                                {{ $pivot->samplingDate }}
                                            </div>

                                            <div class="row">
                                                <label for="{{$sampleType->slugSampleName}}_sample_number" class="col-sm-2">
                                                    Nomor Sampel
                                                </label>

                                                {{ $pivot->sampleNumber ?? "-" }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <hr />
                        <div class="row">
                            <label for="notes" class="col-sm-3 col-form-label">Catatan</label>
                            <div class="col-sm-9">
                                {{ $sampleReceiveTaking->notes }}
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
