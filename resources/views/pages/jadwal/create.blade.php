@extends('layouts.app')

@section('title') Jadwal @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Jadwal @endslot
        @slot('title') Tambah Jadwal @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('jadwal.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Tempat</label>
                            <input type="email" name="status" class="form-control" value="{{ old('status') }}">
                        </div>
                        <div class="form-group">
                            <a href="{{ route('jadwal.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                            <button class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
