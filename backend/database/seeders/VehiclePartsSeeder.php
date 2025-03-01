<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class VehiclePartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(storage_path('KobeTestData.csv'), 'r');
        $csv->setHeaderOffset(0); // Use first row as column names

        foreach ($csv as $row) {
            DB::table('vehicle_parts')->insert([
                'make' => $row['Make'],
                'model' => $row['Model'],
                'type' => $row['Type'],
                'part_number' => $row['PartNo'],
            ]);
        }
    }
}
