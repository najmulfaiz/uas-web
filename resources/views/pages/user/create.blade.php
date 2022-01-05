@extends('layouts.app')

@section('title') User @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') User @endslot
        @slot('title') Tambah User @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">E-Mail</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                        </div>
                        <div class="form-group">
                            <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                            <button class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
