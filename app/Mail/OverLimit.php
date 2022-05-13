<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Senior;
use App\Models\User;

class OverLimit extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * 
     *
     * @return void
     */
    private $name;
    public function __construct($senior)
    {
        
        $this->name=$senior;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name');
    }
}
