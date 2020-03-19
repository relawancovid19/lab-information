@extends('app')
@section('title', 'Tambah Pasien')
@section('content')
<a href="{{ url('/pasien') }}">Kembali</a>
<form action="{{ url('/pasien') }}" method="POST">

	@include('pasien.extend.form')

	<input type="submit" value="Tambah">
</form>
@endsection