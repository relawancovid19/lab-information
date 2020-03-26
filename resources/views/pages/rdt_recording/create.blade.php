@extends('layouts.app')

@section('extend-css')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">
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
					<li class="breadcrumb-item"><a href="{{ route('rdt_recording.index') }}">Rapid Diagnostic Test</a></li>
					<li class="breadcrumb-item active">Entri Baru</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<div class="text-right">
			<a href="{{ route('rdt_recording.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left pr-1"></i> Kembali</a>
		</div>
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="card card-default color-palette-box">
			<div class="card-body">
				@if($errors->all())
				<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i>
					<b>Ups!</b>
						@foreach($errors->all() as $error)
						<br/>{{$error}}
						@endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				@endif
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check"></i>
                    <b>Berhasil!</b>
                    @foreach(session('success') as $success)
                        <br/>{{$success}}
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
				<form id="pengambilanPenerimaanSampelForm" class="form-horizontal" action="{{ route('rdt_recording.store') }}" method="post">
					@csrf
					<div class="form-group row">
						<label for="registration_number" class="col-sm-3 col-form-label">Pasien <span class="text-danger">*</span></label>
						<div class="col-sm-4">
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="id_type"
									value="registration_number"
									required
									checked
									/> Nomor Registrasi
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="id_type"
									value="nik"
									required
									@if(old('id_type') == 'nik') checked @endif
									/> NIK
								</label>
							</div>
							<input type="text" class="form-control" name="registration_number" id="registration_number" placeholder="mis. 332123454332" required value="{{old('registration_number')}}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Tanggal hari pertama demam <span class="text-danger">*</span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<input
								type="text"
								class="form-control date-picker"
								name="date_fever_first"
								placeholder="DD-MM-YYYY" id="date_fever_first"
								value="{{old('date_fever_first')}}"
								/>
								<div class="input-group-append" data-target="date_fever_first" data-toggle="datetimepicker">
									<div class="btn btn-default"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<h4>Rapid Diagnostic Test ke-1</h4>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Tanggal tes <span class="text-danger">*</span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<input
								type="text"
								class="form-control date-picker"
								name="first_test_date"
								placeholder="DD-MM-YYYY" id="first_test_date"
								value="{{old('first_test_date')}}"
								/>
								<label class="input-group-append" data-target="date_fever_first" data-toggle="datetimepicker">
									<div class="btn btn-default"><i class="fa fa-calendar"></i></div>
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Waktu tes <span class="text-danger">*</span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<input
								type="text"
								class="form-control duration"
								name="first_test_time"
								placeholder="JJ:mm" id="first_test_time"
								value="{{old('first_test_time')}}"
								/>
								<div class="input-group-append" data-target="date_fever_first" data-toggle="datetimepicker">
									<div class="btn btn-default"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Jenis Sampel <span class="text-danger">*</span></label>
						<div class="col-sm-6">
							<div class="form-group">
								<div class="row d-flex align-items-center">
									<div class="col-md-4">
										<input
										type="checkbox"
										id="first_serum"
										name="first_sample_type_serum"
										class="enabler"
										data-target="#first_serum_sample_number"
										style="margin-right: 5px"
										@if(old('first_serum_sample_number')) checked @endif
										/>
										<label for="first_serum" style="font-weight: normal;padding: 0;margin: 0">Serum</label>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control" id="first_serum_sample_number" name="first_serum_sample_number" placeholder="Nomor sampel" value="{{old('first_serum_sample_number')}}" required>									
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row d-flex align-items-center">
									<div class="col-md-4">
										<input
										type="checkbox"
										id="first_whole_blood"
										name="first_sample_type_whole_blood"
										class="enabler"
										data-target="#first_whole_blood_sample_number"
										style="margin-right: 5px"
										@if(old('first_whole_blood_sample_number')) checked @endif
										/>
										<label for="first_whole_blood" style="font-weight: normal;padding: 0;margin: 0">Whole Blood</label>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control" id="first_whole_blood_sample_number" name="first_whole_blood_sample_number" placeholder="Nomor sampel" value="{{old('first_whole_blood_sample_number')}}" required>									
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3">Kesimpulan pemeriksaan serum <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="first_serum_result"
									value="negative"
									checked
									/> Negative
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="first_serum_result"
									value="positive"
									@if(old('first_serum_result') == 'positive') checked @endif
									/> Positive
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="first_serum_result"
									value="unknown"
									@if(old('first_serum_result') == 'unknown') checked @endif
									/> Tidak dapat ditentukan
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3">Kesimpulan pemeriksaan whole blood <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="first_whole_blood_result"
									value="negative"
									checked
									/> Negative
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="first_whole_blood_result"
									value="positive"
									@if(old('first_whole_blood_result') == 'positive') checked @endif
									/> Positive
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="first_whole_blood_result"
									value="unknown"
									@if(old('first_whole_blood_result') == 'unknown') checked @endif
									/> Tidak dapat ditentukan
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="first_analyst" class="col-sm-3 col-form-label">Petugas yang melakukan tes <span class="text-danger">*</span></label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="first_analyst" id="first_analyst" placeholder="Nama petugas" value="{{old('first_analyst')}}" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="first_notes" class="col-sm-3 col-form-label">Catatan</label>
						<div class="col-sm-5">
							<textarea name="first_notes" id="first_notes" class="form-control" placeholder="tulis catatan disini">{{old('first_notes')}}</textarea>
						</div>
					</div>
					<hr>
					<h4>Rapid Diagnostic Test ke-2</h4>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Tanggal tes <span class="text-danger">*</span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<input
								type="text"
								class="form-control date-picker"
								name="second_test_date"
								placeholder="DD-MM-YYYY" id="second_test_date"
								value="{{old('second_test_date')}}"
								/>
								<label class="input-group-append" data-target="date_fever_second" data-toggle="datetimepicker">
									<div class="btn btn-default"><i class="fa fa-calendar"></i></div>
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Waktu tes <span class="text-danger">*</span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<input
								type="text"
								class="form-control duration"
								name="second_test_time"
								placeholder="JJ:mm" id="second_test_time"
								value="{{old('second_test_time')}}"
								/>
								<div class="input-group-append" data-target="date_fever_second" data-toggle="datetimepicker">
									<div class="btn btn-default"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Jenis Sampel <span class="text-danger">*</span></label>
						<div class="col-sm-6">
							<div class="form-group">
								<div class="row d-flex align-items-center">
									<div class="col-md-4">
										<input
										type="checkbox"
										id="second_serum"
										name="second_sample_type_serum"
										class="enabler"
										data-target="#second_serum_sample_number"
										style="margin-right: 5px"
										@if(old('second_serum_sample_number')) checked @endif
										/>
										<label for="second_serum" style="font-weight: normal;padding: 0;margin: 0">Serum</label>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control" id="second_serum_sample_number" name="second_serum_sample_number" placeholder="Nomor sampel" value="{{old('second_serum_sample_number')}}" required>									
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row d-flex align-items-center">
									<div class="col-md-4">
										<input
										type="checkbox"
										id="second_whole_blood"
										name="second_sample_type_whole_blood"
										class="enabler"
										data-target="#second_whole_blood_sample_number"
										style="margin-right: 5px"
										@if(old('second_whole_blood_sample_number')) checked @endif
										/>
										<label for="second_whole_blood" style="font-weight: normal;padding: 0;margin: 0">Whole Blood</label>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control" id="second_whole_blood_sample_number" name="second_whole_blood_sample_number" placeholder="Nomor sampel" value="{{old('second_whole_blood_sample_number')}}" required>									
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3">Kesimpulan pemeriksaan serum <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="second_serum_result"
									value="negative"
									checked
									/> Negative
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="second_serum_result"
									value="positive"
									@if(old('second_serum_result') == 'positive') checked @endif
									/> Positive
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="second_serum_result"
									value="unknown"
									@if(old('second_serum_result') == 'unknown') checked @endif
									/> Tidak dapat ditentukan
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3">Kesimpulan pemeriksaan whole blood <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="second_whole_blood_result"
									value="negative"
									checked
									/> Negative
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="second_whole_blood_result"
									value="positive"
									@if(old('second_whole_blood_result') == 'positive') checked @endif
									/> Positive
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input
									type="radio"
									name="second_whole_blood_result"
									value="unknown"
									@if(old('second_whole_blood_result') == 'unknown') checked @endif
									/> Tidak dapat ditentukan
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="second_analyst" class="col-sm-3 col-form-label">Petugas yang melakukan tes <span class="text-danger">*</span></label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="second_analyst" id="second_analyst" placeholder="Nama petugas" value="{{old('second_analyst')}}" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="second_notes" class="col-sm-3 col-form-label">Catatan</label>
						<div class="col-sm-5">
							<textarea name="second_notes" id="second_notes" class="form-control" placeholder="tulis catatan disini">{{old('second_notes')}}</textarea>
						</div>
					</div>
					<div class="row">
						<div class="offset-sm-3 col-md-3">
							<button type="submit" class="btn btn-info">Simpan</button>
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
<script src="{{ url('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script>
	$(document).ready(() => {
		$('input.date-picker').daterangepicker({
			singleDatePicker: true,
			opens: 'right',
			locale: {
				format: 'DD-MM-Y'
			}
		}, function(start, end, label) {
		});
		$('input.duration').daterangepicker({
			singleDatePicker: true,
			timePicker: true,
			timePicker24Hour: true,
			timePickerIncrement: 1,
			timePickerSeconds: false,
			locale: {
				format: 'HH:mm'
			}
		}).on('show.daterangepicker', function (ev, picker) {
			picker.container.find(".calendar-table").hide();
		});
		$('.enabler').on('change',function(){
			if($(this).is(':checked')){
				$($(this).data('target')).removeAttr('disabled');
			}else{
				$($(this).data('target')).attr('disabled','disabled');
			}
		})
		$('.enabler').change();
	})
</script>
@endsection
