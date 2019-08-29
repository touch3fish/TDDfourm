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
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('threads/1/replies',[]);
//        $thread = factory('App\Thread')->create();
//
//        $reply = factory('App\Reply')->create();
//        $this->post($thread->path().'/replies',$reply->toArray());
    }

    public function test_an_authenticated_user_may_participate_in_forum_threads()
    {
        //给我们一个有权限的用户
        $this->be($user = factory('App\User')->create());//已登录用户
//        $user = factory('App\User')->create();//为登录用户
        //并且有一个存在的话题
        $thread = factory('App\Thread')->create();
        //当有用户在这个话题回复时
        $reply = factory('App\Reply')->make();
        $this->post($thread->path().'/replies',$reply->toArray());
        //他们可以查看页面
        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
