<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    public function test_an_authenticated_user_can_create_new_forum_threads()
    {
        //已登录的用户
        $this->actingAs(factory('App\User')->create());//已登录的用户
        //点击并且创建话题
        $thread = factory('App\Thread')->make();
        $this->post('/threads',$thread->toArray());
        //我们可以看到创建的话题
        $this->get($thread->path())
            ->assertSee($thread->title) //标题
            ->assertSee($thread->body); //内容
    }

    public function test_guests_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = factory('App\Thread')->make();
        $this->post('/threads',$thread->toArray());
    }
}
