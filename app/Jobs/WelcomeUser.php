<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Jobs\Job;

class WelcomeUser implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Job $joblisting)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //

        logger('Processing');
    }
}
