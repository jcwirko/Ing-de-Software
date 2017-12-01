<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MostrarDatosTest extends DuskTestCase
{

    public function test_guest_puede_ver_informacion_temperatura()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('#temperatura')
                ->whenAvailable('#mdlTemperatura', function ($modal) {
                    $modal->assertSee('Temperatura');
                });
        });
    }

    public function test_guest_puede_ver_informacion_humedad()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('#humedad')
                ->whenAvailable('#mdlHumedad', function ($modal) {
                    $modal->assertSee('Humedad');
                });
        });
    }

    public function test_guest_puede_ver_informacion_presion()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('#presion')
                ->whenAvailable('#mdlPresion', function ($modal) {
                    $modal->assertSee('Presión Barométrica');
                });
        });
    }
}
