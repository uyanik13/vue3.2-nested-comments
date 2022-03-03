<?php

namespace Tests\Unit;

use App\Comment;
use Tests\TestCase;

class CommentTest extends TestCase
{


    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_can_create_a_comment()
    {
        $data = [
            'name' => 'Ogur Uyanik',
            'comment' => 'First Comment on here'
        ];
        $this->post('api/comment', $data)
            ->assertStatus(201);
    }


    public function test_is_null_data_check()
    {
        $data = [
            'name' => null,
            'comment' => null
        ];
        $response = $this->post('api/comment', $data);
        $response->assertUnprocessable();
    }


    public function test_can_fetch_all_comments()
    {

        $response = $this->get('api/comment');

        $response->assertSuccessful();
    }
}
