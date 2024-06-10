<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Paket as ModelPaket;

class Paket extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ModelPaket::create([
            'nama' => 'Paket A',
            'deskripsi' => 'Deskripsi Paket A',
            'harga' => '100000',
        ]);

        ModelPaket::create([
            'nama' => 'Paket B',
            'deskripsi' => 'Deskripsi Paket B',
            'harga' => '200000',
        ]);

        ModelPaket::create([
            'nama' => 'Paket C',
            'deskripsi' => 'Deskripsi Paket C',
            'harga' => '150000',
        ]);

        ModelPaket::create([
            'nama' => 'Paket D',
            'deskripsi' => 'Deskripsi Paket D',
            'harga' => '300000',
        ]);
    }
}
