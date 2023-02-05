@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="card my-4">
            <div class="card-body">
                <a href="{{ route('panel.shooting.create') }}" class="btn btn-success mb-4">
                    {{ __('Create a shooting') }} <i class="ms-2 fas fa-plus"></i>
                </a>
                <div class="table-responsive">
                    <table id="shootingTable" class="table table-striped table-hover" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Shooting date') }}</th>
                            <th scope="col">{{ __('Nbr people') }}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#shootingTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: "{{ route('panel.datatables.shooting') }}",
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'shooting_date'},
                    {data: 'nbr_people'},
                    {data: 'action', searchable: false, sortable: false},
                ]
            });
        });
    </script>
@endpush
