<?php

use Illuminate\Database\Seeder;

use App\pelanggan;

class PelangganSeeder extends Seeder
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
            pelanggan::create ([
                'nama_pelanggan' => $faker->name,
                'no_telp_pelanggan' => $faker->randomNumber(),
                'alamat_pelanggan' => $faker->streetAddress
            ]);
        }
    }
}
