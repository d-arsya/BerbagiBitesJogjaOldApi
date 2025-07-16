<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        User::create([
            "name"=>"Kamaluddin Arsyad",
            "role"=>"Admin",
            "email"=>"kamaluddin.arsyad17@gmail.com",
            "avatar"=>"https://lh3.googleusercontent.com/a/ACg8ocJ2ZjlmWDJXL308Sj8IKVjvmEGW2IijW3YHV31tHlQYEkOW3yVa=s96-c",
            "phone"=>"6289636055420"
        ]);
    }
}
