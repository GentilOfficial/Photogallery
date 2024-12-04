<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use DB, Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for ($i = 0; $i < 30; $i++) {
        //     // $name = Str::random(10);

        //     // $sql = 'insert into users (name, email, password, created_at, email_verified_at) values (?, ?, ?, ?, ?)';
        //     // DB::insert($sql, [
        //     //     $name,
        //     //     $name . '@gmail.com',
        //     //     Hash::make('password'),
        //     //     \Carbon\Carbon::now(),
        //     //     \Carbon\Carbon::now()
        //     // ]);

        //     // DB::table('users')->insert([
        //     //     'name' => $name,
        //     //     'email' => $name . '@gmail.com',
        //     //     'password' => Hash::make('password'),
        //     //     'created_at' => \Carbon\Carbon::now(),
        //     //     'email_verified_at' => \Carbon\Carbon::now()
        //     // ]);

        // }

        User::factory(30)->create();
    }
}
