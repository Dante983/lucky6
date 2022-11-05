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
                        'numbers' => $result,
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

        $tickets = Ticket::query()->where('hits', '=', '')->orWhereNull('hits')->get();
        foreach ($tickets as $ticket) {
            $as = Round::query()->where('id', '=', $ticket->id)->pluck('numbers')->first();
            $qa  =str_replace('[', ',',$as);
            $a =  str_replace(']', ',',$qa);
            $b = explode(',', $a);

            $n  =str_replace('[', ',',$ticket->numbers);
            $g =  str_replace(']', ',',$n);
            $i = str_replace('"', ',', $g);
            $d = str_replace(' ', ',', $i);
            $h = explode(',', $d);
            $filtered = array_values(array_filter($h));

           $hits = json_decode(json_encode(array_intersect($filtered, $b)), true);
           $arhi = array_values($hits);

            $ticket->where('id', '=', $ticket->id)->update([
               'hits' => $arhi
            ]);
        }

    }
}
