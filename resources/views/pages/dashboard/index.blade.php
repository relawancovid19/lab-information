@extends('layouts.app')

@section('extend-css')
    <style>
        .border-statistic-width{
            border-left-width: 0.5rem !important;
        }
    </style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default color-palette-box">
            <div class="card-body">
                <div class="col-12">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Selamat datang {{ Auth::user()->name }}!
                </div>
                <div class="mt-4 d-flex flex-row align-content-stretch">
                    <div class="media-body m-2 card p-3 border-left border-danger border-statistic-width">
                        <h3 class="text-bold">Jumlah Pasien</h3>
                        <p class="text-xl">{{ $patient_count }}</p>
                    </div>
                    <div class="media-body m-2 card p-3 border-left border-primary border-statistic-width">
                        <h3 class="text-bold">Jumlah Registrasi</h3>
                        <p class="text-xl">{{ $registration_count }}</p>
                    </div>
                    <div class="media-body m-2 card p-3 border-left border-info border-statistic-width">
                        <h3 class="text-bold">Jumlah Sampel</h3>
                        <p class="text-xl">{{ $sample_taken_count }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
