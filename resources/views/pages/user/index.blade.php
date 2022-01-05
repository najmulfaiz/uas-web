@extends('layouts.app')

@section('title') User @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') User @endslot
@slot('title') User @endslot
@endcomponent

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm waves-effect btn-label waves-light"
                    id="btn_add"><i class="bx bx-plus label-icon"></i> Tambah</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered striped" id="table_user">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    var table_user = $('#table_user').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('user.datatable') }}',
                data: function(d) { }
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    className: 'text-center fit-column',
                    render: function ( data, type, full, meta ) {
                        return meta.settings._iDisplayStart + (meta.row + 1);
                    }
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    searchable: false,
                    className: 'text-center fit-column',
                },
            ]
        });

        $(document).on('click', '.btn_delete', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang telah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: 'Ya, hapus data!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    var token    = $('meta[name=csrf-token]').attr('content');
                    $.ajax({
                        url: '{{ url('user') }}/' + id,
                        type: 'post',
                        data: {
                            _token: token,
                            _method: 'DELETE',
                        },
                        dataType: 'json',
                        success: function(res) {
                            if(res.isError) {
                                toastr["error"](res.message);
                            } else {
                                toastr["success"](res.message);
                            }

                            table_user.ajax.reload();
                        }
                    });
                }
            });
        });
</script>
@endsection
