<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RestoreCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:restore {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('filename');
        $filePath = storage_path('backup/' . $filename);
        if (!file_exists($filePath)) {
            Log::error("No such file or directory " . $filePath);
            return;
        }

        $command = "mysql -h " . env('DB_HOST') . " -u " . env('DB_USERNAME') . " -p" . env('DB_PASSWORD') . " " . env('DB_DATABASE') . " < " . $filePath;
        exec($command);

        Log::info("DB restored successfully from" . $filePath);
        //
    }
}
