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
        $paid = json_decode(file_get_contents(__DIR__.'/paid.json'))->result;
        $sent = json_decode(file_get_contents(__DIR__.'/sent.json'))->result;
dump($paid);dump($sent);
        $address = '0xbf4013ca1d3d34873a3f02b5d169e593185b0204';


        $notSent = array_udiff($paid, $sent, fn ($a, $b) => $a->from <=> $b->to);

dump($notSent);






/*


        $duplicatedPayment = [];
        $list = [];
        foreach ($paid as $tx)
        {
            foreach ($payments as $payment)
            {
                if (strtolower($payment->txHash) === strtolower($tx->hash))
                {$duplicatedPayment[] = strtolower($tx->hash);
                    $tx->payment = $payment;
                    $list[] = $tx;
                }
            }
        }

        dump(array_count_values($duplicatedPayment));

        echo 'verified txs: <br><br>';
        $listCount = 0;
        foreach ($list as $test)
        {$listCount++;$tokens = $test->payment->goal_tokens / 4;$value = $test->value / 1000000000000000000;
            echo "$listCount: $test->hash, $test->from, (goal) $tokens and (bnb) $value<br>";
        }

        echo '<br><br>not sent: <br><br>';
        $notSent = array_udiff($list, $sent, fn ($a, $b) => strtolower($a->from) <=> strtolower($b->to));
        $notSentCount = 0;
        foreach ($notSent as $test)
        {$notSentCount++;$tokens = $test->payment->goal_tokens / 4;$value = $test->value / 10000000;
            echo "$notSentCount: $test->hash, $test->from, (goal) $tokens and (goal) $value<br>";
        }

        $users_staking = [];

        $stakings = DB::table('stakings')->get();
        foreach ($stakings as $staking)
        {
            $users_staking[$staking->user_id] = 0;
        }

        $list2 = [];
        foreach ($list as $test)
        {
            if (array_key_exists($test->payment->user_id, $users_staking))
                $list2[] = $test;
        }

        $list3 = [];
        foreach ($list as $test)
        {
            if (array_key_exists($test->payment->user_id, $users_staking))
                $list3[] = $test;
        }

        $need_reward1 = array_udiff($list2, $sent, fn ($a, $b) => strtolower($a->from) <=> strtolower($b->to));
        $need_reward2 = array_udiff($list3, $sent, fn ($a, $b) => strtolower($a->from) <=> strtolower($b->to));

        echo 'staking users1:<br><br>';
        $count1=0;
        foreach ($need_reward1 as $tx)
        {$count1++;
            $amount = (($tx->payment->goal_tokens / 4) * 1.2) + 50;
            echo "$address,$tx->from,$amount<br>";
        }
        echo "count1: $count1<br><br>";

        echo 'staking users2:<br><br>';
        $count2=0;
        foreach ($need_reward2 as $tx)
        {$count2++;
            $amount = (($tx->payment->goal_tokens / 4) * 1.2) + 50;
            echo "$address,$tx->from,$amount<br>";
        }
        echo "count2: $count2";*/
        // replace 0xFB2B954d045733C084eC9beBe9e01176929f5F84 with 0xfef5F1dE0a6f6b5E5243548C0951823AFC9fE499
    });
});

/*
$count2++;
                $to = $test[0]->from;

                $total2 += $amount;

        echo "count1: $count1, count2: $count2, goal total: $total1, total to send: $total2";
*/

