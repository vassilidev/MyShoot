<div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Find people') }}
        </div>
        <div class="card-body">
            <div class="my-4" wire:ignore>
                <select class="form-select" id="findPeople">
                    <option></option>
                    @foreach($allPeople as $people)
                        <option value="{{ $people->id }}">{{ $people->fullName }}</option>
                    @endforeach
                </select>
            </div>

            @if($selectedPeople)
                <p>{{ __('Selected') }} : {{ $allPeople->find($selectedPeople)->fullName }}</p>

                <button class="btn btn-secondary" wire:click.prevent="shootPeople">
                    {{ __('Shooted') }} <i class="ms-2 fas fa-camera"></i>
                </button>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card my-4">
                <div class="card-header">
                    {{ __('Input directory files') }} ({{ config('filesystems.disks.inputShooting.root') }})
                </div>
                <div class="card-body" wire:poll.visible.2000ms>
                    <div class="row gy-3">
                        @foreach($inputFiles as $inputFile)
                            <div class="col-md-6 col-lg-4">
                                <div class="card">
                                    <img class="card-img-top img-fluid"
                                         src="{{ Storage::disk('inputShooting')->url($inputFile->getFileName()) }}"/>
                                    <div class="card-block">
                                        <small class="card-title">{{ $inputFile->getFileName() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card my-4">
                <div class="card-header">
                    {{ __('Output directory files') }}
                    ({{ config('filesystems.disks.outputShooting.root') . "\\" . $shooting->directoryName }})
                </div>
                <div class="card-body" wire:poll.visible.2000ms>
                    <div class="row gy-3">
                        @foreach($outputFiles as $outputFile)
                            <div class="col-md-6 col-lg-4">
                                <div class="card">
                                    <img class="card-img-top img-fluid"
                                         src="{{ Storage::disk('outputShooting')->url($shooting->directoryName . DIRECTORY_SEPARATOR . $outputFile->getFileName()) }}"/>
                                    <div class="card-block">
                                        <small class="card-title">{{ $outputFile->getFileName() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="card my-4" wire:ignore>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="people">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('User') }}</th>
                        <th>{{ __('Date') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>--}}
</div>

@push('css')
    <style>
        .card-img-top {
            width: 250px;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function () {
            /*$('#people').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('panel.datatables.shooting.people', $shooting) }}',
                columns: [
                    {data: 'id'},
                    {data: 'role.name'},
                    {data: 'name'},
                    {data: 'surname'},
                    {data: 'shoot_at'},
                ],
            });*/

            let findPeople = $('#findPeople');

            findPeople.select2({
                width: '100%',
                placeholder: '{{ __("Select an option") }}'
            });

            findPeople.on('change', function (e) {
                let data = findPeople.select2("val");

                @this.
                set('selectedPeople', data);
            });
        });
    </script>
@endpush