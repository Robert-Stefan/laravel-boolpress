<?php

use Illuminate\Database\Seeder;
use App\Post;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i =0; $i < 5; $i++) {
            $new_post = new Post();

            $new_post->title = 'Post title ' . ($i + 1);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->content = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor, quia adipisci recusandae, ab et illo quod consequuntur ipsam enim eaque dignissimos doloremque ratione sunt aliquam perspiciatis voluptas officia necessitatibus quam.';

            $new_post->save();
            
        }
    }
}
