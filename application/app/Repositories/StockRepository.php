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
            'dateFrom' => Carbon::today()->format("Y-m-d"),
        ]);
    }

    public function save(array $data): void
    {
        $values = [];

        foreach ($data as $item) {
            $values[] = [
                'data' => json_encode($item),
            ];
        }

        $this::MODEL::query()->insert($values);
    }
}
