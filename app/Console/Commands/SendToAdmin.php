<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\BorrowerRecord\BorrowerRecordRepository;
use App\Repositories\User\UserRepository;
use Carbon\Carbon;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReportToAdmin;

class SendToAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendToAdmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to Administrator every 16:00 Sunday';

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
        $brRepo = new BorrowerRecordRepository();
        $number = $brRepo->getBorrowerRecordWeekly();

        $userRepo = new UserRepository();
        $data = [
            'role_id' => UserRole::Administrator,
        ];
        $admins = $userRepo->findByAttr($data);
        $start_date = Carbon::now()->startOfWeek();
        $end_date = Carbon::now()->endOfWeek();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new SendReportToAdmin(
                $admin,
                $number,
                $start_date,
                $end_date
            ));
        }
    }
}
