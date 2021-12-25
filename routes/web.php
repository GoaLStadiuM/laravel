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
        $result2 = json_decode(file_get_contents("https://api.bscscan.com/api?module=account&action=tokentx&address=0x7f27Ddb0159B8433571D990d24271DDbe345286E&apikey=C3J2T5UV3WKW2B54HUKKS61JIVV7B6TBBX"))->result;
        $list = [];
        $list2 = [];
        $address = '0xbf4013ca1d3d34873a3f02b5d169e593185b0204';

        foreach ($result as $tx)
        {
            foreach ($payments as $payment)
            {
                if (strtolower($payment->txHash) === strtolower($tx->hash))
                {
                    $tx->payment = $payment;
                    $list[] = $tx;
                }
            }
        }

        $stakings = DB::table('stakings')->get();
        $users_staking = [];

        foreach ($stakings as $staking)
        {
            $users_staking[$staking->user_id] = 0;
        }

        foreach ($list as $test)
        {
            if (array_key_exists($test->payment->user_id, $users_staking))
                $list2[] = $test;
        }

        $need_reward = array_udiff($list2, $result2, fn ($a, $b) => strtolower($a->from) <=> ($b->to));
//dd(array_udiff($list2,$need_reward, fn ($a, $b) => $a->from <=> $b->to));
	echo 'all payments: ', count($list), ' ',
	     'blab is back: ', count($list2), ' ',
	     'missing payments: ', count($need_reward), ' ',
	     'staking count: ', count($users_staking), '<br><br>',
	     'staking users:<br><br>';
$count=0;
        foreach ($need_reward as $tx)
        {$count++;
            $amount = (($tx->payment->goal_tokens / 4) * 1.2) + 50;
            echo "$count: $address,$tx->from,$amount<br>";
        }
echo "count: $count";
        // replace 0xFB2B954d045733C084eC9beBe9e01176929f5F84 with 0xfef5F1dE0a6f6b5E5243548C0951823AFC9fE499
    });
});

/*
$count2++;
                $to = $test[0]->from;

                $total2 += $amount;

        echo "count1: $count1, count2: $count2, goal total: $total1, total to send: $total2";
*/

