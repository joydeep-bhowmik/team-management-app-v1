<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class DeleteOldTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete tasks older than 2 months';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Define the deletion logic
        $deletedCount = Task::where('created_at', '<', Carbon::now()->subMonths(2))->delete();

        // Output the result
        $this->info("Deleted {$deletedCount} tasks older than 2 months.");
    }
}
