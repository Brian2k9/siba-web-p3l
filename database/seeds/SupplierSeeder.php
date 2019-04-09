<?php

use Illuminate\Database\Seeder;

use App\supplier;

class SupplierSeeder extends Seeder
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
            supplier::create ([
                'nama_supplier' => $faker->name,
                'sales_supplier' => $faker->name,
                'no_telp_supplier' => $faker->phoneNumber,
                'alamat_supplier' => $faker->streetAddress
            ]);
        }
    }
}
