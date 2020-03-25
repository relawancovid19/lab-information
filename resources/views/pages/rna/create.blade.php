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
                    <h1 class="m-0 text-dark">Data Ekstraksi RNA</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('rna.index') }}">Ekstraksi RNA</a></li>
                        <li class="breadcrumb-item active">Entri Baru</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="text-right">
                <a href="{{ route('rna.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left pr-1"></i> Kembali</a>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <form id="pengambilanPenerimaanSampelForm" class="form-horizontal" action="{{ route('rna.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="registration_number" class="col-sm-3 col-form-label">No. Registrasi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                            <select class="custom-select" name="registration_number_id" required>
                                @foreach ($registrationNumbers as $registrationNumber)
                                    <option value="{{ $registrationNumber->id }}">{{ $registrationNumber->registration_number }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="registration_number" class="col-sm-3 col-form-label">No. Sample <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                            <select class="custom-select" name="sample_receive_taking_id" required>
                                @foreach ($sampleReceiveTakings as $sampleReceiveTaking)
                                    <option value="{{ $sampleReceiveTaking->id }}">{{ $sampleReceiveTaking->id }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row" data-target-input="nearest">
                            <label class="col-sm-3 col-form-label">Waktu penerimaan sample <span class="text-danger">*</span></label>
                            <div class="col-sm-9">

                                <div class="input-group date" id="timepicker" data-target-input="nearest">
                                    <input type="text" name="taken_date_time" class="form-control datetimepicker-input" data-target="#timepicker"/>
                                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="receiver_officer" class="col-sm-3 col-form-label">Petugas penerima sampel <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="receiver_officer" id="receiver_officer" placeholder="Petugas penerima sampel" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="extraction_operator" class="col-sm-3 col-form-label">Operator ekstraksi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="extraction_operator" id="extraction_operator" placeholder="Operator ekstraksi" required>
                            </div>
                        </div>

                        <div class="form-group row" data-target-input="nearest">
                            <label class="col-sm-3 col-form-label">Waktu mulai ekstraksi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">

                                <div class="input-group date" id="timepicker_ekstraksi" data-target-input="nearest">
                                    <input type="text" name="extraction_started_date_time" class="form-control datetimepicker-input" data-target="#timepicker_ekstraksi"/>
                                    <div class="input-group-append" data-target="#timepicker_ekstraksi" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="extraction_method" class="col-sm-3 col-form-label">Metode ekstraksi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="extraction_method" id="extraction_method" placeholder="Metode ekstraksi" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="extraction_kit_name" class="col-sm-3 col-form-label">Nama kit ekstraksi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="extraction_kit_name" id="extraction_kit_name" placeholder="Nama kit ekstraksi" required>
                            </div>
                        </div>

                        <div class="form-group row" data-target-input="nearest">
                            <label class="col-sm-3 col-form-label">Waktu selesai ekstraksi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">

                                <div class="input-group date" id="timepicker_ekstraksi_end" data-target-input="nearest">
                                    <input type="text" name="extraction_ended_date_time" class="form-control datetimepicker-input" data-target="#timepicker_ekstraksi_end"/>
                                    <div class="input-group-append" data-target="#timepicker_ekstraksi_end" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sent_to" class="col-sm-3 col-form-label">Dikirim ke lab <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sent_to" id="sent_to" placeholder="Dikirim ke lab" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sender_name" class="col-sm-3 col-form-label">Nama pengirim <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sender_name" id="sender_name" placeholder="Nama pengirim" required>
                            </div>
                        </div>

                        <div class="form-group row" data-target-input="nearest">
                            <label class="col-sm-3 col-form-label">Waktu pengiriman <span class="text-danger">*</span></label>
                            <div class="col-sm-9">

                                <div class="input-group date" id="sent_date_time" data-target-input="nearest">
                                    <input type="text" name="sent_date_time" class="form-control datetimepicker-input" data-target="#sent_date_time" required/>
                                    <div class="input-group-append" data-target="#sent_date_time" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <label for="notes" class="col-sm-3 col-form-label">Catatan</label>
                            <div class="col-sm-9">
                                <textarea name="notes" id="notes" form="pengambilanPenerimaanSampelForm" placeholder="Catatan sampel di sini" class="boxSizingBorder form-control"></textarea>
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
