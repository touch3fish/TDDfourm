<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FavoritiesTest extends TestCase
{

    use DatabaseMigrations;
    public function test_an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        $reply = create('App\Reply');

        $this->post('replies/' . $reply->id . '/favorites');

        $this->assertCount(1,$reply->favorites);
    }

    public function test_guests_can_not_favorite_anything()
    {
        $this->withExceptionHandling()
            ->post('/replies/2/favorites')
            ->assertRedirect('/login');
    }

    public function test_an_authenticated_user_may_only_favorite_a_reply_once()
    {
        $this->signIn();

        $reply = create('App\Reply');

        try{
            $this->post('replies/' . $reply->id . '/favorites');
            $this->post('replies/' . $reply->id . '/favorites');
        }catch(\Exception $e){
            $this->fail('只能点赞一次');
        }
        $this->assertCount(1,$reply->favorites);
    }
}
