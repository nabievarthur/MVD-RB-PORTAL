<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\Subdivision;
use App\Models\User;
use Hash;
use Illuminate\Console\Command;

class AddUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавляет в БД 15 пользователей для теста';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        for ($i = 0; $i <= 15; $i++) {
            User::create([
                'login' => fake()->word() . $i,
                'password' => Hash::make('password' . $i),
                'last_name' => fake()->word(),
                'first_name' => fake()->word(),
                'surname' => fake()->word(),
                'subdivision_id' => fake()->randomElement(Subdivision::all()->pluck('id')->toArray()),
                'role_id' => fake()->randomElement(Role::all()->pluck('id')->toArray()),
            ]);
        }

        echo "Пользователи успешно добавлены";
    }
}
