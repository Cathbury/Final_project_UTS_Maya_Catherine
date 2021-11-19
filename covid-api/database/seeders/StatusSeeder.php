<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::insert([
            ['id' => '1', 'name' => 'POSITIVE'],
            ['2', 'RECOVERED'],
            ['3', 'DEAD']
        ]);
    }
}
