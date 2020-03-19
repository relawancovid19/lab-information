@csrf
<div>
	<label for="nama">Nama</label>
	<input type="text" name="nama" id="nama" value="{{ old('nama') ?? $pasien->nama }}" autocomplete="off">
	@error('nama') {{ $message }} @enderror
</div>
<div>
	<label for="usia">Usia</label>
	<input type="number" min="0" max="150" name="usia" id="usia" value="{{ old('usia') ?? $pasien->usia }}" autocomplete="off">
	@error('usia') {{ $message }} @enderror
</div>
<div>
	<label for="jenis_kelamin">Jenis Kelamin</label>
	<select name="jenis_kelamin" id="jenis_kelamin">
		<option value="" disabled selected>--Pilih Salah Satu--</option>
		<option value="L" @if(old('jenis_kelamin')){{ old('jenis_kelamin') == "L" ? "selected" : "" }}@else{{ $pasien->jenis_kelamin == "L" ? "selected" : "" }}@endif>Laki-laki</option>
		<option value="P" @if(old('jenis_kelamin')){{ old('jenis_kelamin') == "P" ? "selected" : "" }}@else{{ $pasien->jenis_kelamin == "P" ? "selected" : "" }}@endif>Perempuan</option>
	</select>
	@error('jenis_kelamin') {{ $message }} @enderror
</div>
<div>
	<label for="alamat">Alamat</label>
	<input type="text" name="alamat" id="alamat" value="{{ old('alamat') ?? $pasien->alamat }}" autocomplete="off">
	@error('alamat') {{ $message }} @enderror
</div>
<div>
	<label for="telepon">Telepon</label>
	<input type="text" name="telepon" id="telepon" value="{{ old('telepon') ?? $pasien->telepon }}" autocomplete="off">
	@error('telepon') {{ $message }} @enderror
</div>
<div>
	<label for="email">Email</label>
	<input type="email" name="email" id="email" value="{{ old('email') ?? $pasien->email }}" autocomplete="off">
	@error('email') {{ $message }} @enderror
</div>