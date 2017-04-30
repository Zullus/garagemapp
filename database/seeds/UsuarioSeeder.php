<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Edson Santos',
            'email' => 'edson.santos@gmail.com',
            'password' => 'debora'
        ]);

        DB::table('users')->insert([
            'name' => 'Evelin Santos',
            'email' => 'evelinsacandal@gmail.com',
            'password' => '123456'
        ]);
    }
}