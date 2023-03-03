<?php

namespace App\Console\Commands;

use App\Jobs\EmailSender;
use App\Mail\Message;
use App\Mail\MessageSender;
use App\Models\Post;
use Illuminate\Console\Command;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;


class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending email to users';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        dispatch(new EmailSender());
        $this->warn('The email send successfuly');
    }
}
