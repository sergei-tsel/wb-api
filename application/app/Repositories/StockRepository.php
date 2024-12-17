<?php

namespace App\Repositories;

use App\Models\Stock;
use Illuminate\Support\Carbon;

class StockRepository extends AbstractRepository
{
    protected const MODEL = Stock::class;

    protected const CATEGORY = 'stocks';

    public function pullAll(): void
    {
        $this->pullMany([
            'dateFrom' => Carbon::today()->startOfDay()->format("Y-m-d H:i:s"),
        ]);
    }

    public function save(array $data): void
    {
        foreach ($data as $item) {
            $this::MODEL::query()->insert([
                'data' => $item,
            ]);
        }
    }
}
