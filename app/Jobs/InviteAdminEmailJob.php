<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class InviteAdminEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Globle variable
     * **/
    protected $email = null;
    protected $url = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $url)
    {
        $this->email = $email;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email;
        $url = $this->url;
        Mail::send('emails/invite_admin', ['url' => $url], function ($message) use($email) {
            $message->to($email);
            $message->subject('Subject');
        });
    }
}
