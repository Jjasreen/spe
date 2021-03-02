<?php

namespace Tests\Unit;

use App\Models\UnitCoordinator;
use App\Models\User;
use PHPUnit\Framework\TestCase;


class UnitCoordinatorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = new User();
        $user->name = "Tan Ah Kow";
        $user->email = "ahkow@gmail.com";
        $user->password = "ASD1234";
        $user->save();

        // $uc = new UnitCoordinator();
        // $uc->first_name = "Ah Kow";
        // $uc->last_name = "Tan";
        // $uc->unit_code = "ABC";
        // $uc->teach_period = "1234";
        // // set the foregin key
        // $uc->user_id = $user->id;
        // $uc->save();

        // if the uc is saved correctly, should have id
        // $this->assertNotNull($uc->id);
        // $this->assertEquals("Ah Kow", $uc->first_name);
        // $this->assertEquals("Tan", $uc->last_name);
        // $this->assertNotNull($uc->user);
        // $this->assertEquals($uc->user->id, $user->id);   
        
        
    }
}
