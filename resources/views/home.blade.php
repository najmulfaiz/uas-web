@extends('layouts.guest')

@section('title') Home @endsection

@section('body')

<body>
    @endsection

    @section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">
                    <div class="text-center mb-4">
                        <h4>Informasi Vaksinasi <strong>COVID-19</strong></h4>
                    </div>
                    
                    @foreach($data->sortBy('tanggal') as $row)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-2">{{ \Carbon\Carbon::parse($row->tanggal)->isoFormat('dddd, D MMMM Y') }}</h5>
                            <div class="d-flex align-items-start mb-2">
                                <i class="bx bx-time text-info me-2 mt-1"></i>
                                <p class="m-0">{{ $row->waktu_mulai }} - {{ $row->waktu_selesai }} WIB</p>
                            </div>
                            <div class="d-flex align-items-start mb-2">
                                <i class="bx bx-injection text-info me-2 mt-1"></i>
                                <div class="d-flex flex-column">
                                    <p class="m-0">{{ $row->jenis_vaksin->nama }}</p>
                                    <div>
                                        @foreach ($row->jadwal_dosis as $jadwal_dosis)
                                            <span class="badge bg-info">{{ $jadwal_dosis->dosis->nama }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bx bx-user-voice text-info me-2"></i>
                                <p class="m-0">{{ $row->penyelenggara }}</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="bx bx-map-pin text-info me-2 mt-1"></i>
                                <p class="m-0">
                                    {{ $row->alamat }}
                                    <a href="https://maps.google.com/?q={{ $row->lat }},{{ $row->lng }}" target="_blank"><i class="bx bx-link-external"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="mt-3 text-center">
                        <div>
                            <p>© <script>
                                    document.write(new Date().getFullYear())
                                </script> {{ config('app.name', 'Laravel') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
