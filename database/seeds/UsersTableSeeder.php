<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([

            'name'=>'med',
            'email'=>'med@med.med',
            'password'=>bcrypt('medmed')

        ]);
    }
}
