<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Post;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(PostTableSeeder::class);
      factory(Tag::class, 30) -> create() -> each(function($tag){
        $post = Post::inRandomOrder() -> take(rand(0,5)) -> get();
        $tag -> posts() -> attach($post);
      });
    }
}
