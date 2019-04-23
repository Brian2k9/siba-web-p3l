<?php

use Illuminate\Database\Seeder;

use App\cabang;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach(range(1,20) as $i) {
            cabang::create ([
                'nama_cabang' => $faker->name,
                'no_telp_cabang' => $faker->randomNumber(),
                'alamat_cabang' => $faker->streetAddress
            ]);
        }
    }
}
