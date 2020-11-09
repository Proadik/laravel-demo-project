<?php

use App\Models\Post;
use App\User;
use Faker\Provider\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSeeder extends Seeder
{

    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('comments')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user = User::create([
            'name' => 'Администратор',
            'email' => 'admin@admin.ru',
            'type' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('somePasswordGoesHere12321')
        ]);

        $users = factory(User::class, 5)->create()->each(function($user) {
            for($i = 0; $i < 3; $i++) {
                $user->posts()->save(factory(Post::class)->make());
            }
        });

    }

}
