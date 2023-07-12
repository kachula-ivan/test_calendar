<?php

namespace App\Jobs;

use App\Mail\EndBooking;
use App\Mail\StartBooking;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EndBookingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $name;
    public $title;
    public $color;
    public $start_date;
    public $end_date;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $name, $title, $color, $start_date, $end_date)
    {
        $this->email = $email;
        $this->name = $name;
        $this->title = $title;
        $this->color = $color;

        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $time = Carbon::parse(now());
        $end = Carbon::parse($this->end_date);

        $timeSeconds = $time->timestamp;
        $endSeconds = $end->timestamp;

        $when = $endSeconds - $timeSeconds;
        $when = $when - 10800;

        Mail::to($this->email)->later($when, new EndBooking($this->name, $this->title, $this->color,$this->start_date, $this->end_date));
    }
}
