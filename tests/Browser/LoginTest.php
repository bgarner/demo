<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:8000/login')
                    ->type('email', 'brent.garner@fglsports.com')
                    ->type('password', 'ketchup9')
                    ->press('Login')
                    ->assertPathIs('/admin');
        });
    }
}
