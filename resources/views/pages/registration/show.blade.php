@extends('layouts.app')

@section('extend-css')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<style>
    .hidden {
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
                <h1 class="m-0 text-dark">Detail Registrasi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('registrations.index') }}>Registrasi</a></li>
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
                            <input type="text" class="form-control" name="registration_number" value="{{ $registration->registration_number }}" readonly="">
                        </div>
                    </div>
                    <hr>
                    <!-- Step 1: Identitas Pengirim Spesimen -->
                    <div class="tab">
                        <div class="form-group row">
                            <label class="col-sm col-form-label">1. IDENTITAS PENGIRIM SPESIMEN</label>
                        </div>
                        <div class="form-group row">
                            <label for="dinkes_sender" class="col-sm-3 col-form-label">Dinkes Pengirim</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="dinkes_sender" value="{{ $registration->dinkes_sender }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fasyankes_sender" class="col-sm-3 col-form-label">Fasyankes Pengirim</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="fasyankes_sender" value="{{ $registration->fasyankes_sender }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="medical_record_number" class="col-sm-3 col-form-label">No Rekam Medis</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="medical_record_number" value="{{ isset($registration->patient->medical_record_number) ? $registration->patient->medical_record_number : $registration->medical_record_number }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="doctor" class="col-sm-3 col-form-label">Dokter Penanggung Jawab</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="doctor" value="{{ $registration->doctor }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fasyankes_phone" class="col-sm-3 col-form-label">No. Tlp Fasyankes Pengirim</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="fasyankes_phone" value="{{ $registration->fasyankes_phone }}" readonly="">
                            </div>
                        </div>
                    </div>
                    <!-- Step 2: Identitas Pasien -->
                    <div class="tab">
                        <div class="form-group row">
                            <label class="col-sm col-form-label">2. IDENTITAS PASIEN</label>
                        </div>
                        <div class="form-group row">
                            <label for="fullname" class="col-sm-3 col-form-label">Nama Pasien</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="fullname" value="{{ $registration->patient->fullname }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nik" value="{{ $registration->patient->nik }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_of_birth" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="date_of_birth" value="{{ !is_null($registration->patient->date_of_birth) ? \Carbon\Carbon::parse($registration->patient->date_of_birth)->format('d/m/Y') : '' }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age_year" class="col-sm-3 col-form-label">Usia</label>
                            <div class="col-sm-5">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="age_year" value="{{ $registration->patient->age_year }}" readonly="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Tahun</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="age_month" value="{{ $registration->patient->age_month }}" readonly="">
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
                                    <label for="laki_laki">Laki-laki</label>
                                </div>
                                <div class="icheck-primary d-inline ml-1 disabled">
                                    <input type="radio" {{ $registration->patient->gender == 'Perempuan' ? 'checked' : '' }}>
                                    <label for="perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row {{ ($registration->patient->gender == 'Perempuan' && !is_null($registration->patient->maternity_status)) ? '' : 'hidden' }}">
                            <label for="maternity_status" class="col-sm-3 col-form-label">Apakah hamil atau setelah melahirkan?</label>
                            <div class="col-sm-9 mt-2">
                                <div class="icheck-primary d-inline mr-1 disabled">
                                    <input type="radio" {{ $registration->patient->maternity_status == true ? 'checked' : '' }}>
                                    <label for="hamil-melahirkan">Ya</label>
                                </div>
                                <div class="icheck-primary d-inline ml-1 disabled">
                                    <input type="radio" {{ $registration->patient->maternity_status == false ? 'checked' : '' }}>
                                    <label for="tidak-hamil-melahirkan">Tidak</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_1" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address_1" value="{{ $registration->patient->address_1 }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address_2" class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address_2" value="{{ $registration->patient->address_2 }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-sm-3 col-form-label">No. Telp / HP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone_number" value="{{ $registration->patient->phone_number }}" readonly="">
                            </div>
                        </div>
                    </div>
                    <!-- Step 3: Riwayat Perawatan Pasien Dalam Pengawasan -->
                    <div class="tab">
                        <div class="form-group row">
                            <label class="col col-form-label">3. Riwayat Perawatan Pasien Dalam Pengawasan</label>
                        </div>
                        @foreach ($registration->patient->treatmentHistoryPdps as $treatment)
                        <div class="form-group row">
                            <label for="First" class="col-sm-3 col-form-label">Kunjungan {{ ucwords($treatment->explanation) }}</label>
                            <div class="col-sm-5">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="{{ !is_null($treatment->date_treated) ? \Carbon\Carbon::parse($treatment->date_treated)->format('d/m/Y') : '' }}" readonly="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Tanggal</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="{{ $treatment->fasyankes_name }}" readonly="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">RS/Fasyankes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Step 4: Tanda dan Gejala -->
                    <div class="tab">
                        <div class="form-group row">
                            <label class="col col-form-label">4. TANDA DAN GEJALA</label>
                        </div>
                        <div class="form-group row">
                            <label for="date_onset" class="col-sm-3 col-form-label">Tanggal onset gejala (panas)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="date_onset" value="{{ !is_null($registration->symptom->date_onset) ? \Carbon\Carbon::parse($registration->symptom->date_onset)->format('d/m/Y') : '' }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col col-form-label">Gejala klinis saat spesimen diambil:</p>
                        </div>
                        <div class="form-group row">
                            <label for="fever" class="col-sm-3 col-form-label">Panas atau Riwayat Panas</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->fever == true ? 'checked' : '' }}>
                                        <label for="iyaPanas">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->fever  == false ? 'checked' : '' }}>
                                        <label for="tidakPanas">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->fever) ? 'checked' : '' }}" value="">
                                        <label for="nullPanas">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cough" class="col-sm-3 col-form-label">Batuk</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->cough == true ? 'checked' : '' }}>
                                        <label for="iyaBatuk">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->cough  == false ? 'checked' : '' }}>
                                        <label for="tidakBatuk">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->cough) ? 'checked' : '' }}" value="">
                                        <label for="nullBatuk">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sore_throat" class="col-sm-3 col-form-label">Nyeri Tenggorokan</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->sore_throat == true ? 'checked' : '' }}>
                                        <label for="iyaNyeri">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->sore_throat  == false ? 'checked' : '' }}>
                                        <label for="tidakNyeri">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->sore_throat) ? 'checked' : '' }}" value="">
                                        <label for="nullNyeri">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shortness_of_breath" class="col-sm-3 col-form-label">Sesak Nafas</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->shortness_of_breath == true ? 'checked' : '' }}>
                                        <label for="iyaSesak">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->shortness_of_breath  == false ? 'checked' : '' }}>
                                        <label for="tidakSesak">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->shortness_of_breath) ? 'checked' : '' }}" value="">
                                        <label for="nullSesak">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="flu" class="col-sm-3 col-form-label">Pilek</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->flu == true ? 'checked' : '' }}>
                                        <label for="iyaFlu">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->flu  == false ? 'checked' : '' }}>
                                        <label for="tidakFlu">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->flu) ? 'checked' : '' }}" value="">
                                        <label for="nullFlu">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fatigue" class="col-sm-3 col-form-label">Lesu</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->fatigue == true ? 'checked' : '' }}>
                                        <label for="iyaLesu">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->fatigue  == false ? 'checked' : '' }}>
                                        <label for="tidakLesu">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->fatigue) ? 'checked' : '' }}" value="">
                                        <label for="nullLesu">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="headache" class="col-sm-3 col-form-label">Sakit Kepala</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->headache == true ? 'checked' : '' }}>
                                        <label for="iyaSakit">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->headache  == false ? 'checked' : '' }}>
                                        <label for="tidakSakit">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->headache) ? 'checked' : '' }}" value="">
                                        <label for="nullSakit">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="diarrhea" class="col-sm-3 col-form-label">Diare</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->diarrhea == true ? 'checked' : '' }}>
                                        <label for="iyaDiare">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->diarrhea  == false ? 'checked' : '' }}>
                                        <label for="tidakDiare">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->diarrhea) ? 'checked' : '' }}" value="">
                                        <label for="nullDiare">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nausea_or_vomiting" class="col-sm-3 col-form-label">Mual / Muntah</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->nausea_or_vomiting == true ? 'checked' : '' }}>
                                        <label for="iyaMual">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->nausea_or_vomiting  == false ? 'checked' : '' }}>
                                        <label for="tidakMual">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->nausea_or_vomiting) ? 'checked' : '' }}" value="">
                                        <label for="nullMual">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="other_symptoms" class="col-sm-3 col-form-label">Gejala Lainnya (Jelaskan)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="other_symptoms" value="{{ $registration->symptom->other_symptoms }}" readonly="">
                            </div>
                        </div>
                    </div>
                    <!-- Step 5. Pemeriksaan Penunjang -->
                    <div class="tab">
                        <div class="form-group row">
                            <label class="col col-form-label">5. PEMERIKSAAN PENUNJANG</label>
                        </div>
                        <div class="form-group row">
                            <label for="pulmonary_xray" class="col-sm-3 col-form-label">X-Ray Paru</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" id="iyaXray" name="pulmonary_xray" value="1" {{ old('pulmonary_xray', $registration->symptom->pulmonary_xray) == true ? 'checked' : '' }}>
                                        <label for="iyaXray">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="tidakXray" name="pulmonary_xray" value="0" {{ $registration->symptom->pulmonary_xray == 0 ? 'checked' : '' }}>
                                        <label for="tidakXray">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="xray_result" class="col-sm-3 col-form-label">Hasil X Ray Paru</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="xray_result" value="{{ $registration->symptom->xray_result }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col col-form-label">Hitung sel darah putih:</p>
                        </div>
                        <div class="form-group row">
                            <label for="leukosit" class="col-sm-3 col-form-label">Perhitungan Leukosit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="leukosit" value="{{ $registration->symptom->leukosit }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="limfosit" class="col-sm-3 col-form-label">Perhitungan Limfosit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="limfosit" value="{{ $registration->symptom->limfosit }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="trombosit" class="col-sm-3 col-form-label">Perhitungan Trombosit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="trombosit" value="{{ $registration->symptom->trombosit }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="using_ventilator" class="col-sm-3 col-form-label">Menggunakan Ventilator</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->using_ventilator == true ? 'checked' : '' }}>
                                        <label for="iyaVentilator">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->using_ventilator  == false ? 'checked' : '' }}>
                                        <label for="tidakVentilator">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->using_ventilator) ? 'checked' : '' }}" value="">
                                        <label for="nullVentilator">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="health_status" class="col-sm-3 col-form-label">Status Kesehatan</label>
                            <div class="col-sm-9">
                                <select name="healt_status" class="form-control select2" disabled="">
                                    <option>== Pilih Status Kesehatan ==</option>
                                    <option {{ $registration->symptom->health_status == 0 ? 'selected' : '' }} value="0">Pulang</option>
                                    <option {{ $registration->symptom->health_status == 1 ? 'selected' : '' }} value="1">Dirawat</option>
                                    <option {{ $registration->symptom->health_status == 2 ? 'selected' : '' }} value="2">Meninggal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Step 6. Riwayat Kontak/Paparan -->
                    <div class="tab">
                        <div class="form-group row">
                            <label class="col col-form-label">6. RIWAYAT KONTAK/PAPARAN</label>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Dalam 14 hari sebelum sakit, apakah pasien melakukan perjalanan ke luar negeri?</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input class="form-check-input" {{ $registration->travelHistories->count() > 0 ? 'checked' : '' }} type="radio" name="is_travel">
                                        <label class="form-check-label" for="trave_1">Ya</label>
                                    </div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input class="form-check-input" {{ $registration->travelHistories->count() == 0 ? 'checked' : '' }} type="radio" name="is_travel">
                                        <label class="form-check-label" for="trave_0">Tidak</label>
                                    </div>
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
                                            @if (count($registration->travelHistories) > 0)
                                                @foreach ($registration->travelHistories as $travel)
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="text" value="{{ !is_null($travel->date_of_visit) ? \Carbon\Carbon::parse($travel->date_of_visit)->format('d/m/Y') : '' }}" readonly="">
                                                    </td>
                                                    <td>
                                                        <input name="travel[city][]" class="form-control" type="text" value="{{ $travel->city }}" readonly="">
                                                    </td>
                                                    <td>
                                                        <input name="travel[country][]" class="form-control" type="text" value="{{ $travel->country }}" readonly="">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="text" value="" readonly="">
                                                    </td>
                                                    <td>
                                                        <input name="travel[city][]" class="form-control" type="text" value="" readonly="">
                                                    </td>
                                                    <td>
                                                        <input name="travel[country][]" class="form-control" type="text" value="" readonly="">
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Dalam 14 hari sebelum sakit, apakah pasien kontak dengan orang yang sakit?</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input class="form-check-input" type="radio" name="is_contact_sick_people" {{ $registration->contactHistories->count() > 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="contact_sick_people_1">Ya</label>
                                    </div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input class="form-check-input" type="radio" name="is_contact_sick_people" {{ $registration->contactHistories->count() == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="contact_sick_people_0">Tidak</label>
                                    </div>
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
                                            @if (count($registration->contactHistories))
                                                @foreach ($registration->contactHistories as $contact)
                                                <tr>
                                                    <td>
                                                        <input name="contact_sick_people[name_people_sick][]" class="form-control" value="{{ $contact->name_people_sick }}" type="text" readonly="">
                                                    </td>
                                                    <td>
                                                        <input name="contact_sick_people[address][]" class="form-control" value="{{ $contact->address }}" type="text" readonly="">
                                                    </td>
                                                    <td>
                                                        <input name="contact_sick_people[relation][]" class="form-control" value="{{ $contact->relation }}" type="text" readonly="">
                                                    </td>
                                                    <td>
                                                        <input name="contact_sick_people[contact_date][]" class="form-control" value="{{ !is_null($contact->contact_date) ? \Carbon\Carbon::parse($contact->contact_date)->format('d/m/Y') : '' }}" type="text" readonly="">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>
                                                        <input name="contact_sick_people[name_people_sick][]" class="form-control" value="" type="text" readonly="">
                                                    </td>
                                                    <td>
                                                        <input name="contact_sick_people[address][]" class="form-control" value="" type="text" readonly="">
                                                    </td>
                                                    <td>
                                                        <input name="contact_sick_people[relation][]" class="form-control" value="" type="text" readonly="">
                                                    </td>
                                                    <td>
                                                        <input name="contact_sick_people[contact_date][]" class="form-control" value="" type="text" readonly="">
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">
                                Apakah orang tersebut tersangka/terinfeksi Covid-19?
                            </label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input class="form-check-input" {{ $registration->symptom->contact_with_suspect_covid19 == true ? 'checked' : '' }} type="radio" name="contact_with_suspect_covid19">
                                        <label class="form-check-label" for="contact_with_suspect_covid19_1">Ya</label>
                                    </div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input class="form-check-input" {{ $registration->symptom->contact_with_suspect_covid19 == false ? 'checked' : '' }} type="radio" name="contact_with_suspect_covid19">
                                        <label class="form-check-label" for="contact_with_suspect_covid19_0">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">
                                Apakah ada anggota keluarga pasien yang sakitnya sama?
                            </label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input class="form-check-input" {{ $registration->symptom->check_family_members_infected == true ? 'checked' : '' }} type="radio" name="check_family_members_infected">
                                        <label class="form-check-label" for="check_family_members_infected_1">Ya</label>
                                    </div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input class="form-check-input" {{ $registration->symptom->check_family_members_infected == false ? 'checked' : '' }} type="radio" name="check_family_members_infected">
                                        <label class="form-check-label" for="check_family_members_infected_0">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm col-form-label">Penyakit Penyerta (Komorbid)</p>
                        </div>
                        <div class="form-group row">
                            <label for="hipertensi" class="col-sm-3 col-form-label">Hipertensi</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->hipertensi == true ? 'checked' : '' }}>
                                        <label for="iyaHipertensi">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->hipertensi == false ? 'checked' : '' }}>
                                        <label for="tidakHipertensi">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->hipertensi) ? 'checked' : '' }}" value="">
                                        <label for="nullKomorbid">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="diabetes_mellitus" class="col-sm-3 col-form-label">Diabetes Mellitus</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->diabetes_mellitus == true ? 'checked' : '' }}>
                                        <label for="iyaDiabetesMellitus">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->diabetes_mellitus == false ? 'checked' : '' }}>
                                        <label for="tidakDiabetesMellitus">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->diabetes_mellitus) ? 'checked' : '' }}" value="">
                                        <label for="nullKomorbid">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="liver" class="col-sm-3 col-form-label">Liver</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->liver == true ? 'checked' : '' }}>
                                        <label for="iyaLiver">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->liver == false ? 'checked' : '' }}>
                                        <label for="tidakLiver">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->liver) ? 'checked' : '' }}" value="">
                                        <label for="nullKomorbid">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="neurologi" class="col-sm-3 col-form-label">Neurologi</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->neurologi == true ? 'checked' : '' }}>
                                        <label for="iyaneurologi">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->neurologi == false ? 'checked' : '' }}>
                                        <label for="tidakNeurologi">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->neurologi) ? 'checked' : '' }}" value="">
                                        <label for="nullKomorbid">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hiv" class="col-sm-3 col-form-label">HIV</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->hiv == true ? 'checked' : '' }}>
                                        <label for="iyaHiv">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->hiv == false ? 'checked' : '' }}>
                                        <label for="tidakHiv">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->hiv) ? 'checked' : '' }}" value="">
                                        <label for="nullKomorbid">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kidney" class="col-sm-3 col-form-label">Ginjal</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->kidney == true ? 'checked' : '' }}>
                                        <label for="iyaLiver">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->kidney == false ? 'checked' : '' }}>
                                        <label for="tidakKidney">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->kidney) ? 'checked' : '' }}" value="">
                                        <label for="nullKomorbid">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="chronic_lung" class="col-sm-3 col-form-label">Paru Knonik</label>
                            <div class="col-sm-9 mt-2">
                                <div>
                                    <div class="icheck-primary d-inline mr-1 disabled">
                                        <input type="radio" {{ $registration->symptom->chronic_lung == true ? 'checked' : '' }}>
                                        <label for="iyaChronicLung">Iya</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ $registration->symptom->chronic_lung == false ? 'checked' : '' }}>
                                        <label for="tidakChronicLung">Tidak</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-1 disabled">
                                        <input type="radio" {{ is_null($registration->symptom->chronic_lung) ? 'checked' : '' }}" value="">
                                        <label for="nullKomorbid">Tidak Keduanya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">
                                Keterangan lainnya: (sebutkan informasi yang dianggap penting)
                            </label>
                            <div class="col-sm-9 mt-2">
                                <textarea class="form-control" rows="3" readonly="">{{ $registration->symptom->note }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
