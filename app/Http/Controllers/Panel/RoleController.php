<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\RoleRequest;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.panel.role.indexRole');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('pages.panel.role.createRole');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     *
     * @return RedirectResponse
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        Role::create($request->validated());

        toast(__('Role successfully created !'), 'success');

        return redirect()->route('panel.role.index');
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
        $role = Role::findOrFail($id);

        return view('pages.panel.role.editRole', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest   $request
     * @param               $id
     *
     * @return RedirectResponse
     */
    public function update(RoleRequest $request, $id): RedirectResponse
    {
        Role::findOrFail($id)->update($request->validated());

        toast(__('Role successfully updated !'), 'success');

        return redirect()->route('panel.role.index');
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
        Role::findOrFail($id)->delete();

        toast(__('Role successfully deleted !'), 'success');

        return redirect()->route('panel.role.index');
    }
}
