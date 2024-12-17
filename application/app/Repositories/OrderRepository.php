<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends AbstractRepository
{
    protected const MODEL = Order::class;

    protected const CATEGORY = 'orders';
}
