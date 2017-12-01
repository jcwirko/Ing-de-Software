<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class AdminPanelTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_admin_puede_acceder_panel_administracion()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'juanblariza@gmail.com')
                ->type('password', 'asdasd')
                ->press('Login')
                ->assertPathIs('/smn/dashboard');
        });
    }

    public function test_admin_puede_encender_todos_los_instrumentos()
    {
        $user = User::first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user->id)
                ->visit('/smn/dashboard')
                ->assertSee('SMN')
                ->click('#encenderTodo')
                ->whenAvailable('.swal2-modal', function ($modal) {
                    $modal->assertSee('Sensores encendidos correctamente');
                });
        });
    }

    public function test_admin_puede_apagar_todos_los_instrumentos()
    {
        $user = User::first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user->id)
                ->visit('/smn/dashboard')
                ->assertSee('SMN')
                ->click('#apagarTodo')
                ->whenAvailable('.swal2-modal', function ($modal) {
                    $modal->assertSee('Sensores apagados correctamente');
                });
        });
    }
}
