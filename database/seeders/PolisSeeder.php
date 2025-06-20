<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Seeder;

class PolisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            [
                'nama' =>'Pasien',
                'deskripsi'=>'-',
            ],
            [
                'nama' => 'Gigi',
                'deskripsi' => 'Poliklinik untuk Gigi'
            ],
            [
                'nama' => 'Anak',
                'deskripsi' => 'Poliklinik untuk Anak'
            ],
            [
                'nama' => 'Penyakit Dalam',
                'deskripsi' => 'Poliklinik untuk Penyakit Dalam'
            ],


        ];
        foreach($polis as $poli){
            Poli::create($poli);
        }
    }
}
