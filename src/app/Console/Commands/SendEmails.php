<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Reservation;
use App\Mail\ReservationReminderMail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         // 当日の予約を取得
        $todayReservations = Reservation::whereDate('date', now()->format('Y-m-d'))->get();

        // 各予約者にメールを送信
        foreach ($todayReservations as $reservation) {
            Mail::to($reservation->user->email)->send(new ReservationReminderMail($reservation));
        }
    }
}
