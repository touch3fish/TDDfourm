<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    public function test_a_user_can_browse_threads()
    {
        //调用工厂创建Thread模型数据
        $thread = factory('App\Thread')->create();

        //测试标题数据
        $response = $this->get('/threads');
        $response->assertSee($thread->title);


    }

    public function test_a_user_can_read_a_single_thread()
    {
        $thread = factory('App\Thread')->create();
        //测试单个话题
        $response = $this->get('/threads/'.$thread->id);
        $response->assertSee($thread->title);
    }
}
