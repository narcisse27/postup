<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $forgetPassLink = "Mot de passe oublié ?";

        $user = factory(User::class)->create([
                'email' => 'test@postup.ch',
                'password' =>  bcrypt('asdfasdf'),
         ]);

        $this->browse(function ($browser) use ($user, $forgetPassLink){
            $browser->visit('/login')
                    ->assertSee($forgetPassLink)
                    ->type('email', $user->email)
                    ->type('password', 'asdfasdf')
                    ->press('Login')
                    ->assertPathIs('/desk');
        });

        User::where('email', 'test@postup.ch')->delete();

        $this->browse(function(Browser $browser) use ($forgetPassLink){

            $browser->visit('/login')
                ->assertSee($forgetPassLink)
                ->clickLink($forgetPassLink)
                ->assertPathIs('/password/reset');
        });
    }
}
