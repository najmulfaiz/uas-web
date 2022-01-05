<?php

namespace Database\Seeders;

use App\Models\JenisVaksin;
use Illuminate\Database\Seeder;

class JenisVaksinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis_vaksin = [
            'Sinovac', 'AstraZeneca', 'Moderna', 'Pfizer', 'Biofarma', 'Sinopharm'
        ];

        foreach($jenis_vaksin as $jenis_vaksin) {
            JenisVaksin::create([
                'nama' => $jenis_vaksin
            ]);
        }
    }
}
