@extends('app')
@section('title', 'Pasien')
@section('content')
	<form action="{{ url('/pasien') }}" method="GET">
		<select name="active" id="filter">
			<option value="1">Active</option>
			<option value="0">Inactive</option>
		</select>
		<input type="submit" value="Filter">
	</form>
	<hr>
	<a href="{{ url('/pasien/create') }}">Tambah</a>
	@foreach ($pasiens as $pasien)
	<ul>
			<li><a href="{{ url('/pasien/'.$pasien->id) }}">{{ $pasien->nama }}</a></li>
			<li>{{ $pasien->usia }} Tahun</li>
			@if($pasien->jenis_kelamin == 'L')
			<li>Laki-laki</li>
			@else
			<li>Perempuan</li>
			@endif
			<li>{{ $pasien->alamat }}</li>
			<li>{{ $pasien->telepon }}</li>
			<li>{{ $pasien->email }}</li>
		</ul>
	@endforeach
@endsection