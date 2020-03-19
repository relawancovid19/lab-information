@extends('app')
@section('title', 'Edit Pasien')
@section('content')
<a href="{{ url('/pasien') }}">Kembali</a>
<form action="{{ url('/pasien/'.$pasien->id) }}" method="POST">
	
	@method('PATCH')
	@include('pasien.extend.form')

	<input type="submit" value="Edit">
</form>
@endsection