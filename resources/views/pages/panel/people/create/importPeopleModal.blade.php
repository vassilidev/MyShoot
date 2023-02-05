<div class="modal fade" id="importModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Import People') }}</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('panel.people.importPeople') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="file">{{ __('Select a file') }}</label>
                        <input name="file"
                               type="file"
                               class="form-control"
                               accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                               required>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Import') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>