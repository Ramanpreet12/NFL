<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionExpire extends Mailable
{
    use Queueable, SerializesModels;
protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('demo@gmail.com')->view('mail.subscription-expired')->with([
            'name'=>$this->user->name,
            'expire_on'=>$this->user->expire_on
        ]);

    }
}
