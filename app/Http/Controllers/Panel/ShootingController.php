<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\ShootingRequest;
use App\Models\Shooting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ShootingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.panel.shooting.indexShooting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('pages.panel.shooting.createShooting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShootingRequest $request
     *
     * @return RedirectResponse
     */
    public function store(ShootingRequest $request): RedirectResponse
    {
        $shooting = Shooting::create($request->validated());

        toast(__('Shooting successfully created !'), 'success');

        return redirect()->route('panel.shooting.show', $shooting);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return View
     */
    public function show($id): View
    {
        $shooting = Shooting::findOrFail($id);

        return view('pages.panel.shooting.showShooting', compact('shooting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return View
     */
    public function edit($id): View
    {
        $shooting = Shooting::findOrFail($id);

        return view('pages.panel.shooting.editShooting', compact('shooting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ShootingRequest $request
     * @param                 $id
     *
     * @return RedirectResponse
     */
    public function update(ShootingRequest $request, $id): RedirectResponse
    {
        $shooting = Shooting::findOrFail($id);

        $shooting->update($request->validated());

        toast(__('Shooting successfully updated !'), 'success');

        return redirect()->route('panel.shooting.show', $shooting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        Shooting::findOrFail($id)->delete();

        toast(__('Shooting successfully deleted !'), 'success');

        return redirect()->route('panel.shooting.index');
    }
}
