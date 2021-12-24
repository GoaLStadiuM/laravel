<?php

require __DIR__ . '/www.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/play.php';





























//tmp routes
Route::middleware('admin')->group(function ()
{
    Route::get('/test', function()
    {
        $payments = DB::table('tokenpayments')->get();
        $result = json_decode(file_get_contents("https://api.bscscan.com/api?module=account&action=txlist&address=0x55b42BbB7CC8C531bd4fe42C5067de487Cde45CA&apikey=C3J2T5UV3WKW2B54HUKKS61JIVV7B6TBBX"))->result;
        $list = [];
        $address = '0xbf4013ca1d3d34873a3f02b5d169e593185b0204';
        $count1 = 0;
        $count2 = 0;

        echo 'List of people of purchased in presales:<br><br>';

        foreach ($result as $tx)
        {
            foreach ($payments as $payment)
            {
                if ($payment->txHash !== $tx->hash)
                    continue;
$count1++;
                $list[] = [ $tx, $payment ];
                echo "wallet: $tx->from, purchased: $payment->goal_tokens GoaL (total)<br>";
            }
        }

        echo '<br><br>Excel:<br><br>';

        foreach ($list as $test)
        {$count2++;
            $to = $test[0]->from;
            $amount = $test[1]->goal_tokens;
            echo "$address,$to,$amount<br>";
        }

        echo "count1: $count1, count2: $count2";
    });
});
