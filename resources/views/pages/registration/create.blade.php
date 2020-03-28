@extends('layouts.app')

@section('extend-css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<style>
    /* Hide all steps by default: */
    .tab {
        display: none;
    }
</style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Registrasi Baru</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('registrations.index') }}">Registrasi</a></li>
                    <li class="breadcrumb-item active">Registrasi Baru</li>
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
                <form id="registrationForm" class="form-horizontal" action="{{ route('registrations.store') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" placeholder="NIK">

                            @error('nik')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="registration_number" class="col-sm-3 col-form-label">No. Registrasi <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('registration_number') is-invalid @enderror" name="registration_number" value="{{ old('registration_number', $registrationNumber) }}" placeholder="Nomor registrasi" required>

                            @error('registration_number')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <!-- Step 1: Identitas Pasien -->
                    <div class="tab">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">1. IDENTITAS PASIEN</label>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPatient" title="Cari Pasien"><i class="fas fa-search mr-1"></i> Cari Pasien</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dinkes_sender" class="col-sm-3 col-form-label">Dinkes Pengirim</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('dinkes_sender') is-invalid @enderror" name="dinkes_sender" value="{{ old('dinkes_sender') }}" placeholder="Dinkes pengirim">

                                @error('dinkes_sender')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fasyankes_sender" class="col-sm-3 col-form-label">Fasyankes Pengirim</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('fasyankes_sender') is-invalid @enderror" name="fasyankes_sender" value="{{ old('fasyankes_sender') }}" placeholder="Fasyankes pengirim">

                                @error('fasyankes_sender')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="medical_record_number" class="col-sm-3 col-form-label">No Rekam Medis</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('medical_record_number') is-invalid @enderror" name="medical_record_number" value="{{ old('medical_record_number') }}" placeholder="No Rekam Medis">

                                @error('medical_record_number')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="doctor" class="col-sm-3 col-form-label">Dokter Penanggung Jawab</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('doctor') is-invalid @enderror" name="doctor" value="{{ old('doctor') }}" placeholder="Dokter penanggung jawab">

                                @error('doctor')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fasyankes_phone" class="col-sm-3 col-form-label">No. Tlp Fasyankes Pengirim</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('fasyankes_phone') is-invalid @enderror" name="fasyankes_phone" value="{{ old('fasyankes_phone') }}" placeholder="Nomor telepon fasyankes pengirim">

                                @error('fasyankes_phone')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="registration_date" class="col-sm-3 col-form-label">Tanggal Registrasi</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control datemask @error('registration_date') is-invalid @enderror" name="registration_date" value="{{ old('registration_date') }}" data-mask placeholder="Tanggal registrasi">

                                @error('registration_date')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fullname" class="col-sm-3 col-form-label">Nama Pasien <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" placeholder="Nama pasien" required>

                                @error('fullname')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reference_number" class="col-sm-3 col-form-label">No. Rujukan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('reference_number') is-invalid @enderror" name="reference_number" value="{{ old('reference_number') }}" placeholder="Nomor rujukan">

                                @error('reference_number')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_of_birth" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control datemask @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" data-mask placeholder="Tanggal lahir">

                                @error('date_of_birth')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age_year" class="col-sm-3 col-form-label">Usia</label>
                            <div class="col-sm-5">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('age_year') is-invalid @enderror" name="age_year" value="{{ old('age_year') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Tahun</span>
                                    </div>

                                    @error('age_year')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('age_month') is-invalid @enderror" name="age_month" value="{{ old('age_month') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Bulan</span>
                                    </div>

                                    @error('age_month')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('gender') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="laki_laki" name="gender" value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}>
                                        <label for="laki_laki">Laki-laki</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="perempuan" name="gender" value="Perempuan" {{ old('gender') == 'Perempuan' ? 'checked' : '' }}>
                                        <label for="perempuan">Perempuan</label>
                                    </div>
                                </div>

                                @error('gender')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address_1" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('address_1') is-invalid @enderror" name="address_1" value="{{ old('address_1') }}" placeholder="Alamat">

                                @error('address_1')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address_2" class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address_2" value="{{ old('address_2') }}" placeholder="(optional)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-sm-3 col-form-label">No. Telp / HP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="Nomor telepon atau nomor handphone">

                                @error('phone_number')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Step 2: Riwayat Perawatan Pasien Dalam Pengawasan -->
                    <div class="tab">
                        <div class="form-group row">
                            <label class="col col-form-label">2. Riwayat Perawatan Pasien Dalam Pengawasan</label>
                        </div>
                        <div class="form-group row">
                            <label for="First" class="col-sm-3 col-form-label">Kunjungan Pertama</label>
                            <div class="col-sm-5">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="explanation[]" value="pertama">
                                    <input type="date" class="form-control  datemask @error('date_treated[]') is-invalid @enderror" name="date_treated[]" value="{{ old('date_treated[]') }}" placeholder="Tanggal Dirawat">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Tanggal</span>
                                    </div>

                                    @error('date_treated[]')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('fasyankes_name[]') is-invalid @enderror" name="fasyankes_name[]" value="{{ old('fasyankes_name[]') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">RS/Fasyankes</span>
                                    </div>

                                    @error('fasyankes_name[]')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="First" class="col-sm-3 col-form-label">Kunjungan Kedua</label>
                            <div class="col-sm-5">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="explanation[]" value="kedua">
                                    <input type="date" class="form-control  datemask @error('date_treated[]') is-invalid @enderror" name="date_treated[]" value="{{ old('date_treated[]') }}" placeholder="Tanggal Dirawat">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Tanggal</span>
                                    </div>

                                    @error('date_treated[]')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('fasyankes_name[]') is-invalid @enderror" name="fasyankes_name[]" value="{{ old('fasyankes_name[]') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">RS/Fasyankes</span>
                                    </div>

                                    @error('fasyankes_name[]')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="First" class="col-sm-3 col-form-label">Kunjungan Ketiga</label>
                            <div class="col-sm-5">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="explanation[]" value="ketiga">
                                    <input type="date" class="form-control  datemask @error('date_treated[]') is-invalid @enderror" name="date_treated[]" value="{{ old('date_treated[]') }}" placeholder="Tanggal Dirawat">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Tanggal</span>
                                    </div>

                                    @error('date_treated[]')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('fasyankes_name[]') is-invalid @enderror" name="fasyankes_name[]" value="{{ old('fasyankes_name[] ') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">RS/Fasyankes</span>
                                    </div>

                                    @error('fasyankes_name[]')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step 3: Tanda dan Gejala -->
                    <div class="tab">
                        <div class="form-group row">
                            <label class="col col-form-label">3. TANDA DAN GEJALA</label>
                        </div>

                        <div class="form-group row">
                            <label for="comorbid_description" class="col-sm-3 col-form-label">Tanggal onset gejala (panas)</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="date_onset" placeholder="Tanggal onset gejala (panas)">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fever" class="col-sm-3 col-form-label">Panas atau Riwayat Panas</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('fever') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaPanas" name="fever" value="1" {{ old('fever') == true ? 'checked' : '' }}>
                                        <label for="iyaPanas">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakPanas" name="fever "value="2" {{ old('fever') == "2" ? 'checked' : '' }}>
                                        <label for="tidakPanas">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullPanas" name="fever" {{ is_null(old('fever')) ? 'checked' : '' }} value="">
                                        <label for="nullPanas">Tidak Keduanya</label>
                                    </div>
                                </div>

                                @error('fever')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cough" class="col-sm-3 col-form-label">Batuk</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('cough') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaBatuk" name="cough" value="1" {{ old('cough') == true ? 'checked' : '' }}>
                                        <label for="iyaBatuk">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakBatuk" name="cough "value="2" {{ old('cough') == "2" ? 'checked' : '' }}>
                                        <label for="tidakBatuk">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullBatuk" name="cough" {{ is_null(old('cough')) ? 'checked' : '' }} value="">
                                        <label for="nullBatuk">Tidak Keduanya</label>
                                    </div>
                                </div>

                                @error('cough')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sore_throat" class="col-sm-3 col-form-label">Nyeri Tenggorokan</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('sore_throat') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaNyeri" name="sore_throat" value="1" {{ old('sore_throat') == true ? 'checked' : '' }}>
                                        <label for="iyaNyeri">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakNyeri" name="sore_throat "value="2" {{ old('sore_throat') == "2" ? 'checked' : '' }}>
                                        <label for="tidakNyeri">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullNyeri" name="sore_throat" {{ is_null(old('sore_throat')) ? 'checked' : '' }} value="">
                                        <label for="nullNyeri">Tidak Keduanya</label>
                                    </div>
                                </div>

                                @error('sore_throat')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shortness_of_breath" class="col-sm-3 col-form-label">Sesak Nafas</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('shortness_of_breath') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaSesak" name="shortness_of_breath" value="1" {{ old('shortness_of_breath') == true ? 'checked' : '' }}>
                                        <label for="iyaSesak">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakSesak" name="shortness_of_breath "value="2" {{ old('shortness_of_breath') == "2" ? 'checked' : '' }}>
                                        <label for="tidakSesak">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullSesak" name="shortness_of_breath" {{ is_null(old('shortness_of_breath')) ? 'checked' : '' }} value="">
                                        <label for="nullSesak">Tidak Keduanya</label>
                                    </div>
                                </div>

                                @error('shortness_of_breath')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="flu" class="col-sm-3 col-form-label">Pilek</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('flu') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaFlu" name="flu" value="1" {{ old('flu') == true ? 'checked' : '' }}>
                                        <label for="iyaFlu">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakFlu" name="flu "value="2" {{ old('flu') == "2" ? 'checked' : '' }}>
                                        <label for="tidakFlu">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullFlu" name="flu" {{ is_null(old('flu')) ? 'checked' : '' }} value="">
                                        <label for="nullFlu">Tidak Keduanya</label>
                                    </div>
                                </div>

                                @error('flu')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fatigue" class="col-sm-3 col-form-label">Lesu</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('fatigue') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaLesu" name="fatigue" value="1" {{ old('fatigue') == true ? 'checked' : '' }}>
                                        <label for="iyaLesu">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakLesu" name="fatigue "value="2" {{ old('fatigue') == "2" ? 'checked' : '' }}>
                                        <label for="tidakLesu">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullLesu" name="fatigue" {{ is_null(old('fatigue')) ? 'checked' : '' }} value="">
                                        <label for="nullLesu">Tidak Keduanya</label>
                                    </div>
                                </div>

                                @error('fatigue')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="headache" class="col-sm-3 col-form-label">Sakit Kepala</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('headache') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaSakit" name="headache" value="1" {{ old('headache') == true ? 'checked' : '' }}>
                                        <label for="iyaSakit">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakSakit" name="headache "value="2" {{ old('headache') == "2" ? 'checked' : '' }}>
                                        <label for="tidakSakit">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullSakit" name="headache" {{ is_null(old('headache')) ? 'checked' : '' }} value="">
                                        <label for="nullSakit">Tidak Keduanya</label>
                                    </div>
                                </div>

                                @error('headache')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="diarrhea" class="col-sm-3 col-form-label">Diare</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('diarrhea') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaDiare" name="diarrhea" value="1" {{ old('diarrhea') == true ? 'checked' : '' }}>
                                        <label for="iyaDiare">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakDiare" name="diarrhea "value="2" {{ old('diarrhea') == "2" ? 'checked' : '' }}>
                                        <label for="tidakDiare">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullDiare" name="diarrhea" {{ is_null(old('diarrhea')) ? 'checked' : '' }} value="">
                                        <label for="nullDiare">Tidak Keduanya</label>
                                    </div>
                                </div>

                                @error('diarrhea')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nausea_or_vomiting" class="col-sm-3 col-form-label">Mual / Muntah</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('nausea_or_vomiting') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaMual" name="nausea_or_vomiting" value="1" {{ old('nausea_or_vomiting') == true ? 'checked' : '' }}>
                                        <label for="iyaMual">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakMual" name="nausea_or_vomiting "value="2" {{ old('nausea_or_vomiting') == "2" ? 'checked' : '' }}>
                                        <label for="tidakMual">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullMual" name="nausea_or_vomiting" {{ is_null(old('nausea_or_vomiting')) ? 'checked' : '' }} value="">
                                        <label for="nullMual">Tidak Keduanya</label>
                                    </div>
                                </div>

                                @error('nausea_or_vomiting')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comorbid" class="col-sm-3 col-form-label">Penyakit Penyerta (Komorbid)</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('comorbid') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaKomorbid" name="comorbid" value="1" {{ old('comorbid') == true ? 'checked' : '' }}>
                                        <label for="iyaKomorbid">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakKomorbid" name="comorbid "value="2" {{ old('comorbid') == "2" ? 'checked' : '' }}>
                                        <label for="tidakKomorbid">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullKomorbid" name="comorbid" {{ is_null(old('comorbid')) ? 'checked' : '' }} value="">
                                        <label for="nullKomorbid">Tidak Keduanya</label>
                                    </div>
                                </div>

                                @error('comorbid')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comorbid_description" class="col-sm-3 col-form-label">Penyakit Penyerta (Jelaskan)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('comorbid_description') is-invalid @enderror" name="comorbid_description" value="{{ old('comorbid_description') }}" placeholder="Penjelasan penyakit penyerta">

                                @error('comorbid_description')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hipertensi" class="col-sm-3 col-form-label">Hipertensi <span class="text-danger">*</span></label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('hipertensi') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaHipertensi" name="hipertensi" value="1" {{ old('hipertensi') == true ? 'checked' : '' }}>
                                        <label for="iyaHipertensi">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakHipertensi" name="hipertensi" value="0" {{ old('hipertensi') == false ? 'checked' : '' }}>
                                        <label for="tidakHipertensi">Tidak</label>
                                    </div>
                                </div>

                                @error('hipertensi')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="diabetes_mellitus" class="col-sm-3 col-form-label">Diabetes Mellitus <span class="text-danger">*</span></label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('diabetes_mellitus') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaDiabetesMellitus" name="diabetes_mellitus" value="1" {{ old('diabetes_mellitus') == true ? 'checked' : '' }}>
                                        <label for="iyaDiabetesMellitus">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakDiabetesMellitus" name="diabetes_mellitus" value="0" {{ old('diabetes_mellitus') == false ? 'checked' : '' }}>
                                        <label for="tidakDiabetesMellitus">Tidak</label>
                                    </div>
                                </div>

                                @error('diabetes_mellitus')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="liver" class="col-sm-3 col-form-label">Liver <span class="text-danger">*</span></label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('liver') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaLiver" name="liver" value="1" {{ old('liver') == true ? 'checked' : '' }}>
                                        <label for="iyaLiver">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakLiver" name="liver" value="0" {{ old('liver') == false ? 'checked' : '' }}>
                                        <label for="tidakLiver">Tidak</label>
                                    </div>
                                </div>

                                @error('liver')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="neurologi" class="col-sm-3 col-form-label">Neurologi <span class="text-danger">*</span></label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('neurologi') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaNeurologi" name="neurologi" value="1" {{ old('neurologi') == true ? 'checked' : '' }}>
                                        <label for="iyaneurologi">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakneurologi" name="neurologi" value="0" {{ old('neurologi') == false ? 'checked' : '' }}>
                                        <label for="tidakNeurologi">Tidak</label>
                                    </div>
                                </div>

                                @error('neurologi')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hiv" class="col-sm-3 col-form-label">HIV <span class="text-danger">*</span></label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('hiv') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaHiv" name="hiv" value="1" {{ old('hiv') == true ? 'checked' : '' }}>
                                        <label for="iyaHiv">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakHiv" name="hiv" value="0" {{ old('hiv') == false ? 'checked' : '' }}>
                                        <label for="tidakHiv">Tidak</label>
                                    </div>
                                </div>

                                @error('hiv')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kidney" class="col-sm-3 col-form-label">Ginjal <span class="text-danger">*</span></label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('kidney') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaKidney" name="kidney" value="1" {{ old('kidney') == true ? 'checked' : '' }}>
                                        <label for="iyaLiver">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakKidney" name="kidney" value="0" {{ old('kidney') == false ? 'checked' : '' }}>
                                        <label for="tidakKidney">Tidak</label>
                                    </div>
                                </div>

                                @error('kidney')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="chronic_lung" class="col-sm-3 col-form-label">Paru Knonik <span class="text-danger">*</span></label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('chronic_lung') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaChronicLung" name="chronic_lung" value="1" {{ old('chronic_lung') == true ? 'checked' : '' }}>
                                        <label for="iyaChronicLung">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakChronicLung" name="chronic_lung" value="0" {{ old('chronic_lung') == false ? 'checked' : '' }}>
                                        <label for="tidakChronicLung">Tidak</label>
                                    </div>
                                </div>

                                @error('chronic_lung')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="other_symptoms" class="col-sm-3 col-form-label">Gejala Lainnya (Jelaskan)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="other_symptoms" value="{{ old('other_symptoms') }}" placeholder="Gejala lainnya">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pulmonary_xray" class="col-sm-3 col-form-label">X-Ray Paru</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('pulmonary_xray') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="tidakXray" name="pulmonary_xray "value="2" {{ old('pulmonary_xray') == '0' ? 'checked' : '' }}>
                                        <label for="tidakXray">Tidak Dilakukan</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 mr-1">
                                        <input type="radio" id="gambaranPneumonia" name="pulmonary_xray" value="1" {{ old('pulmonary_xray') == '1' ? 'checked' : '' }}>
                                        <label for="gambaranPneumonia">Gambaran Pneumonia</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakAdaGambaran" name="pulmonary_xray" value="2" {{ old('pulmonary_xray') == '2' ? 'checked' : '' }}>
                                        <label for="tidakAdaGambaran">Tidak Ada Gambaran Pneumonia</label>
                                    </div>
                                </div>

                                @error('pulmonary_xray')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="xray_result" class="col-sm-3 col-form-label">Hasil X Ray Paru</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('xray_result') is-invalid @enderror" name="xray_result" value="{{ old('xray_result') }}" placeholder="Hasil X Ray Paru">

                                @error('xray_result')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="leukosit" class="col-sm-3 col-form-label">Perhitungan Leukosit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('leukosit') is-invalid @enderror" name="leukosit" value="{{ old('leukosit') }}" placeholder="Perhitungan Leukosit">

                                @error('leukosit')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="limfosit" class="col-sm-3 col-form-label">Perhitungan Limfosit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('limfosit') is-invalid @enderror" name="limfosit" value="{{ old('limfosit') }}" placeholder="Perhitungan Limfosit">

                                @error('limfosit')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="trombosit" class="col-sm-3 col-form-label">Perhitungan Trombosit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('trombosit') is-invalid @enderror" name="trombosit" value="{{ old('trombosit') }}" placeholder="Perhitungan Trombosit">

                                @error('trombosit')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="health_status" class="col-sm-3 col-form-label">Status Kesehatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('health_status') is-invalid @enderror" name="health_status" value="{{ old('health_status') }}" placeholder="Status Kesehatan">

                                @error('health_status')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="using_ventilator" class="col-sm-3 col-form-label">Menggunakan Ventilator <span class="text-danger">*</span></label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('using_ventilator') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaVentilator" name="using_ventilator" value="1" {{ old('using_ventilator') == true ? 'checked' : '' }}>
                                        <label for="iyaVentilator">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakVentilator" name="using_ventilator "value="2" {{ old('using_ventilator') == "2" ? 'checked' : '' }}>
                                        <label for="tidakVentilator">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullVentilator" name="using_ventilator" {{ is_null(old('using_ventilator')) ? 'checked' : '' }} value="">
                                        <label for="nullVentilator">Tidak Keduanya</label>
                                    </div>
                                </div>

                                @error('using_ventilator')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- RIWAYAT KONTAK/PAPARAN -->
                    <div class="tab">
                        <div class="form-group row">
                            <label class="col col-form-label">4. RIWAYAT KONTAK/PAPARAN</label>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Dalam 14 hari sebelum sakit, apakah pasien melakukan perjalanan ke luar negeri?</label>
                            <div class="col-sm-9 mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_travel" id="trave_1" value="1">
                                    <label class="form-check-label" for="trave_1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_travel" id="trave_0" value="0">
                                    <label class="form-check-label" for="trave_0">Tidak</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Jika ya, urutkan berdasarkan tanggal kunjungan:</label>
                            <div class="col-sm-9 mt-2">
                                <div class="row">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                        <th scope="col">Tanggal kunjungan:</th>
                                        <th scope="col">Kota:</th>
                                        <th scope="col">Negara:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input name="travel[date_of_visit][]" class="form-control" type="date"></td>
                                            <td><input name="travel[city][]" class="form-control" type="text"></td>
                                            <td><input name="travel[country][]" class="form-control" type="text"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default plus"><i class="fas fa-plus"></i></button>
                                            <button type="button" class="btn btn-default minus"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Dalam 14 hari sebelum sakit, apakah pasien kontak dengan orang yang sakit?</label>
                            <div class="col-sm-9 mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_contact_sick_people" id="contact_sick_people_1" value="1">
                                    <label class="form-check-label" for="contact_sick_people_1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_contact_sick_people" id="contact_sick_people_0" value="0">
                                    <label class="form-check-label" for="contact_sick_people_0">Tidak</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Jika ya, isi tabel berikut:</label>
                            <div class="col-sm-9 mt-2">
                                <div class="row">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                        <th scope="col">Nama:</th>
                                        <th scope="col">Alamat:</th>
                                        <th scope="col">Hubungan:</th>
                                        <th scope="col">Tanggal kontak:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input name="contact_sick_people[name_people_sick][]" class="form-control" type="text"></td>
                                            <td><input name="contact_sick_people[address][]" class="form-control" type="text"></td>
                                            <td><input name="contact_sick_people[relation][]" class="form-control" type="text"></td>
                                            <td><input name="contact_sick_people[contact_date][]" class="form-control" type="date"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default plus"><i class="fas fa-plus"></i></button>
                                            <button type="button" class="btn btn-default minus"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">
                                Apakah orang tersebut tersangka/terinfeksi Covid-19?
                            </label>
                            <div class="col-sm-9 mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="contact_with_suspect_covid19" id="contact_with_suspect_covid19_1" value="1">
                                    <label class="form-check-label" for="contact_with_suspect_covid19_1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="contact_with_suspect_covid19" id="contact_with_suspect_covid19_0" value="0">
                                    <label class="form-check-label" for="contact_with_suspect_covid19_0">Tidak</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">
                                Apakah ada anggota keluarga pasien yang sakitnya sama?
                            </label>
                            <div class="col-sm-9 mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="check_family_members_infected" id="check_family_members_infected_1" value="1">
                                    <label class="form-check-label" for="check_family_members_infected_1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="check_family_members_infected" id="check_family_members_infected_0" value="0">
                                    <label class="form-check-label" for="check_family_members_infected_0">Tidak</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">
                                Keterangan lainnya: (sebutkan informasi yang dianggap penting)
                            </label>
                            <div class="col-sm-9 mt-2">
                            <textarea name="note" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-9 offset-sm-3">
                            <input type="hidden" name="patient_id" id="patientID">
                            <button type="button" id="prevBtn" class="btn btn-default" onclick="nextPrev(-1)">Sebelumnya</button>
                            <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)">Berikutnya</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- existing patient -->
    <div class="modal fade" id="modalPatient">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Daftar Pasien</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">NIK</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Tanggal Lahir</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th width="10%" class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $patient->nik }}</td>
                                    <td>{{ $patient->fullname }}</td>
                                    <td>{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d/m/Y') }}</td>
                                    <td>{{ $patient->gender }}</td>
                                    <td class="text-center">
                                        <button data-dismiss="modal" type="button" class="btn btn-primary btn-xs selectPatient" value="{{ $patient }}"><i class="fas fa-check mr-1"></i> Pilih</button>
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
<!-- InputMask -->
<script src="{{ url('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ url('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
    // Datatables
    $("#datatable").DataTable();

    // Datemask dd/mm/yyyy
    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    // Form wizard
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";

        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }

        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Berikutnya";
        }
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");

        // Hide the current tab:
        x[currentTab].style.display = "none";

        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;

        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            x[currentTab-1].style.display = "block";
            // ... the form gets submitted:
            document.getElementById("registrationForm").submit();
            return false;
        }

        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    // Select existing patient
    $(".selectPatient").click(function () {
        var x = $(this).prop("value");
        var obj = JSON.parse(x);

        $("input[name='fullname']").val(obj.fullname);
        $("input[name='nik']").val(obj.nik);
        $("input[name='date_of_birth']").val(obj.date_of_birth);
        $("input[name='age_year']").val(obj.age_year);
        $("input[name='age_month']").val(obj.age_month);
        $("input[value="+obj.gender+"]").attr("checked", true);
        $("input[name='address_1']").val(obj.address_1);
        $("input[name='address_2']").val(obj.address_2);
        $("input[name='phone_number']").val(obj.phone_number);
        $("input[name='patient_id']").val(obj.id);
    });

    $('.btn.btn-default.plus').click((event) => {
        const parentObj = $( event.target ).closest(".form-group.row");
        const tbl = parentObj.find('table');
        const tr = tbl.find('tbody > tr').first().clone();
        tr.appendTo( tbl.find('tbody') );
    });
    $('.btn.btn-default.minus').click((event) => {
        const parentObj = $( event.target ).closest(".form-group.row");
        const tbl = parentObj.find('table');
        const tr = tbl.find('tbody > tr');

        if(tr.length < 2){
            return false;
        }

        tr.last().remove();
    });
</script>
@endsection
