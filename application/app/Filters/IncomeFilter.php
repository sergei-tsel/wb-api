<?php

namespace App\Filters;

use App\Models\Income;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Builder;

class IncomeFilter implements FilterInterface
{
    public static function searchByRequest (FormRequest $request): Builder
    {
        return Income::query()
            ->whereBetween('date', [
                $request->dateFrom,
                $request->dateTo,
            ]);
    }
}