@extends('layouts.app')

@section('extend-css')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Detail Registrasi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('registrations.index') }}">Registrasi</a></li>
                    <li class="breadcrumb-item active">Detail Registrasi</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="text-right">
            <a href="{{ route('registrations.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left pr-1"></i> Kembali</a>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default color-palette-box">
            <div class="card-body">
                <div class="form-horizontal">
                    <div class="form-group row">
                        <label for="registration_number" class="col-sm-3 col-form-label">No. Registrasi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->registration_number }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sample_number" class="col-sm-3 col-form-label">No. Sampel</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->sample_number }}" readonly="">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col col-form-label">1. IDENTITAS PASIEN</label>
                    </div>
                    <div class="form-group row">
                        <label for="dinkes_sender" class="col-sm-3 col-form-label">Dinkes Pengirim</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->dinkes_sender }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fasyankes_sender" class="col-sm-3 col-form-label">Fasyankes Pengirim</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->fasyankes_sender }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="doctor" class="col-sm-3 col-form-label">Dokter Penanggung Jawab</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->doctor }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fasyankes_phone" class="col-sm-3 col-form-label">No. Tlp Fasyankes Pengirim</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->fasyankes_phone }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="registration_date" class="col-sm-3 col-form-label">Tanggal Registrasi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($registration->registration_date)->format('d/m/Y') }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fullname" class="col-sm-3 col-form-label">Nama Pasien</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->patient->fullname }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->patient->nik }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reference_number" class="col-sm-3 col-form-label">No. Rujukan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->reference_number }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date_of_birth" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->patient->date_of_birth }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="age_year" class="col-sm-3 col-form-label">Usia</label>
                        <div class="col-sm-5">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ $registration->patient->age_year }}" readonly="">
                                <div class="input-group-append">
                                    <span class="input-group-text">Tahun</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ $registration->patient->age_month }}" readonly="">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bulan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->patient->gender == 'Laki-laki' ? 'checked' : '' }}>
                                <label for="laki">Laki-laki</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->patient->gender == 'Perempuan' ? 'checked' : '' }} readonly="">
                                <label for="gender">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address_1" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->patient->address_1 }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address_2" class="col-sm-3 col-form-label">&nbsp;</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->patient->address_2 }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_number" class="col-sm-3 col-form-label">No. Telp / HP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->patient->phone_number }}" readonly="">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col col-form-label">2. TANDA DAN GEJALA</label>
                    </div>
                    <div class="form-group row">
                        <label for="fever" class="col-sm-3 col-form-label">Panas atau Riwayat Panas</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->symptom->fever == true ? 'checked' : '' }}>
                                <label for="iyaPanas">Iya</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->symptom->fever == false ? 'checked' : '' }}>
                                <label for="tidakPanas">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cough" class="col-sm-3 col-form-label">Batuk</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->symptom->cough == true ? 'checked' : '' }}>
                                <label for="iyaBatuk">Iya</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->symptom->cough == false ? 'checked' : '' }}>
                                <label for="tidakBatuk">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sore_throat" class="col-sm-3 col-form-label">Nyeri Tenggorokan</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->symptom->sore_throat == true ? 'checked' : '' }}>
                                <label for="iyaNyeri">Iya</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->symptom->sore_throat == false ? 'checked' : '' }}>
                                <label for="tidakNyeri">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shortness_of_breath" class="col-sm-3 col-form-label">Sesak Nafas</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->symptom->shortness_of_breath == true ? 'checked' : '' }}>
                                <label for="iyaSesak">Iya</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->symptom->shortness_of_breath == false ? 'checked' : '' }}>
                                <label for="tidakSesak">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="flu" class="col-sm-3 col-form-label">Pilek</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->symptom->flu == true ? 'checked' : '' }}>
                                <label for="iyaFlu">Iya</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->symptom->flu == false ? 'checked' : '' }}>
                                <label for="tidakFlu">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fatigue" class="col-sm-3 col-form-label">Lesu</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->symptom->fatigue == true ? 'checked' : '' }}>
                                <label for="iyaLesu">Iya</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->symptom->fatigue == false ? 'checked' : '' }}>
                                <label for="tidakLesu">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="headache" class="col-sm-3 col-form-label">Sakit Kepala</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->symptom->headache == true ? 'checked' : '' }}>
                                <label for="iyaSakit">Iya</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->symptom->headache == false ? 'checked' : '' }}>
                                <label for="tidakSakit">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diarrhea" class="col-sm-3 col-form-label">Diare</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->symptom->diarrhea == true ? 'checked' : '' }}>
                                <label for="iyaDiare">Iya</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->symptom->diarrhea == false ? 'checked' : '' }}>
                                <label for="tidakDiare">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nausea_or_vomiting" class="col-sm-3 col-form-label">Mual / Muntah</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->symptom->nausea_or_vomiting == true ? 'checked' : '' }}>
                                <label for="iyaMual">Iya</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->symptom->nausea_or_vomiting == false ? 'checked' : '' }}>
                                <label for="tidakMual">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="comorbid" class="col-sm-3 col-form-label">Penyakit Penyerta (Komorbid)</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->symptom->comorbid == true ? 'checked' : '' }}>
                                <label for="iyaKomorbid">Iya</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->symptom->comorbid == false ? 'checked' : '' }}>
                                <label for="tidakKomorbid">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="comorbid_description" class="col-sm-3 col-form-label">Penyakit Penyerta (Jelaskan)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->symptom->comorbid_description }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="other_symptoms" class="col-sm-3 col-form-label">Gejala Lainnya (Jelaskan)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $registration->symptom->other_symptoms }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pulmonary_xray" class="col-sm-3 col-form-label">X-Ray Paru</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->symptom->pulmonary_xray == 0 ? 'checked' : '' }}>
                                <label for="tidakXray">Tidak Dilakukan</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 mr-1">
                                <input type="radio" {{ $registration->symptom->pulmonary_xray == 1 ? 'checked' : '' }}>
                                <label for="gambaranPneumonia">Gambaran Pneumonia</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->symptom->pulmonary_xray == 2 ? 'checked' : '' }}>
                                <label for="tidakAdaGambaran">Tidak Ada Gambaran Pneumonia</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="using_ventilator" class="col-sm-3 col-form-label">Menggunakan Ventilator</label>
                        <div class="col-sm-9 mt-2">
                            <div class="icheck-primary d-inline mr-1 disabled">
                                <input type="radio" {{ $registration->symptom->using_ventilator == true ? 'checked' : '' }}>
                                <label for="iyaVentilator">Iya</label>
                            </div>
                            <div class="icheck-primary d-inline ml-1 disabled">
                                <input type="radio" {{ $registration->symptom->using_ventilator == false ? 'checked' : '' }}>
                                <label for="tidakVentilator">Tidak</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection