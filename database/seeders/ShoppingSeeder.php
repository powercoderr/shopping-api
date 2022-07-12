<?php

namespace Database\Seeders;

use App\Models\Shopping;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShoppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Foreach user create two shopping
        foreach(User::all() as $user) {
            //Create two shopping for each user
            Shopping::factory(2)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
