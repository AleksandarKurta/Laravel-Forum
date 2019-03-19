<?php

use App\Reply;
use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reply::create([
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis lorem eu nibh rhoncus hendrerit. Nunc mattis justo quam, ac congue eros suscipit at. Donec arcu tortor, tempor at fermentum a, fringilla sit amet ligula. Vivamus consectetur tortor tortor, ac auctor mauris consequat non. Nullam quis blandit neque, eu pulvinar leo. Etiam vehicula nulla eu mattis interdum. Quisque sodales vulputate arcu, efficitur tincidunt ipsum. In odio magna, eleifend nec sapien at, placerat sollicitudin metus.',
            'user_id' => 1,
            'discussion_id' => 1
        ]);

        Reply::create([
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis lorem eu nibh rhoncus hendrerit. Nunc mattis justo quam, ac congue eros suscipit at.',
            'user_id' => 2,
            'discussion_id' => 1
        ]);

        Reply::create([
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis lorem eu nibh rhoncus hendrerit. Nunc mattis justo quam, ac congue eros suscipit at. Donec arcu tortor, tempor at fermentum a, fringilla sit amet ligula.',
            'user_id' => 2,
            'discussion_id' => 4
        ]);

        Reply::create([
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis lorem eu nibh rhoncus hendrerit. Nunc mattis justo quam, ac congue eros suscipit at. Donec arcu tortor, tempor at fermentum a, fringilla sit amet ligula. Vivamus consectetur tortor tortor, ac auctor mauris consequat non. Nullam quis blandit neque, eu pulvinar leo. Etiam vehicula nulla eu mattis interdum. Quisque sodales vulputate arcu, efficitur tincidunt ipsum. In odio magna, eleifend nec sapien at, placerat sollicitudin metus. Aenean lacinia viverra enim, id dignissim mauris volutpat et. Pellentesque molestie lectus sem, in facilisis augue scelerisque eu. Etiam tincidunt risus et velit ullamcorper, et elementum enim pretium. Nunc sed erat ac augue semper varius sed in elit. Nulla vel tempor felis, sed elementum massa. Aliquam egestas urna sit amet enim dictum consequat.',
            'user_id' => 1,
            'discussion_id' => 3
        ]);
    }
}
