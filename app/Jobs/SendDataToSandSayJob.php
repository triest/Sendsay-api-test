<?php

namespace App\Jobs;

use App\Services\SandayService\SandsayService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendDataToSandSayJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $email = null;

    private $id = null;

    /**
     * Create a new job instance.
     */
    public function __construct($email,$id)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(SandsayService $service): void
    {
        $service->setMember($this->email,$this->id);
    }
}
