<?php

namespace App\Console\Commands;

use App\Models\Locations;
use App\Models\Round;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TicketRounds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:rounds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start new lucky 6 round every five minutes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $locations = Locations::query()->get('id')->toArray();
        $active_round = Round::query()->where('active', '=', 1)->pluck('id')->first();

        $numbers = range(0, 48);
        shuffle($numbers);
        $result = array_slice($numbers, 19);

        if ($active_round == 1) {
            Round::query()->where('id', '=', $active_round)->update(
                [
                    'active' => 0,
                    'numbers' => $result,
                    'updated_at' => Carbon::now()
                ]);
        }
//
        Round::query()->insert([
            'active' => 1,
            'created_at' => Carbon::now()
        ]);
        Log::info("Cron is working fine!");

        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
//        return Command::SUCCESS;
    }
}
