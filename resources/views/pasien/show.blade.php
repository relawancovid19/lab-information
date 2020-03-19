@extends('app')
@section('title', 'Detail Pasien')
@section('content')
<a href="{{ url('/pasien') }}">Kembali</a>
<ul>
	<li>{{ $pasien->nama }}</li>
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
<a href="{{ url('/pasien/'.$pasien->id.'/edit') }}">Edit</a>
<form action="{{ url('/pasien/'.$pasien->id) }}" method="POST">
	
	@csrf
	@method('DELETE')

	<input type="submit" value="Delete">
</form>
@endsection