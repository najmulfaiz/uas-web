@extends('layouts.app')

@section('title') User @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') User @endslot
        @slot('title') Edit User @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') ?? $user->name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') ?? $user->email }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control">
                            <span class="text-secondary fst-italic font-sm">Isi password untuk mengubah password</span>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
                            <button class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
