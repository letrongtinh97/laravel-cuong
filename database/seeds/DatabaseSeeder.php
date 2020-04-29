<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(AdminTableSeeder::class);
    }
}

class AdminTableSeeder extends Seeder
{
     public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name'     => 'Quách Việt Cường' ,
                    'email'    => 'cuong@gmail.com' , 
                    'password' => bcrypt('123456') ,
                    'level'    => 3,
                ],
                [
                    'name'     => 'Clone 1' ,
                    'email'    => 'clone1@gmail.com' , 
                    'password' => bcrypt('123456') ,
                    'level'    => 2,
                ],
                [
                    'name'     => 'Clone 2' ,
                    'email'    => 'clone2@gmail.com' , 
                    'password' => bcrypt('123456') ,
                    'level'    => 1,
                ],
            ]
        );
    }
}
