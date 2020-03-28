@extends('layouts.app')

@section('extend-css')
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
                <h1 class="m-0 text-dark">Edit Registrasi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('registrations.index') }}">Registrasi</a></li>
                    <li class="breadcrumb-item active">Edit Registrasi</li>
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
                <form id="registrationForm" class="form-horizontal" action="{{ route('registrations.update', $registration->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="registration_number" class="col-sm-3 col-form-label">No. Registrasi <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('registration_number') is-invalid @enderror" name="registration_number" value="{{ old('registration_number', $registration->registration_number) }}" placeholder="Nomor registrasi">

                            @error('registration_number')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sample_number" class="col-sm-3 col-form-label">No. Sampel <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('sample_number') is-invalid @enderror" name="sample_number" value="{{ old('sample_number', $registration->sample_number) }}" placeholder="Nomor sampel">

                            @error('sample_number')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <!-- Step 1: Identitas Pasien -->
                    <div class="tab">
                        <div class="form-group row">
                            <label class="col col-form-label">1. IDENTITAS PASIEN</label>
                        </div>
                        <div class="form-group row">
                            <label for="dinkes_sender" class="col-sm-3 col-form-label">Dinkes Pengirim</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('dinkes_sender') is-invalid @enderror" name="dinkes_sender" value="{{ old('dinkes_sender', $registration->dinkes_sender) }}" placeholder="Dinkes pengirim">

                                @error('dinkes_sender')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fasyankes_sender" class="col-sm-3 col-form-label">Fasyankes Pengirim</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('fasyankes_sender') is-invalid @enderror" name="fasyankes_sender" value="{{ old('fasyankes_sender', $registration->fasyankes_sender) }}" placeholder="Fasyankes pengirim">

                                @error('fasyankes_sender')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="doctor" class="col-sm-3 col-form-label">Dokter Penanggung Jawab</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('doctor') is-invalid @enderror" name="doctor" value="{{ old('doctor', $registration->doctor) }}" placeholder="Dokter penanggung jawab">

                                @error('doctor')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fasyankes_phone" class="col-sm-3 col-form-label">No. Tlp Fasyankes Pengirim</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('fasyankes_phone') is-invalid @enderror" name="fasyankes_phone" value="{{ old('fasyankes_phone', $registration->fasyankes_phone) }}" placeholder="Nomor telepon fasyankes pengirim">

                                @error('fasyankes_phone')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="registration_date" class="col-sm-3 col-form-label">Tanggal Registrasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datemask @error('registration_date') is-invalid @enderror" name="registration_date" value="{{ old('registration_date', \Carbon\Carbon::parse($registration->registration_date)->format('d/m/Y')) }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask placeholder="Tanggal registrasi">

                                @error('registration_date')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fullname" class="col-sm-3 col-form-label">Nama Pasien <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname', $registration->patient->fullname) }}" placeholder="Nama pasien">

                                @error('fullname')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik', $registration->patient->nik) }}" placeholder="Nomor induk kependudukan">

                                @error('nik')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reference_number" class="col-sm-3 col-form-label">No. Rujukan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('reference_number') is-invalid @enderror" name="reference_number" value="{{ old('reference_number', $registration->reference_number) }}" placeholder="Nomor rujukan">

                                @error('reference_number')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_of_birth" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datemask @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth', \Carbon\Carbon::parse($registration->patient->date_of_birth)->format('d/m/Y')) }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask placeholder="Tanggal lahir">

                                @error('date_of_birth')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age_year" class="col-sm-3 col-form-label">Usia</label>
                            <div class="col-sm-5">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('age_year') is-invalid @enderror" name="age_year" value="{{ old('age_year', $registration->patient->age_year) }}">
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
                                    <input type="text" class="form-control @error('age_month') is-invalid @enderror" name="age_month" value="{{ old('age_month', $registration->patient->age_month) }}">
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
                                        <input type="radio" id="laki" name="gender" value="Laki-laki" {{ old('gender', $registration->patient->gender) == 'Laki-laki' ? 'checked' : '' }}>
                                        <label for="laki">Laki-laki</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="perempuan" name="gender" value="Perempuan" {{ old('gender', $registration->patient->gender) == 'Perempuan' ? 'checked' : '' }}>
                                        <label for="gender">Perempuan</label>
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
                                <input type="text" class="form-control @error('address_1') is-invalid @enderror" name="address_1" value="{{ old('address_1', $registration->patient->address_1) }}" placeholder="Alamat">

                                @error('address_1')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address_2" class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address_2" value="{{ old('address_2', $registration->patient->address_2) }}" placeholder="(optional)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-sm-3 col-form-label">No. Telp / HP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number', $registration->patient->phone_number) }}" placeholder="Nomor telepon atau nomor handphone">

                                @error('phone_number')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Step 2: Tanda dan Gejala -->
                    <div class="tab">
                        <div class="form-group row">
                            <label class="col col-form-label">2. TANDA DAN GEJALA</label>
                        </div>
                        <div class="form-group row">
                            <label for="fever" class="col-sm-3 col-form-label">Panas atau Riwayat Panas</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('fever') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaPanas" name="fever" value="1" {{ old('fever', $registration->symptom->fever) === true ? 'checked' : '' }}>
                                        <label for="iyaPanas">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakPanas" name="fever" value="0" {{ old('fever', $registration->symptom->fever) === false ? 'checked' : '' }}>
                                        <label for="tidakPanas">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullPanas" name="fever" {{ old('fever', is_null($registration->symptom->fever)) ? 'checked' : '' }} value="">
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
                                        <input type="radio" id="iyaBatuk" name="cough" value="1" {{ old('cough', $registration->symptom->cough) === true ? 'checked' : '' }}>
                                        <label for="iyaBatuk">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakBatuk" name="cough" value="0" {{ old('cough', $registration->symptom->cough) === false ? 'checked' : '' }}>
                                        <label for="tidakBatuk">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullBatuk" name="cough" {{ old('cough', is_null($registration->symptom->cough)) ? 'checked' : '' }} value="">
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
                                        <input type="radio" id="iyaNyeri" name="sore_throat" value="1" {{ old('sore_throat', $registration->symptom->sore_throat) === true ? 'checked' : '' }}>
                                        <label for="iyaNyeri">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakNyeri" name="sore_throat" value="0" {{ old('sore_throat', $registration->symptom->sore_throat) === false ? 'checked' : '' }}>
                                        <label for="tidakNyeri">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullNyeri" name="sore_throat" {{ old('sore_throat', is_null($registration->symptom->sore_throat)) ? 'checked' : '' }} value="">
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
                                        <input type="radio" id="iyaSesak" name="shortness_of_breath" value="1" {{ old('shortness_of_breath', $registration->symptom->shortness_of_breath) === true ? 'checked' : '' }}>
                                        <label for="iyaSesak">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakSesak" name="shortness_of_breath" value="0" {{ old('shortness_of_breath', $registration->symptom->shortness_of_breath) === false ? 'checked' : '' }}>
                                        <label for="tidakSesak">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullSesak" name="shortness_of_breath" {{ old('shortness_of_breath', is_null($registration->symptom->shortness_of_breath)) ? 'checked' : '' }} value="">
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
                                        <input type="radio" id="iyaFlu" name="flu" value="1" {{ old('flu', $registration->symptom->flu) === true ? 'checked' : '' }}>
                                        <label for="iyaFlu">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakFlu" name="flu" value="0" {{ old('flu', $registration->symptom->flu) === false ? 'checked' : '' }}>
                                        <label for="tidakFlu">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullFlu" name="flu" {{ old('flu', is_null($registration->symptom->flu)) ? 'checked' : '' }} value="">
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
                                        <input type="radio" id="iyaLesu" name="fatigue" value="1" {{ old('fatigue', $registration->symptom->fatigue) === true ? 'checked' : '' }}>
                                        <label for="iyaLesu">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakLesu" name="fatigue" value="0" {{ old('fatigue', $registration->symptom->fatigue) === false ? 'checked' : '' }}>
                                        <label for="tidakLesu">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullLesu" name="fatigue" {{ old('fatigue', is_null($registration->symptom->fatigue)) ? 'checked' : '' }} value="">
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
                                        <input type="radio" id="iyaSakit" name="headache" value="1" {{ old('headache', $registration->symptom->headache) === true ? 'checked' : '' }}>
                                        <label for="iyaSakit">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakSakit" name="headache" value="0" {{ old('headache', $registration->symptom->headache) === false ? 'checked' : '' }}>
                                        <label for="tidakSakit">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullSakit" name="headache" {{ old('headache', is_null($registration->symptom->headache)) ? 'checked' : '' }} value="">
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
                                        <input type="radio" id="iyaDiare" name="diarrhea" value="1" {{ old('diarrhea', $registration->symptom->diarrhea) === true ? 'checked' : '' }}>
                                        <label for="iyaDiare">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakDiare" name="diarrhea" value="0" {{ old('diarrhea', $registration->symptom->diarrhea) === false ? 'checked' : '' }}>
                                        <label for="tidakDiare">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullDiare" name="diarrhea" {{ old('diarrhea', is_null($registration->symptom->diarrhea)) ? 'checked' : '' }} value="">
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
                                        <input type="radio" id="iyaMual" name="nausea_or_vomiting" value="1" {{ old('nausea_or_vomiting', $registration->symptom->nausea_or_vomiting) === true ? 'checked' : '' }}>
                                        <label for="iyaMual">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakMual" name="nausea_or_vomiting" value="0" {{ old('nausea_or_vomiting', $registration->symptom->nausea_or_vomiting) === false ? 'checked' : '' }}>
                                        <label for="tidakMual">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullMual" name="nausea_or_vomiting" {{ old('nausea_or_vomiting', is_null($registration->symptom->nausea_or_vomiting)) ? 'checked' : '' }} value="">
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
                                        <input type="radio" id="iyaKomorbid" name="comorbid" value="1" {{ old('comorbid', $registration->symptom->comorbid) === true ? 'checked' : '' }}>
                                        <label for="iyaKomorbid">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakKomorbid" name="comorbid" value="0" {{ old('comorbid', $registration->symptom->comorbid) === false ? 'checked' : '' }}>
                                        <label for="tidakKomorbid">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullKomorbid" name="comorbid" {{ old('comorbid', is_null($registration->symptom->comorbid)) ? 'checked' : '' }} value="">
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
                                <input type="text" class="form-control @error('comorbid_description') is-invalid @enderror" name="comorbid_description" value="{{ old('comorbid_description', $registration->symptom->comorbid_description) }}" placeholder="Penjelasan penyakit penyerta">

                                @error('comorbid_description')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="other_symptoms" class="col-sm-3 col-form-label">Gejala Lainnya (Jelaskan)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="other_symptoms" value="{{ old('other_symptoms', $registration->symptom->other_symptoms) }}" placeholder="Gejala lainnya">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pulmonary_xray" class="col-sm-3 col-form-label">X-Ray Paru</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('pulmonary_xray') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="tidakXray" name="pulmonary_xray" value="2" {{ old('pulmonary_xray', $registration->symptom->pulmonary_xray) == 0 ? 'checked' : '' }}>
                                        <label for="tidakXray">Tidak Dilakukan</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 mr-1">
                                        <input type="radio" id="gambaranPneumonia" name="pulmonary_xray" value="1" {{ old('pulmonary_xray', $registration->symptom->pulmonary_xray) == 1 ? 'checked' : '' }}>
                                        <label for="gambaranPneumonia">Gambaran Pneumonia</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakAdaGambaran" name="pulmonary_xray" value="2" {{ old('pulmonary_xray', $registration->symptom->pulmonary_xray) == 2 ? 'checked' : '' }}>
                                        <label for="tidakAdaGambaran">Tidak Ada Gambaran Pneumonia</label>
                                    </div>
                                </div>

                                @error('pulmonary_xray')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="using_ventilator" class="col-sm-3 col-form-label">Menggunakan Ventilator</label>
                            <div class="col-sm-9 mt-2">
                                <div class="@error('using_ventilator') form-control is-invalid @enderror">
                                    <div class="icheck-primary d-inline mr-1">
                                        <input type="radio" id="iyaVentilator" name="using_ventilator" value="1" {{ old('using_ventilator', $registration->symptom->using_ventilator) === true ? 'checked' : '' }}>
                                        <label for="iyaVentilator">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="tidakVentilator" name="using_ventilator" value="0" {{ old('using_ventilator', $registration->symptom->using_ventilator) === false ? 'checked' : '' }}>
                                        <label for="tidakVentilator">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1">
                                        <input type="radio" id="nullVentilator" name="using_ventilator" {{ old('using_ventilator', is_null($registration->symptom->using_ventilator)) ? 'checked' : '' }} value="">
                                        <label for="nullVentilator">Tidak Keduanya</label>
                                    </div>
                                </div>

                                @error('using_ventilator')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="button" id="prevBtn" class="btn btn-default" onclick="nextPrev(-1)">Sebelumnya</button>
                            <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)">Berikutnya</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extend-js')
<!-- InputMask -->
<script src="{{ url('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<script>
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
</script>
@endsection