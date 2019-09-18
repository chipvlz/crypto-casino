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
//        $this->call(CurrencySeeder::class);

        // run extra packages seeders if there are any
        foreach (glob(__DIR__ . '/../../packages/**/database/seeds/*.php') as $seederFile) {
            $seederClass = str_replace('.php', '', basename($seederFile));
            $this->call($seederClass);
        }
    }
}