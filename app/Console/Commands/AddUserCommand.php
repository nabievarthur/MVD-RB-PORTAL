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
        $subdivisionIds = Subdivision::pluck('id')->toArray();
        $roleIds = Role::pluck('id')->toArray();

        if (empty($subdivisionIds) || empty($roleIds)) {
            echo 'Нет данных в таблицах subdivisions или roles';

            return;
        }

        for ($i = 0; $i <= 15; $i++) {
            User::create([
                'login' => fake()->word().$i,
                'password' => Hash::make('password'.$i),
                'last_name' => fake()->word(),
                'first_name' => fake()->word(),
                'surname' => fake()->word(),
                'subdivision_id' => fake()->randomElement($subdivisionIds),
                'role_id' => fake()->randomElement($roleIds),
            ]);
        }

        echo 'Пользователи успешно добавлены';
    }
}
