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
                        <li class="breadcrumb-item active">Entri Baru</li>
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
                                <input type="text" class="form-control" name="registration_number" id="registration_number" placeholder="Nomer registrasi" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sampel diambil <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="sample_taken" value="1" placeholder="Ya" id="sample_taken_yes" required>
                                    <label for="sample_taken_yes" class="custom-control-label">
                                        Ya
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="sample_taken" value="0" placeholder="Tidak" id="sample_taken_no" required>
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
                                    <input type="radio" class="custom-control-input col-sm-4" name="sample_taken_from_fasyankes" value="1" placeholder="Ya" id="sample_taken_from_fasyankes_yes" required>
                                    <label for="sample_taken_from_fasyankes_yes" class="custom-control-label">
                                        Ya
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="sample_taken_from_fasyankes" value="0" placeholder="Tidak" id="sample_taken_from_fasyankes_no" required>
                                    <label for="sample_taken_from_fasyankes_no" class="custom-control-label">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sample_receiver_officer" class="col-sm-3 col-form-label">Petugas penerima sampel <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sample_receiver_officer" id="sample_receiver_officer" placeholder="Penerima Sampel" required>
                            </div>
                        </div>

                        <hr />
                        @foreach ($sampleTypes as $sampleType)
                            <div class="form-group row">
                                <label for="dinkes_sender" class="col-sm-3 col-form-label">{{$sampleType->sampleName}} <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input col-sm-5" name="sample_type[{{$sampleType->getKey()}}][is_done]" value="1" placeholder="Ya" id="{{$sampleType->slugSampleName}}_sample_taken_yes" required>
                                                <label for="{{$sampleType->slugSampleName}}_sample_taken_yes" class="custom-control-label">
                                                    Dilakukan
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input col-sm-5" name="sample_type[{{$sampleType->getKey()}}][is_done]" value="0" placeholder="Tidak" id="{{$sampleType->slugSampleName}}_sample_taken_no" required>
                                                <label for="{{$sampleType->slugSampleName}}_sample_taken_no" class="custom-control-label">
                                                    Tidak Dilakukan
                                                </label>
                                            </div>

                                            <div class="row">
                                                <label for="{{$sampleType->slugSampleName}}_sampling_officer" class="col-sm-2">
                                                    Petugas Pengambil Sampel
                                                </label>
                                                <input type="text" class="form-control col-sm-8" name="sample_type[{{$sampleType->getKey()}}][sampling_officer]" placeholder="Petugas Pengambil Sampel" id="{{$sampleType->slugSampleName}}_sampling_officer">
                                            </div>

                                            <div class="row" id="{{$sampleType->slugSampleName}}_datetime_picker" data-target-input="nearest">
                                                <label for="{{$sampleType->slugSampleName}}_sampling_date" class="col-sm-2">
                                                    Waktu Pengambilan Sampel
                                                </label>
                                                <input
                                                    type="text"
                                                    class="form-control col-sm-8"
                                                    name="sample_type[{{$sampleType->getKey()}}][sampling_date]"
                                                    placeholder="Waktu Pengambil Sampel" id="{{$sampleType->slugSampleName}}_sampling_date"
                                                    data-target="#{{$sampleType->slugSampleName}}_datetime_picker"
                                                />
                                                <div class="form-control col-sm-1 input-group-append" data-target="#{{$sampleType->slugSampleName}}_datetime_picker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <label for="{{$sampleType->slugSampleName}}_sample_number" class="col-sm-2">
                                                    Nomor Sampel
                                                </label>
                                                <input type="text" class="form-control col-sm-8" name="sample_type[{{$sampleType->getKey()}}][sample_number]" placeholder="Nomor Sampel" id="{{$sampleType->slugSampleName}}_sample_number">
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
                                <textarea name="notes" id="notes" form="pengambilanPenerimaanSampelForm" placeholder="Catatan sampel di sini" class="boxSizingBorder"></textarea>
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
