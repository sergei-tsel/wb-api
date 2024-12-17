<?php

namespace App\Repositories;

use App\Models\Sale;

class SaleRepository extends AbstractRepository
{
    protected const MODEL = Sale::class;

    protected const CATEGORY = 'sales';
}
