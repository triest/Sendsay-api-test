<?php

namespace App\Jobs;

use App\Services\SandayService\SendsayService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendDataToSandSayJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string|null $email = null;

    private int|null $id = null;

    private string|null $ip = null;

    public $tries = 3;

    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $id, $ip)
    {
        $this->email = $email;

        $this->ip = $ip;

        $this->id = $id;
    }

    /**
     * Execute the job.
     * @throws \Exception
     */
    public function handle(SendsayService $service): void
    {
        $service->setMember($this->email, $this->id, $this->ip);
    }
}
