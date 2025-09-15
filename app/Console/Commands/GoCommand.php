<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Выполняет всякое';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::query()->create([
            'login' => 'test',
            'password' => Hash::make('test'),
        ]);

        return 200 .'OK';
    }
}
