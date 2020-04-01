<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = User::create([
            'name' => 'تست تستیانفر',
            'email' => 'test@test.com',
            'password' => Hash::make('testtest'),
        ]);
        $admin = User::create([
            'name' => 'ادمین ادمینیانفر',
            'email' => 'admin@admin.com',
            'password' => Hash::make('adminadmin'),
            'role' => 'ADMIN',
        ]);

        // factory(User::class, 100)->create();

    }
}
