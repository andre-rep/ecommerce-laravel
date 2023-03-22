<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$0yUwk8eYCAULj8mRSUu8G.GXFsRStdsoxFegZPDNFis40flE9oxie',
            'user_access_level' => 2,
            'user_status' => 0,
            'email_verified_at' => '2021-11-15 23:07:57',
            'created_at' => '2021-11-15 20:07:42'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => '$2y$10$wIDda3s3LjWuXYjmiPaLKOiqoc3OCucW9yEj/yKXUwT4FzEzj69oK',
            'user_access_level' => 1,
            'user_status' => 0,
            'email_verified_at' => '2021-11-15 23:08:56',
            'created_at' => '2021-11-15 20:08:45'
        ]);
    }
}
