<?php

namespace App\Jobs;

use App\Mail\NewCompanyNotificationToAdmin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendNewCompanyNotificationToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $companyName;

    /**
     * Create a new job instance.
     */
    public function __construct($name)
    {
        $this->companyName = $name;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {  
        $admins = User::where('type','admin')->get();

        $admins->each(function($admin){
            Mail::to($admin->email)->send(new NewCompanyNotificationToAdmin([
                'companyName'=>$this->companyName
            ]));
        });       
    }
}
