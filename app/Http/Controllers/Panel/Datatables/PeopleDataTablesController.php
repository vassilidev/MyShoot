<?php

namespace App\Http\Controllers\Panel\Datatables;

use App\Http\Controllers\Controller;
use App\Models\People;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PeopleDataTablesController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $model = People::query()
            ->with('role:id,name');

        return DataTables::eloquent($model)
            ->editColumn('gender', 'datatables.people.gender')
            ->editColumn('created_at', 'datatables.model.createdAt')
            ->addColumn('photo', 'datatables.people.photo')
            ->addColumn('action', 'datatables.people.action')
            ->filterColumn('nbr_photos', function (Builder $query, string $keyword) {
                if (!Str::contains('-yadcf_delim-', $keyword)) {
                    return;
                }

                $range = explode('-yadcf_delim-', $keyword);

                [$min, $max] = $range;

                if (!empty($min) && empty($max)) {
                    $query->where('nbr_photos', '>=', $min);
                } else if (!empty($max) && empty($min)) {
                    $query->where('nbr_photos', '<=', $max);
                } else {
                    $query->whereBetween('nbr_photos', $range);
                }
            })
            ->rawColumns(['action', 'photo'])
            ->toJson();
    }
}
