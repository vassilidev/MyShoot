<?php

namespace App\Http\Controllers\Panel\Datatables;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class RoleDataTablesController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $model = Role::query();

        return DataTables::eloquent($model)
            ->addColumn('action', 'datatables.role.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
