<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Post1',
            'body' => 'Body of the post 1',
            'user_id' => 1,
        ]);

        Post::create([
            'title' => 'Post2',
            'body' => 'Body of the post 2',
            'user_id' => 1,
        ]);

        Post::create([
            'title' => 'Post3',
            'body' => 'Body of the post 3',
            'user_id' => 2,
        ]);

        Post::create([
            'title' => 'Post4',
            'body' => 'Body of the post 4',
            'user_id' => 2,
        ]);

        Post::create([
            'title' => 'Post5',
            'body' => 'Body of the post 5',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Post6',
            'body' => 'Body of the post 6',
            'user_id' => 3,
        ]);
    }
}
