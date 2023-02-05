<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        {{ $shooting->full_name }}
                    </h1>
                </div>
                <div class="col-12 col-xl-auto">
                    <a href="{{ route('panel.shooting.edit', $shooting) }}" class="btn btn-success">
                        {{ __('Update Shooting') }} <i class="fas ms-2 fa-edit"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>