<?php

namespace Tests\Feature\Dasbor;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DosenTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDosenGetAll()
    {
        $this->json('get', '/dasbor/dosen')
            ->assertStatus(300);
    }    
}
