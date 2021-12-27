<?php

require __DIR__ . '/www.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/play.php';





























//tmp routes
Route::middleware('admin')->group(function ()
{
    Route::get('/test', function()
    {
$address = '0xbf4013ca1d3d34873a3f02b5d169e593185b0204';
$purchases = json_decode(file_get_contents(__DIR__.'/paid.json'))->result;
$sent = json_decode(file_get_contents(__DIR__.'/sent.json'))->result;
$test = json_decode(file_get_contents(__DIR__.'/test.json'));
$wei_value1 = 1000000000000000000;
$wei_value2 = 10000000;

foreach ($sent as $send)
{
    foreach ($test as $abc)
    {
        if ($send->to === $abc->address)
            echo 'already sent';
    }
}

/*
//echo '2nd 3rd and 4th airdrop (2nd minus 2 wallets who got twice in first airdrop):<br><br>';
$allPurchases = [];
foreach ($purchases as $purchase)
{
    $estimatedAmount = 585 * (intval($purchase->value) / $wei_value1);
    $estimatedGoals = 0;

    // days 19 and 21 (nov 2021)
    switch (date('d', $purchase->timeStamp))
    {
        case '19':
        case '20': $estimatedGoals = $estimatedAmount / 0.04; break;
        case '21':
        case '22':
        case '23': $estimatedGoals = $estimatedAmount / 0.06; break;
        default: dd('Transaction date mismatch (2). Please, contact support.');
    }

    $purchase->goal_tokens = number_format($estimatedGoals, 2, '.', '');
    $allPurchases[] = $purchase;
    $amountToSend = ((($purchase->goal_tokens / 4) * 1.2) + 50) + ($purchase->goal_tokens / 4);
    echo "$address,$purchase->from,$amountToSend<br>";
}
/*
$already = [];$count=0;
foreach ($purchases as $purchase)
{
    foreach ($sent as $send)
    {
        if (strtolower($purchase->from) === strtolower($send->to))
        {$value = intval($send->value) / $wei_value2;$count++;$val = ($value - 50) * 4;
            echo "$count: $purchase->from purchased <b>$purchase->goal_tokens</b> and already got (<b>$value</b> - 50) * 4 = <b>$val</b><br>";
            $already[] = $send;
            continue;
        }
    }
}
$presaleCount = count($purchases);$sentCount=count($sent);$alreadyCount=count($already);$othersCount=$sentCount-$alreadyCount;$missing=$presaleCount-$alreadyCount;
echo "<p>presale purchases: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$presaleCount = $alreadyCount (received 25% + 50 tokens) + $missing (received nothing)</p>",
     "<p>txs sent using gnosis safe: $sentCount = 218 (received 25% + 50 tokens) + 84 (received by mistake minus 3 jasper)</p>";

$others = $sent;
foreach ($sent as $send)
{
    foreach ($already as $test)
    {
        if (strtolower($send->to) === strtolower($test->to) && $send->value === $test->value)
            unset($others[array_search($test,$others)]);
    }
}

dump($already);
dump($others);



/*
$count=0;
foreach (array_diff($purchases,$already) as $missing)
{
    $count++;
    echo "$count: $missing->from<br>";
}

*/
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

