<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DeleteBackgroundImage implements ShouldQueue
{
    use Queueable;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;
    
    /**
     * Create a new job instance.
     */
    public function __construct(public string $filePath){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->filePath && file_exists(public_path($this->filePath))) {
            unlink(public_path($this->filePath));
        }
    }

    public function retryUntil()
    {
        return null;
    }
}
