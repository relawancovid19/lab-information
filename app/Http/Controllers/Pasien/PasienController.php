<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pasien;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::where('active', request('active', 1))->get();
        return view('pasien.index', compact('pasiens'));
    }
    public function create()
    {
        $pasien = new Pasien();
        return view('pasien.create', compact('pasien'));
    }
    public function store()
    {
        $pasien = Pasien::create($this->validateData());

        return redirect('/pasien/' . $pasien->id);
    }
    public function show(Pasien $pasien)
    {
        return view('pasien.show', compact('pasien'));
    }
    public function edit(Pasien $pasien)
    {
        return view('pasien.edit', compact('pasien'));
    }
    public function update(Pasien $pasien)
    {
        $pasien->update($this->validateData());

        return redirect('/pasien/' . $pasien->id);
    }
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect('/pasien');
    }

    protected function validateData()
    {
        return request()->validate([
            'nama' => 'required',
            'usia' => 'required|numeric',
            'jenis_kelamin' => 'required|alpha',
            'alamat' => 'required',
            'telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email',
        ]);
    }
}
