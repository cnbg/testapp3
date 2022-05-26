<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * Test home url
     *
     * @return void
     */
    public function test_home_is_reachable(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test whether view works correctly
     *
     * @return void
     */
    public function test_home_view_can_be_rendered(): void
    {
        $view = $this->view('home');

        $view->assertSee(__('Upload page'));
    }
}
