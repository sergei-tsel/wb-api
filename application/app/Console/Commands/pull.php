<?php

namespace App\Console\Commands;

use App\Repositories\IncomeRepository;
use App\Repositories\OrderRepository;
use App\Repositories\SaleRepository;
use App\Repositories\StockRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class pull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Стягивание данных';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            (new SaleRepository())->pullAll();
            (new OrderRepository())->pullAll();
            (new StockRepository())->pullAll();
            (new IncomeRepository())->pullAll();

            DB::commit();

            $this->info('Pull was successful');

            return $this::SUCCESS;
        } catch (\Throwable $exception) {
            Db::rollBack();

            $this->error($exception->getMessage());
            $this->info($exception->getTraceAsString());

            return $this::FAILURE;
        }
    }
}
