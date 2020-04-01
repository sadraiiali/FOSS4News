<?php

use App\Vote;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Vote::class, 10)->states('post')->create();
        factory(Vote::class, 10)->states('comment')->create();
    }
}
