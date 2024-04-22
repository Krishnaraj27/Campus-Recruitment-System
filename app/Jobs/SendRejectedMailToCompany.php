<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyRejectedMail;

class SendRejectedMailToCompany implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $companyName,$companyEmail;
    /**
     * Create a new job instance.
     */
    public function __construct($name,$email)
    {
        $this->companyName = $name;
        $this->companyEmail = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       Mail::to($this->companyEmail)->send(new CompanyRejectedMail($this->companyName));
        
    }
}
