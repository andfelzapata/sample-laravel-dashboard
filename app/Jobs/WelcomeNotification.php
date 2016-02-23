<?php

namespace App\Jobs;

use Mail;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeNotification extends Job implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create a new job instance.
     * @param array $data Data to use for notification
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        $data = $this->data;

        Mail::send('emails.welcome.user',$data, function($message) use ($data){

            $fromEmail = env('MAIL_USERNAME');
            $fromName = config('mail.from')['name'];

            $toEmail = env('MAIL_USERNAME');
            $subject = sprintf('Welcome to Garden Revolution!');

            $message->from($fromEmail,$fromName);

            $message->to($toEmail)->subject($subject);
        });
    }
}
