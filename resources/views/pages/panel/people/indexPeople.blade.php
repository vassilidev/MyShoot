@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="card my-4">
            <div class="card-body">
                <div class="mb-4">
                    <a href="{{ route('panel.people.create') }}" class="btn btn-success">
                        {{ __('Create a person') }} <i class="ms-2 fas fa-user-plus"></i>
                    </a>
                    <button class="btn btn-green" type="button" data-bs-toggle="modal" data-bs-target="#importModal">
                        {{ __('Import People') }} <i class="fas ms-2 fa-file-excel"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table id="peopleTable" class="table table-striped table-hover" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Photo') }}</th>
                            <th scope="col">{{ __('Role') }}</th>
                            <th scope="col">{{ __('Gender') }}</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Surname') }}</th>
                            <th scope="col">{{ __('Bip') }}</th>
                            <th scope="col">{{ __('Phone') }}</th>
                            <th scope="col">{{ __('Email') }}</th>
                            <th scope="col">{{ __('Nbr photos') }}</th>
                            <th scope="col">{{ __('Created at') }}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('pages.panel.people.create.importPeopleModal')
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            let table = $('#peopleTable').DataTable({
                autoWidth: false,
                serverSide: true,
                processing: true,
                ajax: "{{ route('panel.datatables.people') }}",
                columns: [
                    {data: 'id'},
                    {data: 'photo', searchable: false, sortable: false},
                    {data: 'role.name'},
                    {data: 'gender'},
                    {data: 'name'},
                    {data: 'surname'},
                    {data: 'bip'},
                    {data: 'phone'},
                    {data: 'email'},
                    {data: 'nbr_photos'},
                    {data: 'created_at', name: 'people.created_at'},
                    {data: 'action', searchable: false, sortable: false},
                ],
                order: [[9, 'desc']],
                createdRow: function (row, data) {
                    if (data.nbr_photos > 0) {
                        $(row).addClass('table-success');
                    }
                }
            });

            yadcf.init(table, [
                {
                    column_number: 2,
                    data: @json(\App\Models\Role::pluck('name')),
                    filter_delay: 500
                },
                {
                    column_number: 3,
                    data: @json(array_column(\App\Enums\GenderEnum::cases(), 'value')),
                    filter_delay: 500
                },
                {column_number: 9, filter_type: "range_number", filter_delay: 500},
            ]);
        });
    </script>
@endpush