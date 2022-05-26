<?php

namespace Tests\Feature;

use App\Models\Row;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UploadControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test upload show url
     *
     * @return void
     */
    public function test_uplod_list_page_is_reachable(): void
    {
        $response = $this->get(route('upload.list'));

        $response->assertStatus(200);
    }

    /**
     * Test whether view works correctly
     *
     * @return void
     */
    public function test_upload_list_view_can_be_rendered(): void
    {
        $rows = Row::factory(5)->make();

        $this->assertCount(5, $rows);

        $row = $rows[0];

        $this->assertNotEmpty($row->id);
        $this->assertNotEmpty($row->name);
        $this->assertNotEmpty($row->date);

        $view = $this->view('upload.list', ['rows' => Row::paginate()]);

        $view->assertSee(__('Rows'));
    }

    /**
     * Test upload show url
     *
     * @return void
     */
    public function test_uplod_show_page_is_reachable(): void
    {
        $response = $this->get(route('upload.show'));

        $response->assertStatus(200);
    }

    /**
     * Test whether view works correctly
     *
     * @return void
     */
    public function test_upload_show_view_can_be_rendered(): void
    {
        $this->withViewErrors([]);
        $view = $this->view('upload.show');

        $view->assertSee(__('Upload file'));
    }
}
