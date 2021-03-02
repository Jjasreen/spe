<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $modules = [
            [
                "unit_code" => 12,
                "module_name" => "ABCs",
                "unit_coordinator_id" => 1
            ],
            [
                "unit_code" => 13,
                "module_name" => "Cooking 101",
                "unit_coordinator_id" => 1
            ]
        ];

        foreach ($modules as $m) {
            $module = new Module();
            $module->unit_code = $m['unit_code'];
            $module->module_name = $m['module_name'];
            $module->unit_coordinator_id = $m['unit_coordinator_id'];
            $module->save();
        }
    }
}
