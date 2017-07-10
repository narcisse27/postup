<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TemplateTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        /*
        $this->browse(function ($browser){
            $browser->visit('/register')
                ->assertSee('Inscription')
                ->type('firstname', 'Antony')
                ->type('lastname', 'Canta')
                ->select('area_id')->selectOptionByValue("1")
                ->type('email', 'test@postup.ch')
                ->type('password', 'asdfasdf')
                ->type('password-confirm', 'asdfasdf')
                ->clickLink('Register')
                ->assertPathIs('/desk');
        });
        */
    }
}
