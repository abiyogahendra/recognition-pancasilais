<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $update = DB::table('admin')
            ->insert([
                'name'          => 'Abiyoga',
                'unix_code'     => '082154926473',
                'password'      => bcrypt('123456789')
            ]);


    }
}
