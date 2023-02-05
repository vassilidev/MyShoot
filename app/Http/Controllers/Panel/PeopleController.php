<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PeopleRequest;
use App\Models\People;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.panel.people.indexPeople');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $roles = Role::all();

        return view('pages.panel.people.createPeople', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PeopleRequest $request
     *
     * @return RedirectResponse
     */
    public function store(PeopleRequest $request): RedirectResponse
    {
        People::create($request->validated());

        toast(__('People successfully created !'), 'success');

        return redirect()->route('panel.people.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return View
     */
    public function edit($id): View
    {
        $roles = Role::all();
        $people = People::findOrFail($id);

        return view('pages.panel.people.editPeople', compact('roles', 'people'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PeopleRequest $request
     * @param               $id
     *
     * @return RedirectResponse
     */
    public function update(PeopleRequest $request, $id): RedirectResponse
    {
        People::findOrFail($id)->update($request->validated());

        toast(__('People successfully updated !'), 'success');

        return redirect()->route('panel.people.index');
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
        People::findOrFail($id)->delete();

        toast(__('People successfully deleted !'), 'success');

        return redirect()->route('panel.people.index');
    }
}
