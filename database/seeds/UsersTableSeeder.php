<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert(
            array(
                array(
                    'first_name' => 'Super',
                    'last_name' => 'Admin',
                    'slug' => 'super-admin',
                    'username' => 'superadmin',
                    'password' => bcrypt('password'),
                    'email' => 'superadmin@gmail.com',
                    'email_verified_at' => now(),
                    'status' => 'active'
                ),
                array(
                    'first_name' => 'Company',
                    'last_name' => 'Admin',
                    'slug' => 'company-admin',
                    'username' => 'companyadmin',
                    'password' => bcrypt('password'),
                    'email' => 'company@gmail.com',
                    'email_verified_at' => now(),
                    'status' => 'active'
                ),
                array(
                    'first_name' => 'Candidate',
                    'last_name' => 'Admin',
                    'slug' => 'candidate-admin',
                    'username' => 'candidateadmin',
                    'password' => bcrypt('password'),
                    'email' => 'candidate@gmail.com',
                    'email_verified_at' => now(),
                    'status' => 'active'
                )
            ));
    }
}
