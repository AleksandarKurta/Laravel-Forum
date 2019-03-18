<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'title' => 'Laravel 5.8',
            'slug' => str_slug('Laravel 5.8')
        ]);

        Channel::create([
            'title' => 'Vue JS',
            'slug' => str_slug('Vue JS')
        ]);

        Channel::create([
            'title' => 'Wordpress',
            'slug' => str_slug('Wordpress')
        ]);

        Channel::create([
            'title' => 'Symfony',
            'slug' => str_slug('Symfony')
        ]);

        Channel::create([
            'title' => 'React',
            'slug' => str_slug('React')
        ]);
    }
}
