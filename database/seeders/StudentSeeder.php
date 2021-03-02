<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $students = [
            [

                "s_title" => "mr",
                "s_givenname" => "hum",
                "teaching_period" => "TMA2020",
                "s_email" => "dcg@gmail.com"


            ],
            [
                "s_title" => "mrs",
                "s_givenname" => "tina",
                "teaching_period" => "TMA2020",
                "s_email" => "fgh@gmail.com"

            ],
            [
                "s_title" => "mr",
                "s_givenname" => "lincoln",
                "teaching_period" => "TMA2020",
                "s_email" => "kpo@gmail.com"

            ],
            [
                "s_title" => "mr",
                "s_givenname" => "jasper",
                "teaching_period" => "TMA2020",
                "s_email" => "rty@gmail.com"

            ]


        ];

        foreach ($students as $s) {
            $student = new Student();
            $student->s_title = $s["s_title"];
            $student->s_givenname = $s['s_givenname'];
            $student->teaching_period = $s['teaching_period'];
            $student->s_email = $s['s_email'];
            $student->save();
        }
    }
}
