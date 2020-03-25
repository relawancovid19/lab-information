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
                        <li class="breadcrumb-item active">Entri Baru</li>
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
                            <label for="registration_id" class="col-sm-3 col-form-label">No. Registrasi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPatient" title="Nomer registrasi"><i class="fas fa-search mr-1"></i> Nomer registrasi</button>
                                <input type="hidden" class="form-control" name="registration_id" id="registration_id" required>
                                <br>
                                <span class="registration_number"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sample_number" class="col-sm-3 col-form-label">No. Sampel <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sample_number" id="sample_number" placeholder="Nomer sampel" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rna_date" class="col-sm-3 col-form-label">Tanggal penerimaan sampel RNA <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datemask @error('rna_date') is-invalid @enderror" name="rna_date" value="{{ old('rna_date') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask placeholder="Tanggal penerimaan sampel RNA">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rna_time" class="col-sm-3 col-form-label">Jam penerimaan sampel <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control timemask @error('rna_time') is-invalid @enderror" name="rna_time" value="{{ old('rna_time') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="HH:MM" data-mask placeholder="Jam penerimaan sampel">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Laboratorium penerima sampel <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="from_lab" value="unpad" id="from_lab_unpad" required>
                                    <label for="from_lab_unpad" class="custom-control-label">
                                        UNPAD
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="from_lab" value="itb" id="from_lab_itb" required>
                                    <label for="from_lab_itb" class="custom-control-label">
                                        ITB
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="from_lab" value="blk" id="from_lab_blk" required>
                                    <label for="from_lab_blk" class="custom-control-label">
                                        BLK
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="from_lab" value="lainnya" id="from_lab_other" required>
                                    <label for="from_lab_other" class="custom-control-label">
                                        Lainnya
                                    </label>
                                    <input type="text" class="form-control col-sm-4" name="from_lab_other" value="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sampling_officer" class="col-sm-3 col-form-label">Petugas penerima sampel <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sampling_officer" id="sampling_officer" placeholder="Petugas penerima sampel" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pcr_operator" class="col-sm-3 col-form-label">Operator PCR <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pcr_operator" id="pcr_operator" placeholder="Operator PCR" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="check_start_date" class="col-sm-3 col-form-label">Tanggal mulai pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datemask @error('check_start_date') is-invalid @enderror" name="check_start_date" value="{{ old('check_start_date') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask placeholder="Tanggal mulai pemeriksaan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="check_start_time" class="col-sm-3 col-form-label">Jam mulai pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control timemask @error('check_start_time') is-invalid @enderror" name="check_start_time" value="{{ old('check_start_time') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="HH:MM" data-mask placeholder="Jam mulai pemeriksaan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="check_type" class="col-sm-3 col-form-label">Metode pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="check_type" id="check_type" placeholder="Metode pemeriksaan" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="check_kit" class="col-sm-3 col-form-label">Nama kit pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="check_kit" id="check_kit" placeholder="Nama kit pemeriksaan" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gen_target" class="col-sm-3 col-form-label">Target gen <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="gen_target" id="gen_target" placeholder="Target gen" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="check_finish_date" class="col-sm-3 col-form-label">Tanggal selesai pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datemask @error('check_finish_date') is-invalid @enderror" name="check_finish_date" value="{{ old('check_finish_date') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask placeholder="Tanggal selesai pemeriksaan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="check_finish_time" class="col-sm-3 col-form-label">Jam selesai pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control timemask @error('check_finish_time') is-invalid @enderror" name="check_finish_time" value="{{ old('check_finish_time') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="HH:MM" data-mask placeholder="Jam selesai pemeriksaan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="result" class="col-sm-3 col-form-label">Hasil deteksi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="result" id="result" placeholder="Hasil deteksi" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kesimpulan pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="conclusion" value="0" id="conclusion_negative" required>
                                    <label for="conclusion_negative" class="custom-control-label">
                                        Negatif
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="conclusion" value="1" id="conclusion_positive" required>
                                    <label for="conclusion_positive" class="custom-control-label">
                                        Positif
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="conclusion" value="2" id="conclusion_unknown" required>
                                    <label for="conclusion_unknown" class="custom-control-label">
                                        Tidak dapat ditentukan
                                    </label>
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
        <!-- existing patient -->
        <div class="modal fade" id="modalPatient">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nomer Registrasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nomer Registrasi</th>
                                        <th class="text-center">NIK</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Tanggal Lahir</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th width="10%" class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registrations as $registration)
                                    <tr>
                                        <td>{{ $registration->registration_number }}</td>
                                        <td>{{ $registration->patient->nik }}</td>
                                        <td>{{ $registration->patient->fullname }}</td>
                                        <td>{{ \Carbon\Carbon::parse($registration->patient->date_of_birth)->format('d/m/Y') }}</td>
                                        <td>{{ $registration->patient->gender }}</td>
                                        <td class="text-center">
                                            <button data-dismiss="modal" type="button" class="btn btn-primary btn-xs selectRegistration" value="{{ $registration }}"><i class="fas fa-check mr-1"></i> Pilih</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extend-js')
    <!-- Moment Js -->
    <script src="{{ url('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ url('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

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

        // Datemask dd/mm/yyyy
        $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        // Timemask HH:MM
        $('.timemask').inputmask('HH:MM', { 'placeholder': 'HH:MM' })

        $('.numbermask').inputmask({ 'mask': '9', 'repeat': 10, 'greedy': false, placeholder: '' })

        // Select existing registration
        $(".selectRegistration").click(function () {
            var x = $(this).prop("value");
            var obj = JSON.parse(x);

            $("input[name='registration_id']").val(obj.id);
            $(".registration_number").text(obj.registration_number);
        });
    </script>
@endsection
