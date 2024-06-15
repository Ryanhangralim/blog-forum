<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // \App\Models\User::factory()->create([
            //     'name' => 'Test User',
            //     'email' => 'test@example.com',
            // ]);
        User::create([
            'name' => "Ryan Hangralim",
            'username' => 'ryanhangralim',
            'email' => 'ryanhangralim@gmail.com',
            'password' => bcrypt('12345'),
        ]);
        User::factory(3)->create();

        // User::create([
        //     'name' => "Hangralim",
        //     'email' => 'hangralim@gmail.com',
        //     'password' => bcrypt('123'),
        // ]);

        Category::create([
            'name' => "Web Programming",
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => "Web Design",
            'slug' => 'web-design'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();

        // Post::create([
        //     "title" => "Judul Pertama",
        //     "slug" => "judul-pertama",
        //     "excerpt" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit incidunt quae vel magni sed recusandae cumque explicabo modi voluptate possimus. Velit illum libero fugit repudiandae eum numquam consequatur alias ipsam, magnam laboriosam aliquam perferendis amet suscipit sed voluptatem deserunt, nulla exercitationem tempora voluptatum.",
        //     "body" => "<p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit incidunt quae vel magni sed recusandae cumque explicabo modi voluptate possimus. Velit illum libero fugit repudiandae eum numquam consequatur alias ipsam, magnam laboriosam aliquam perferendis amet suscipit sed voluptatem deserunt, nulla exercitationem tempora voluptatum. </p> <p> Corporis sequi dolorem reiciendis pariatur dolor, porro doloribus illoharum.Excepturi pariatur recusandae natus quod autem, culpa similique laborum eum optio eligendi, eos tempore tempora quas dolore laboriosam officia. </p> <p> Commodi quos quidem quae repudiandae ut unde veniam, ipsum maiores ullam asperiores minima consectetur quaerat labore tenetur? Sit quidem reiciendis amet, ut architecto sint error, cupiditate voluptatum modi voluptates, ullam nemo fugit! Vitae deleniti magni rerum blanditiis id maiores, perspiciatis aperiam expedita consequuntur quia sequi, doloremque, soluta aliquam! </p>",
        //     "category_id" => 1,
        //     "user_id" => 1
        // ]);

        // Post::create([
        //     "title" => "Judul Kedua",
        //     "slug" => "judul-kedua",
        //     "excerpt" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit incidunt quae vel magni sed recusandae cumque explicabo modi voluptate possimus. Velit illum libero fugit repudiandae eum numquam consequatur alias ipsam, magnam laboriosam aliquam perferendis amet suscipit sed voluptatem deserunt, nulla exercitationem tempora voluptatum.",
        //     "body" => "<p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit incidunt quae vel magni sed recusandae cumque explicabo modi voluptate possimus. Velit illum libero fugit repudiandae eum numquam consequatur alias ipsam, magnam laboriosam aliquam perferendis amet suscipit sed voluptatem deserunt, nulla exercitationem tempora voluptatum. </p> <p> Corporis sequi dolorem reiciendis pariatur dolor, porro doloribus illoharum.Excepturi pariatur recusandae natus quod autem, culpa similique laborum eum optio eligendi, eos tempore tempora quas dolore laboriosam officia. </p> <p> Commodi quos quidem quae repudiandae ut unde veniam, ipsum maiores ullam asperiores minima consectetur quaerat labore tenetur? Sit quidem reiciendis amet, ut architecto sint error, cupiditate voluptatum modi voluptates, ullam nemo fugit! Vitae deleniti magni rerum blanditiis id maiores, perspiciatis aperiam expedita consequuntur quia sequi, doloremque, soluta aliquam! </p>",
        //     "category_id" => 1,
        //     "user_id" => 1
        // ]);

        // Post::create([
        //     "title" => "Judul Ketiga",
        //     "slug" => "judul-ketiga",
        //     "excerpt" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit incidunt quae vel magni sed recusandae cumque explicabo modi voluptate possimus. Velit illum libero fugit repudiandae eum numquam consequatur alias ipsam, magnam laboriosam aliquam perferendis amet suscipit sed voluptatem deserunt, nulla exercitationem tempora voluptatum.",
        //     "body" => "<p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit incidunt quae vel magni sed recusandae cumque explicabo modi voluptate possimus. Velit illum libero fugit repudiandae eum numquam consequatur alias ipsam, magnam laboriosam aliquam perferendis amet suscipit sed voluptatem deserunt, nulla exercitationem tempora voluptatum. </p> <p> Corporis sequi dolorem reiciendis pariatur dolor, porro doloribus illoharum.Excepturi pariatur recusandae natus quod autem, culpa similique laborum eum optio eligendi, eos tempore tempora quas dolore laboriosam officia. </p> <p> Commodi quos quidem quae repudiandae ut unde veniam, ipsum maiores ullam asperiores minima consectetur quaerat labore tenetur? Sit quidem reiciendis amet, ut architecto sint error, cupiditate voluptatum modi voluptates, ullam nemo fugit! Vitae deleniti magni rerum blanditiis id maiores, perspiciatis aperiam expedita consequuntur quia sequi, doloremque, soluta aliquam! </p>",
        //     "category_id" => 2,
        //     "user_id" => 1
        // ]);

        // Post::create([
        //     "title" => "Judul Keempat",
        //     "slug" => "judul-keempat",
        //     "excerpt" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit incidunt quae vel magni sed recusandae cumque explicabo modi voluptate possimus. Velit illum libero fugit repudiandae eum numquam consequatur alias ipsam, magnam laboriosam aliquam perferendis amet suscipit sed voluptatem deserunt, nulla exercitationem tempora voluptatum.",
        //     "body" => "<p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit incidunt quae vel magni sed recusandae cumque explicabo modi voluptate possimus. Velit illum libero fugit repudiandae eum numquam consequatur alias ipsam, magnam laboriosam aliquam perferendis amet suscipit sed voluptatem deserunt, nulla exercitationem tempora voluptatum. </p> <p> Corporis sequi dolorem reiciendis pariatur dolor, porro doloribus illoharum.Excepturi pariatur recusandae natus quod autem, culpa similique laborum eum optio eligendi, eos tempore tempora quas dolore laboriosam officia. </p> <p> Commodi quos quidem quae repudiandae ut unde veniam, ipsum maiores ullam asperiores minima consectetur quaerat labore tenetur? Sit quidem reiciendis amet, ut architecto sint error, cupiditate voluptatum modi voluptates, ullam nemo fugit! Vitae deleniti magni rerum blanditiis id maiores, perspiciatis aperiam expedita consequuntur quia sequi, doloremque, soluta aliquam! </p>",
        //     "category_id" => 2,
        //     "user_id" => 2
        // ]);
    }
}
