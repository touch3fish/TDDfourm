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

    public function test_guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');
    }

    public function test_an_authenticated_user_can_create_new_forum_threads()
    {
        //已登录的用户
        $this->actingAs(factory('App\User')->create());//已登录的用户
        //点击并且创建话题
        $thread = create('App\Thread');
        $this->post('/threads',$thread->toArray());

//        dd($thread->path());//打印路径测试
        //我们可以看到创建的话题
        $this->get($thread->path())
            ->assertSee($thread->title) //标题
            ->assertSee($thread->body); //内容
    }

//    public function test_guests_may_not_create_threads() //不能创建用户
//    {
//        $this->expectException('Illuminate\Auth\AuthenticationException');
//        $thread = factory('App\Thread')->make();
//        $this->post('/threads',$thread->toArray());
//    }
//
//    public function test_guests_may_not_see_the_create_thread_page() //不能看
//    {
//        $this->withExceptionHandling()
//            ->get('/threads/create')
//            ->assertRedirect('/login');
//    }
}
