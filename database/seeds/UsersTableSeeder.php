<?php

use App\User;
use App\Profile;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Aleksandar',
            'password' => bcrypt('12345678'),
            'email' => 'admin@me.com',
            'admin' => 1
        ]);

        Profile::create([
            'avatar' => 'uploads/avatars/avatar.png',
            'user_id' => $user->id,
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam maximus dui at augue sagittis scelerisque. Proin finibus est et diam vehicula, id pulvinar dui euismod. Vestibulum vitae orci id ante viverra auctor at at odio. Nullam purus lacus, posuere quis pharetra ut, lobortis vel neque. Duis dui diam, vestibulum sit amet ornare sit amet, elementum sed neque. Nam et gravida diam, faucibus malesuada ex. Morbi eu lobortis tellus.',
            'website' => 'http://www.aleksandarkurta.info/'
        ]);
    }
}
