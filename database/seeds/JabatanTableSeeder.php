<?php

use Illuminate\Database\Seeder;

class JabatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	\App\Jabatan::create([
        'nama_jabatan'	=> 'Admin',
		]);
            // 1

    	\App\Jabatan::create([
        'nama_jabatan'	=> 'Petugas Loket',
		]);
            // 2

    }
}
