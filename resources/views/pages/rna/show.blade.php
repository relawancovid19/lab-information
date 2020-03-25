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
                    <form class="form-horizontal">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">No. Registrasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $rna->registration->registration_number }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Waktu penerimaan sampel</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $rna->taken_date_time }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Petugas penerima sampel</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $rna->receiver_officer }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Operator ekstraksi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $rna->extraction_operator }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Waktu mulai ekstraksi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $rna->extraction_started_date_time }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Metode ekstraksi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $rna->extraction_method }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama kit ekstraksi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $rna->extraction_kit_name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Waktu selesai ekstraksi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $rna->extraction_ended_date_time }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dikirim ke lab</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $rna->sent_to }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama pengirim</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $rna->sender_name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Waktu pengiriman</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $rna->sent_date_time }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Catatan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" disabled>{{ $rna->notes }}</textarea>
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
