<?php

namespace Database\Seeders;

use App\Models\Dosis;
use Illuminate\Database\Seeder;

class DosisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosis = [
            'Dosis 1', 'Dosis 2', 'Dosis 3'
        ];

        foreach($dosis as $dosis) {
            Dosis::create([
                'nama' => $dosis
            ]);
        }
    }
}
