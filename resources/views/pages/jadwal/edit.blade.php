@extends('layouts.app')

@section('title') Jadwal @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Jadwal @endslot
        @slot('title') Edit Jadwal @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('jadwal.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') ?? $jadwal->tanggal }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Waktu</label>
                            <div class="input-group mb-3">
                                <input type="time" name="waktu_mulai" class="form-control" value="{{ old('waktu_mulai') ?? $jadwal->waktu_mulai }}">
                                <span class="input-group-text">sampai</span>
                                <input type="time" name="waktu_selesai" class="form-control" value="{{ old('waktu_selesai') ?? $jadwal->waktu_selesai }}">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Vaksin</label>
                            <select name="jenis_vaksin" id="jenis_vaksin" class="form-control">
                                <option value=""> -- Pilih Jenis Vaksin -- </option>
                                @foreach ($vaksin->sortBy('nama') as $k => $vaksin)
                                <option value="{{ $vaksin->id }}" {{ $vaksin->id == $jadwal->jenis_vaksin_id ? 'selected' : '' }}>{{ $vaksin->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Dosis</label>
                            <div>
                                @foreach($dosis as $k => $dosis)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="dosis_{{ $k }}" name="dosis[]" value="{{ $dosis->id }}"
                                        {{ $jadwal->jadwal_dosis->where('dosis_id', $dosis->id)->first() ? 'checked' : '' }}>
                                    <label class="form-check-label" for="dosis_{{ $k }}">{{ $dosis->nama }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="penyelenggara">Penyelenggara</label>
                            <input type="text" name="penyelenggara" class="form-control" value="{{ old('penyelenggara') ?? $jadwal->penyelenggara }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="map">Map</label>
                            <div id="map" style="width: 100%; height: 200px;"></div>
                            <div class="row mt-3">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="lat">Latitude</label>
                                        <input type="text" class="form-control" name="lat" id="lat" placeholder="Latitude" value="{{ old('lat') ?? $jadwal->lat }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="lng">Longitude</label>
                                        <input type="text" class="form-control" name="lng" id="lng" placeholder="Longitude" value="{{ old('lng') ?? $jadwal->lng }}" readonly>
                                    </div>        
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat') ?? $jadwal->alamat }}">
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

@section('script')
<script>
    var lat = {{ old('lat') ?? $jadwal->lat }};
    var lng = {{ old('lng') ?? $jadwal->lng }};

    function initMap() {
        var map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: lat, lng: lng },
            zoom: 15,
        });
        const geocoder = new google.maps.Geocoder();
        var marker = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map,
            draggable:true,
        });
        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById("lat").value = this.getPosition().lat();
            document.getElementById("lng").value = this.getPosition().lng();
            geocodePosition(geocoder, this.getPosition());
        });
    }

    function geocodePosition(geocoder, pos) {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                document.getElementById("alamat").value = responses[0].formatted_address;
            } else {
                console.log('Cannot determine address at this location.');
            }
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfimiFekDq8jEbIdUVWxqOXIRfulaQ7VU&callback=initMap">
</script>
@endsection