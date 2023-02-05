<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Shooting\ImportFileRequest;
use App\Jobs\Panel\People\ImportPeopleJob;
use Illuminate\Http\RedirectResponse;

class ImportPeopleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ImportFileRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(ImportFileRequest $request): RedirectResponse
    {
        if ($request->hasFile('file')) {
            ImportPeopleJob::dispatch($request->file('file')->store('excel'));

            toast(__('Import in progress...'), 'info');
        }

        return redirect()->back();
    }
}
