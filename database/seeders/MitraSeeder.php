<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        $mitras = [
            [
                'company_name' => 'GATSU',
                'contact_person' => null,
                'email' => null,
                'phone' => null,
                'address' => null,
            ],
            [
                'company_name' => 'SLIPI',
                'contact_person' => null,
                'email' => null,
                'phone' => null,
                'address' => null,
            ],
            [
                'company_name' => 'PN',
                'contact_person' => null,
                'email' => null,
                'phone' => null,
                'address' => null,
            ],
            [
                'company_name' => 'Dalmed',
                'contact_person' => null,
                'email' => null,
                'phone' => null,
                'address' => null,
            ],
            [
                'company_name' => 'Telkomedika',
                'contact_person' => null,
                'email' => null,
                'phone' => null,
                'address' => null,
            ],
            [
                'company_name' => 'KTR AREA',
                'contact_person' => null,
                'email' => null,
                'phone' => null,
                'address' => null,
            ],
            [
                'company_name' => 'KLINIK MEDIKA MULIA',
                'contact_person' => null,
                'email' => null,
                'phone' => null,
                'address' => null,
            ],
        ];

        foreach ($mitras as $mitra) {
            Mitra::create($mitra);
        }

        $this->command->info('Mitra seeder completed successfully.');
    }
}
