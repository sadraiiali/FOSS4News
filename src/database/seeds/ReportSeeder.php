<?php

use App\Report;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Report::class, 10)->state('post')->create();
        factory(Report::class, 10)->state('comment')->create();
        factory(Report::class, 10)->state('user')->create();
    }
}
