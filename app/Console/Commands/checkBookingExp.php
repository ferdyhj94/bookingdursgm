<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\TransaksiBooking;
use Carbon\Carbon;
class checkBookingExp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkexp:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check expired booking and update status to refund';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dataPesan = DB::table('transaksi_bookings')->select('*')->get();
        foreach($dataPesan as $data):
        if($data->expired_time > Carbon::now()->toDateTimeString() || $data->status=='0'):
                $transaksi = TransaksiBooking::find($data->id);
                $transaksi->status='4';
                $transaksi->update();
            endif;
        endforeach;
    }
}
