<?php

namespace App\Http\Controllers\Panel\Datatables;

use App\Http\Controllers\Controller;
use App\Models\Shooting;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class ShootingDataTablesController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $model = Shooting::query();

        return DataTables::eloquent($model)
            ->editColumn('shooting_date', 'datatables.shooting.shootingDate')
            ->addColumn('action', 'datatables.shooting.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
