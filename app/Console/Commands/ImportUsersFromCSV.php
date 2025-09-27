<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ImportUsersFromCSV extends Command
{
    protected $signature = 'import:users {file}';

    protected $description = 'Import users from CSV file';

    public function handle()
    {
        $filePath = $this->argument('file');

        if (! file_exists($filePath)) {
            $this->error("Файл {$filePath} не найден!");

            return 1;
        }

        $handle = fopen($filePath, 'r');
        $header = fgetcsv($handle); // пропускаем заголовок

        $count = 0;

        while (($data = fgetcsv($handle)) !== false) {
            [$login, $password] = $data;

            User::updateOrCreate(
                ['login' => $login],
                [
                    'password' => Hash::make($password),
                ]
            );

            $count++;
        }

        fclose($handle);

        $this->info("Импортировано {$count} пользователей.");

        return 0;
    }
}
