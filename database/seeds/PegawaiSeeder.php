<?php

use Illuminate\Database\Seeder;
use App\pegawai;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach(range(1,10) as $i) {
            pegawai::create ([
                'id_role' => $faker->numberBetween($min=2, $max=4),
                'nama_pegawai'=> $faker->name,
                'alamat_pegawai'=> $faker->streetAddress,
                'no_telp_pegawai' => $faker->randomNumber(),
                'gaji_perminggu' => $faker->numberBetween($min=100, $max=1000),
                'password_pegawai' => 'test',
                'id_cabang' => $faker->numberBetween($min=1, $max=10)
            ]);
        }
    }
}
