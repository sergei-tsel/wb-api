<?php

namespace App\Repositories;

use App\Services\Loader;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected const MODEL = Model::class;

    protected const CATEGORY = 'category';

    public function pullAll(): void
    {
        $this->pullMany([
            'dateFrom' => Carbon::minValue()->format('Y-m-d'),
            'dateTo'   => Carbon::maxValue()->format('Y-m-d'),
        ]);
    }

    public function pullMany(array $params): int
    {
        $params['page'] = 1;

        $count = $this->pull($params);

        if ($count > 0) {
            for ($params['page'] = 2; $count > 0; $params['page']++) {
                $sum   = $count;
                $count = $this->pull($params);

                $sum   = $sum + $count;
            }
        }

        return $sum ?? $count;
    }

    public function pull($params): int
    {
        $result = $this->load($params);

        if ($result === null) {
            return 0;
        }

        $count = count($result['data']);

        if ($count !== 0) {
            $this->save($result['data']);
        }

        return $count;
    }

    public function load(array $params): ?array
    {
        return (new Loader())->call($this::CATEGORY, $params);
    }

    public function save(array $data): void
    {
        $values = [];

        foreach ($data as $item) {
            $date = $item['date'];
            unset($item['date']);

            $values[] = [
                'date' => $date,
                'data' => json_encode($item),
            ];
        }

        $this::MODEL::query()->insert($values);
    }
}
