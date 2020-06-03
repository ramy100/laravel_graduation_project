<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(App\User::class, 10)->create();
        factory(App\Profile::class, 10)->create();
        factory(App\DesignerRate::class, 10)->create();
        factory(App\Tag::class, 10)->create();
        factory(App\Design::class, 10)->create();
        factory(App\DesignVote::class, 10)->create();
        factory(App\DesignComment::class, 10)->create();
        factory(App\CommentReply::class, 10)->create();
        factory(App\Material::class, 10)->create();
        factory(App\DesignMaterial::class, 10)->create();
        factory(App\DesignImage::class, 10)->create();
        factory(App\CompanyDesign::class, 10)->create();
    }
}
