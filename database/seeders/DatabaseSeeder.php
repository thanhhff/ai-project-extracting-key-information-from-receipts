<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->insert([
            [
                'name' => "Ăn uống",
                'descriptions' => ''
            ],
            [
                'name' => "Mua sắm",
                'descriptions' => ''
            ],
            [
                'name' => "Di chuyển",
                'descriptions' => ''
            ],
            [
                'name' => "Điện nước mạng",
                'descriptions' => ''
            ],
            [
                'name' => "Giải trí",
                'descriptions' => ''
            ],
            [
                'name' => "Khác",
                'descriptions' => ''
            ]
        ]);
    }
}
