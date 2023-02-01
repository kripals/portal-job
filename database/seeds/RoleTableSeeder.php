<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        DB::table('roles')->insert(
            array(
                array(
                    'name' => 'ROLE_SUPERADMIN',
                    'display_name' => 'SuperAdmin',
                    'description' => 'One Role To Rule Them All',
                    'status' => 'active'
                ),
                array(
                    'name' => 'ROLE_COMPANY',
                    'display_name' => 'Company',
                    'description' => 'Company/Employer Level Access Control',
                    'status' => 'active'
                ),
                array(
                    'name' => 'ROLE_CANDIDATE',
                    'display_name' => 'Candidate',
                    'description' => 'Candidate/Jobseeker Level Access Control',
                    'status' => 'active'
                )
            ));
    }
}
