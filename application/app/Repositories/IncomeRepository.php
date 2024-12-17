<?php

namespace App\Repositories;

use App\Models\Income;

class IncomeRepository extends AbstractRepository
{
    protected const MODEL = Income::class;

    protected const CATEGORY = 'incomes';
}
