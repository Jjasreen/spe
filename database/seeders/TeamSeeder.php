<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $teams =
            [
                [
                    "unit_code" => 14,
                    "teaching_period" => "TJA2020",
                    "module_id" => 1
                ],
                [

                    "unit_code" => 15,
                    "teaching_period" => "TJA2020",
                    "module_id" => 2

                ]



            ];

            foreach($teams as $t)
            {
                $team = new Team();
                $team->unit_code = $t['unit_code'];
                $team->teaching_period = $t['teaching_period'];
                $team->module_id=$t['module_id'];
                $team->save();


            }
    }
}
