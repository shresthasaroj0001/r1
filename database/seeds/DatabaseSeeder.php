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
        DB::table('fee_names')->insert(array(
            array( 'descriptions' => 'Group 1 - 4', 'grpLow' => 1, 'grpHigh' => 4),
            array( 'descriptions' => 'Group 5 - 7', 'grpLow' => 5, 'grpHigh' => 7),
            array( 'descriptions' => 'Group 9 - 11', 'grpLow' => 9, 'grpHigh' => 11),
            array( 'descriptions' => 'Group 12 - 23', 'grpLow' => 12, 'grpHigh' => 23),
        ));
      
        // $this->call(UsersTableSeeder::class);
    }
}
