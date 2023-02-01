<?php

use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->delete();

        DB::table('options')->insert(
            array(
                array(
                    'name' => 'default_image_ratio',
                    'value' => '16/9'
                ),
                array(
                    'name' => 'category_image_ratio',
                    'value' => '16/9'
                ),
                array(
                    'name' => 'sub_category_image_ratio',
                    'value' => '16/9'
                ),
                array(
                    'name' => 'user_image_ratio',
                    'value' => '1/1'
                )
            ));
    }
}
