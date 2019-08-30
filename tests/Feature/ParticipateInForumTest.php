<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipateInForumTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function test_unauthenticated_user_may_no_add_replies()
    {
        $this->withExceptionHandling()
            ->post('threads/some-channel/1/replies',[])
            ->assertRedirect('/login');
//        $thread = factory('App\Thread')->create();
//
//        $reply = factory('App\Reply')->create();
//        $this->post($thread->path().'/replies',$reply->toArray());
    }

    public function test_an_authenticated_user_may_participate_in_forum_threads()
    {
        //给我们一个有权限的用户
        $this->signIn();
        //并且有一个存在的话题
        $thread = create('App\Thread');
        //当有用户在这个话题回复时
        $reply = make('App\Reply');
//        dd($thread->path().'/replies');
        $this->post($thread->path().'/replies',$reply->toArray());
        //他们可以查看页面
        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
