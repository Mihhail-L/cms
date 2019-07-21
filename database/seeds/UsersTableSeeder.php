<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 3)->create();

        $user = User::where('email', 'levin.mihhail@gmail.com')->first();

        if(!$user) {
            User::create([
                'role' => 'admin',
                'name' => 'Mihhail Levin',
                'email' => 'levin.mihhail@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
