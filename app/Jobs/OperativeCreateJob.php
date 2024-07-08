<?php

namespace App\Jobs;

use App\Mail\OperativeCreateMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OperativeCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    
    //     // dd($data['from']);
    //     // dd($this->handle());
    }

    // public function __construct()
    // {
    // }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd(new OperativeCreateMail($this->data));
        Mail::to($this->data['from'])->send(new OperativeCreateMail($this->data));
        // Mail::to($this->data->email)->send(new OperativeCreateMail($this->data));
        // Mail::to('bilal.kodextech@gmail.com')->send(new OperativeCreateMail);

    }
}
