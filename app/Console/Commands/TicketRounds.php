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
        $locations = Locations::query()->get();

        foreach ($locations as $location) {
            $active_round = Round::query()->where('active', '=', 1)
                ->where('location_id', '=', $location->id)
                ->first();

            $numbers = range(1, 48);
            shuffle($numbers);
            $result = array_slice($numbers, 18);

            if (Ticket::all()->isEmpty()){
                    Round::query()->insert([
                        'location_id' => $location->id,
                        'active' => 1,
                    ]);
            } else {
                if ($active_round['active'] == 1 || $active_round['active'] == null) {
                    $active_round->update([
                        'active' => 0,
                        'lucky_numbers' => $result,
                        'updated_at' => Carbon::now()
                    ]);
                }

                Round::query()->insert([
                    'active' => 1,
                    'location_id' => $location->id,
                    'created_at' => Carbon::now()
                ]);
            }

        }

        if (Round::query()->where('active', '=', 0)->get() == null) {
            echo 'Wait for new round';
        } else {
            $tickets = Ticket::query()->where('hits', '=', '')->orWhereNull('hits')->get();
            foreach ($tickets as $ticket) {
                $as = Round::query()->where('id', '=', $ticket->id)->pluck('lucky_numbers')->first();
                $result_a = json_decode($as);
                $result_b = json_decode($ticket->user_numbers);

                $result_total = array_intersect($result_a, $result_b);
                $formated = implode(',', $result_total);

                $ticket->where('id', '=', $ticket->id)->update([
                    'hits' => $formated
                ]);
            }
        }

    }
}
