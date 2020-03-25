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
                    <form action="{{ route('sample_receive_pcr.update', $sampleReceivePcr->getKey()) }}"
                        class="form-horizontal"
                        id="pengambilanPenerimaanSampelForm"
                        method="POST">
                        @method("PUT")
                        @csrf
                        <div class="form-group row">
                            <label for="registration_id" class="col-sm-3 col-form-label">No. Registrasi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                {{ $sampleReceivePcr->registration->registration_number }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sample_number" class="col-sm-3 col-form-label">No. Sampel <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sample_number" id="sample_number" placeholder="Nomer sampel" required value="{{ $sampleReceivePcr->sample_number }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rna_date" class="col-sm-3 col-form-label">Tanggal penerimaan sampel RNA <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datemask @error('rna_date') is-invalid @enderror" name="rna_date" value="{{ $sampleReceivePcr->rna_datetime ? \Carbon\Carbon::parse($sampleReceivePcr->rna_datetime)->format('d/m/Y') : old('rna_date') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask placeholder="Tanggal penerimaan sampel RNA">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rna_time" class="col-sm-3 col-form-label">Jam penerimaan sampel <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control timemask @error('rna_time') is-invalid @enderror" name="rna_time" value="{{ $sampleReceivePcr->rna_datetime ? \Carbon\Carbon::parse($sampleReceivePcr->rna_datetime)->format('H:i') : old('rna_time') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="HH:MM" data-mask placeholder="Jam penerimaan sampel">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Laboratorium penerima sampel <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="from_lab" value="unpad" id="from_lab_unpad" required {{ $sampleReceivePcr->from_lab == 'unpad' ? 'checked' : '' }}>
                                    <label for="from_lab_unpad" class="custom-control-label">
                                        UNPAD
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="from_lab" value="itb" id="from_lab_itb" required {{ $sampleReceivePcr->from_lab == 'itb' ? 'checked' : '' }}>
                                    <label for="from_lab_itb" class="custom-control-label">
                                        ITB
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="from_lab" value="blk" id="from_lab_blk" required {{ $sampleReceivePcr->from_lab == 'blk' ? 'checked' : '' }}>
                                    <label for="from_lab_blk" class="custom-control-label">
                                        BLK
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="from_lab" value="lainnya" id="from_lab_other" required {{ !in_array($sampleReceivePcr->from_lab, ['unpad', 'itb', 'blk']) ? 'checked' : '' }}>
                                    <label for="from_lab_other" class="custom-control-label">
                                        Lainnya
                                    </label>
                                    <input type="text" class="form-control col-sm-4" name="from_lab_other" value="{{ !in_array($sampleReceivePcr->from_lab, ['unpad', 'itb', 'blk']) ? $sampleReceivePcr->from_lab : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sampling_officer" class="col-sm-3 col-form-label">Petugas penerima sampel <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sampling_officer" id="sampling_officer" placeholder="Petugas penerima sampel" required value="{{ $sampleReceivePcr->sampling_officer }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pcr_operator" class="col-sm-3 col-form-label">Operator PCR <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pcr_operator" id="pcr_operator" placeholder="Operator PCR" required value="{{ $sampleReceivePcr->pcr_operator }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="check_start_date" class="col-sm-3 col-form-label">Tanggal mulai pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datemask @error('check_start_date') is-invalid @enderror" name="check_start_date" value="{{ $sampleReceivePcr->check_start_datetime ? \Carbon\Carbon::parse($sampleReceivePcr->check_start_datetime)->format('d/m/Y') : old('check_start_date') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask placeholder="Tanggal mulai pemeriksaan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="check_start_time" class="col-sm-3 col-form-label">Jam mulai pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control timemask @error('check_start_time') is-invalid @enderror" name="check_start_time" value="{{ $sampleReceivePcr->check_start_datetime ? \Carbon\Carbon::parse($sampleReceivePcr->check_start_datetime)->format('H:i') : old('check_start_time') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="HH:MM" data-mask placeholder="Jam mulai pemeriksaan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="check_finish_time" class="col-sm-3 col-form-label">Jam selesai pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control timemask @error('check_finish_time') is-invalid @enderror" name="check_finish_time" value="{{ $sampleReceivePcr->check_finish_datetime ? \Carbon\Carbon::parse($sampleReceivePcr->check_finish_datetime)->format('H:i') : old('check_finish_time') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="HH:MM" data-mask placeholder="Jam selesai pemeriksaan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Metode pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="check_type" value="multiplex" id="check_type_multiplex" required {{ $sampleReceivePcr->check_type == 'multiplex' ? 'checked' : '' }}>
                                    <label for="check_type_multiplex" class="custom-control-label">
                                        Multiplex
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="check_type" value="singleplex" id="check_type_singleplex" required {{ $sampleReceivePcr->check_type == 'singleplex' ? 'checked' : '' }}>
                                    <label for="check_type_singleplex" class="custom-control-label">
                                        Singleplex
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="check_type" value="lainnya" id="check_type_other" required {{ !in_array($sampleReceivePcr->check_type, ['multiplex', 'singleplex']) ? 'checked' : '' }}>
                                    <label for="check_type_other" class="custom-control-label">
                                        Lainnya, sebutkan
                                    </label>
                                    <input type="text" class="form-control col-sm-4" name="check_type_other" value="{{ !in_array($sampleReceivePcr->check_type, ['multiplex', 'singleplex']) ? $sampleReceivePcr->check_type : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="check_kit" class="col-sm-3 col-form-label">Nama kit pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="check_kit" id="check_kit" placeholder="Nama kit pemeriksaan" required value="{{ $sampleReceivePcr->check_kit }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gen_target" class="col-sm-3 col-form-label">Target gen <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="gen_target" id="gen_target" placeholder="Target gen" required value="{{ $sampleReceivePcr->gen_target }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="result" class="col-sm-3 col-form-label">Hasil deteksi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="result" id="result" placeholder="Hasil deteksi" required value="{{ $sampleReceivePcr->result }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kesimpulan pemeriksaan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="conclusion" value="0" id="conclusion_negative" required {{ $sampleReceivePcr->conclusion == 0 ? 'checked' : '' }}>
                                    <label for="conclusion_negative" class="custom-control-label">
                                        Negatif
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="conclusion" value="1" id="conclusion_positive" required {{ $sampleReceivePcr->conclusion == 1 ? 'checked' : '' }}>
                                    <label for="conclusion_positive" class="custom-control-label">
                                        Positif
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input col-sm-4" name="conclusion" value="2" id="conclusion_unknown" required {{ $sampleReceivePcr->conclusion == 2 ? 'checked' : '' }}>
                                    <label for="conclusion_unknown" class="custom-control-label">
                                        Tidak dapat ditentukan
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="notes" class="col-sm-3 col-form-label">Catatan</label>
                            <div class="col-sm-9">
                                <textarea name="notes" id="notes" form="pengambilanPenerimaanSampelForm" placeholder="Catatan sampel di sini" class="boxSizingBorder form-control">{{ $sampleReceivePcr->notes }}</textarea>
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
    </script>
@endsection
