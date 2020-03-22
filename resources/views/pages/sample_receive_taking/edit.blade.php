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
                        <li class="breadcrumb-item active">Edit Entri</li>
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
                    <form action="{{ route('sample_receive_taking.update', $sampleReceiveTaking->getKey()) }}"
                          class="form-horizontal"
                          id="pengambilanPenerimaanSampelForm"
                          method="POST">
                        @method("PUT")
                        @csrf
                        <div class="form-group row">
                            <label for="registration_number" class="col-sm-3 col-form-label">No. Registrasi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control" id="registration_number" name="registration_number"
                                       placeholder="Nomer registrasi" required type="text"
                                       value="{{ $sampleReceiveTaking->registrationNumber }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sampel diambil <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input col-sm-4" id="sample_taken_yes" name="sample_taken"
                                           placeholder="Ya" required type="radio" value="1"
                                           {{ $sampleReceiveTaking->sampleTaken ? "checked" : "" }}
                                    >
                                    <label for="sample_taken_yes" class="custom-control-label">
                                        Ya
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input col-sm-4" id="sample_taken_no" name="sample_taken"
                                           placeholder="Tidak" required type="radio" value="0"
                                        {{ $sampleReceiveTaking->sampleTaken ? "" : "checked" }}
                                    >
                                    <label for="sample_taken_no" class="custom-control-label">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sampel diterima dari Fasyankes rujukan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input col-sm-4" id="sample_taken_from_fasyankes_yes"
                                           name="sample_taken_from_fasyankes" placeholder="Ya" required
                                           type="radio" value="1"
                                        {{ $sampleReceiveTaking->sampleTakenFromFasyankes ? "checked" : "" }}
                                    >
                                    <label for="sample_taken_from_fasyankes_yes" class="custom-control-label">
                                        Ya
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input col-sm-4" id="sample_taken_from_fasyankes_no"
                                           name="sample_taken_from_fasyankes" placeholder="Tidak" required
                                           type="radio" value="0"
                                        {{ $sampleReceiveTaking->sampleTakenFromFasyankes ? "" : "checked" }}
                                    >
                                    <label for="sample_taken_from_fasyankes_no" class="custom-control-label">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sample_receiver_officer" class="col-sm-3 col-form-label">Petugas penerima sampel <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control" id="sample_receiver_officer" name="sample_receiver_officer"
                                       placeholder="Penerima Sampel"
                                       required type="text" value="{{$sampleReceiveTaking->sampleReceiverOfficer}}">
                            </div>
                        </div>

                        <hr />
                        @foreach ($sampleReceiveTaking->sampleTypes as $sampleType)
                            @php
                                $pivot = $sampleType->pivot;

                                if(!$pivot) {
                                    continue;
                                }
                            @endphp
                            <div class="form-group row">
                                <label for="dinkes_sender" class="col-sm-3 col-form-label">{{$sampleType->sampleName}} <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input col-sm-5"
                                                       id="{{$sampleType->slugSampleName}}_sample_taken_yes"
                                                       name="sample_type[{{$sampleType->getKey()}}][is_done]"
                                                       placeholder="Ya"
                                                       required
                                                       type="radio" value="1"
                                                    {{$pivot->isDone ? "checked" : ""}}
                                                >
                                                <label for="{{$sampleType->slugSampleName}}_sample_taken_yes" class="custom-control-label">
                                                    Dilakukan
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input col-sm-5"
                                                       id="{{$sampleType->slugSampleName}}_sample_taken_no"
                                                       name="sample_type[{{$sampleType->getKey()}}][is_done]"
                                                       placeholder="Tidak"
                                                       required
                                                       type="radio" value="0"
                                                    {{$pivot->isDone ? "" : "checked"}}
                                                >
                                                <label for="{{$sampleType->slugSampleName}}_sample_taken_no" class="custom-control-label">
                                                    Tidak Dilakukan
                                                </label>
                                            </div>

                                            <div class="row">
                                                <label for="{{$sampleType->slugSampleName}}_sampling_officer" class="col-sm-2">
                                                    Petugas Pengambil Sampel
                                                </label>
                                                <input class="form-control col-sm-8"
                                                       id="{{$sampleType->slugSampleName}}_sampling_officer"
                                                       name="sample_type[{{$sampleType->getKey()}}][sampling_officer]"
                                                       placeholder="Petugas Pengambil Sampel"
                                                       type="text"
                                                       value="{{$pivot->samplingOfficer}}"
                                                >
                                            </div>

                                            <div class="row" id="{{$sampleType->slugSampleName}}_datetime_picker" data-target-input="nearest">
                                                <label for="{{$sampleType->slugSampleName}}_sampling_date" class="col-sm-2">
                                                    Waktu Pengambilan Sampel
                                                </label>
                                                <input
                                                    class="form-control col-sm-8"
                                                    data-target="#{{$sampleType->slugSampleName}}_datetime_picker"
                                                    id="{{$sampleType->slugSampleName}}_sampling_date"
                                                    name="sample_type[{{$sampleType->getKey()}}][sampling_date]"
                                                    placeholder="Waktu Pengambil Sampel"
                                                    type="text"
                                                    value="{{$pivot->samplingDate}}"
                                                />
                                                <div class="form-control col-sm-1 input-group-append" data-target="#{{$sampleType->slugSampleName}}_datetime_picker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <label for="{{$sampleType->slugSampleName}}_sample_number" class="col-sm-2">
                                                    Nomor Sampel
                                                </label>
                                                <input class="form-control col-sm-8"
                                                       id="{{$sampleType->slugSampleName}}_sample_number"
                                                       name="sample_type[{{$sampleType->getKey()}}][sample_number]"
                                                       placeholder="Nomor Sampel"
                                                       type="text"
                                                       value="{{$pivot->sampleNumber}}">
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
                                <textarea class="boxSizingBorder" form="pengambilanPenerimaanSampelForm" id="notes"
                                          name="notes" placeholder="Catatan sampel di sini">{{$sampleReceiveTaking->notes}}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info">Submit</button>
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
