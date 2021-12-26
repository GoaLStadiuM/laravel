<?php

require __DIR__ . '/www.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/play.php';





























//tmp routes
Route::middleware('admin')->group(function ()
{
    Route::get('/test', function()
    {
        //$payments = DB::table('tokenpayments')->get();

        $address = '0xbf4013ca1d3d34873a3f02b5d169e593185b0204';

$paid = json_decode(file_get_contents(__DIR__.'/paid.json'))->result;
$sent = json_decode(file_get_contents(__DIR__.'/sent.json'))->result;
dump($paid);dump($sent);
$newPaid = [];
$newSent = [];
$countPaid = 0;
foreach ($paid as $payment)
{$countPaid++;
	$payment->compare = $payment->from;
$newPaid[] = $payment;
}
$remove = [
'0x7b499865fa5e1c1ce9380639958cbb0d99ee9617',
'0x90294c1a37b4b7b67fee8d3710789dc7129a9060',
'0x4346f9246d22017d23983eff9293e22096affa8a',
'0x3b760850138d06fd8ef70bcfd4f84c6fd0654baa',
'0x5b74f3f178cf0bf021037209c8a35aef788da451',
'0x052ccbd5c8161b9feb20ddc371ba1624eddf6ddd',
'0x856250505690e7e8f31bd55aeb6e1cbd16b15d91',
'0xb4fd847236fb1093439e112925002ef7fdddb0c3',
'0x68dccb2044846337e346064267e0337965b40710',
'0x04cc3bbf75258ee9cbdfd4b95843e3aad037cb62',
'0xd1230a8c29d52a1a7cccce4b4815087bbd24da4d',
'0x7d2a94281a098a257d17632f393930c745b17d94',
'0x1754565cf85273a3175ac8337a395ea85a7eeff9',
'0x2db8025a9afbe8e7119b7467cfd6cdd473f60c90',
'0x6dcfc3ba0d1662d42665b058cac0b4029fc12b4a',
'0x4809afd8ed948476f2df6cf43cefe05cec14b92a',
'0x5e9d36fffa180fb8663d5203300bec78fa5e3f7f',
'0xdad57be48b952262d9229ed0825433cc777e791c',
'0xd9acb69b68829af8c4eb6298c6b715eecd552bd2',
'0xc8f4626f567d358893531f88d60a0392d9d27b8c',
'0x80e8a625223bf5ad6d712f9907a963402a685a08',
'0xabea0753451599708f2f2d721fc6b2916e9b3c73',
'0xc3656e1b47808b56e601b2daf36ab8a1c7a21825',
'0xce6cca8d5762d388572c1107273b150376967965',
'0xaceb0d0919ebb6959d218705c9dde3a1fa2fa8fb',
'0x62c6eb4cf69867086391bc310c0f88a5fc5de4ab',
'0xb0da828f66286286678b8c5bd0301199108584bb',
'0x1507eac41c4f56fbc51812fa2d81f4b682111abc',
'0x9b9851da4d7cc012c33a948c8dd121bcdcb62254',
'0x4cfad8b54eea0f61556920bce3898b6c9ba98cd2',
'0x1eb3abcb686f25c386d04f29d6645797127d4ee3',
'0xcabc6d90653cd65f266610cba18a85ba5f5e1568',
'0xe7df8a6702d0f96c5dd400f292b4b1012ef06e1f',
'0xfd6b39e97890af7bcf2143df5f787b2c00c5d11d',
'0xe4136d277fc9d00975f3ebd3c44da1bd276f8d49',
'0x4ba99c680f6a6bdef60569ffdf0aa1ce701782a1',
'0x5258eecd1d2115d37ebfc42df0ca7ef2cc4dcf18',
'0x608ee965e95704281235c747e700ba41e39b80a0',
'0xef9428382480709acb34de606d2c6e7ff79afcf7',
'0x5af8227ba1230966b01ab2862c304d8a8f11c4b6',
'0xb172e21c518f9eed74f817dcfabe85568bd66fc7',
'0xe015c40c111aaa178dcb21e2fb7b7563fdb97c3e',
'0x1a36cf8e7943a49fdeee483af6b5ff9ffd27b486',
'0xb9e1d041d3f402c8ef5c082d84e658570a38353d',
'0x6c6b3a431171f53ed47717ee145e2f0b8c35535c',
'0x0157997a80289e96c7845ad1690b4dfa2d3c85d9',
'0x8c8b7770026de6a1cda4e25bed40d29b9e1ea2fb',
'0xbe447a6077086052abbedee0bfc69b811dfd85a7',
'0xaf27989e310ecf2ba30a76503d7ea8fa12b88f72',
'0x042b211159d4f893a4e4e5217d0d19a9b9e68635',
'0x51f1451f9bf6408be9eb8aad4d88fe77b963d919',
'0x825aa4cc727d7251aaa393d52ca9e2ee066a7129',
'0x26061b7e1a6e8d33367c0a3aa1c91fab17bbe8fc',
'0xa44dae66cc9284f1a91008489597279d1aed8e2d',
'0xe4f9f4744fa288cb22ddefc8a2ea6041e6843900',
'0xe61b8865b59054a352596fb6075a487401d45f7f',
'0x7f97403b9a4ab2fcf5a3ffe896b60bd3a9228354',
'0x6925476bbbb33de904420b706320678f15f34636',
'0x1f62cc603cacb38eb3547eeb326e36031494cd9b',
'0x8624fb6663594500aa536c249c271e314a471f93',
'0x1a488fd93bcd1d654b48af52fa0737e5693187af',
'0x2488d2cd883b087107d2d4fc3a1ab5acb0e78ef4',
'0x1931ceb7efee8e7256bdb4e205d9cd3ab18fc359',
'0x819427de7d7d5c4a7a4b6f1806a59b7e42f4e287',
'0xa7a628cc13bf5caa5d259ac31af7fe3d8b060ee5',
'0x5fdcf4b865e0e920984c2b425175dd01fc9e2361',
'0xb541de70cb5047b45b26d3f6f5af024654503f30',
'0xfef5f1de0a6f6b5e5243548c0951823afc9fe499',
'0xeaf863059160b39f859ff36e5f4a70716f1873a8',
'0x553893df0fe3672d8c8c24481fff2733f7fc2402',
'0x19058bf0cb5a4ac21ea5f0437e740084a5339a78',
'0xfa6ad6b2ea6c9cbbf01e17b4a04392dfa54ef5aa',
'0x6ab39a1d3bf623684590582169ca17633fe524d3',
'0xeacff14218ef542905c7db14dbe9a266599f9110',
'0x65caba076d0f98bf16db8d8a39a6ea1922c174e5',
'0x22c1606e56685627c3fb62afa0cfbc7ba5e71485',
'0xa039465f8e2e8551f3614aefb63e64e2f88de847',
'0xcb99bb6f5aa099db65d463516543cf9d3449a16c',
'0xd2351156f6512b42545c20e5794adc59937a04de',
'0x7f6c2f4a7fed40d5e5f4df321c6ba0c356b8a3aa',
'0xd0515a7dfb09ebdccaee3b446f3368111d6b28ac',
'0xec03394b2e55b256decfbf299fad8daf42966b7b',
'0xaad45ab75fd29cba195b25c7575eff662e5e1620',
'0xf82ebc402c644f2810595c11528745f9a03cc32e',
'0x2b82323cf737cc1cc9b72e38bef919acddf1850b',
'0x26614926e2c92d5116c2016e0b81e6025a5659d0',
'0xe22773710d53958c7424d8dfc78d15271162189a',
'0x22936b0f3f810d9908348fd9844b7c3ee21c0719',
'0xa3a381bc10470c14af684f1fde5676ec2273fc3f',
'0x91012160423a3d5c2552790596fad86dcef372d3',
'0xcc487f4d5fd58b0f8f15f6ec30ac621565123e8b',
'0xe5ff846f7ecf0f5919b5bfab46b76bb290ba2b41',
'0xaae12ae42cc936240558de65bf75cd1ea063a68e',
'0x6433cbe728d7c8a4a0e614d44128d5e9f880970e',
'0x637dbe2519003bd8dc9cd3aca559ea189db62736',
'0x1f16f62b7ac1ecd98127298e73e1e20bdbe36c93',
'0x07442df3c34af21b79fd136b9233a3cf3870e910'
];
foreach ($sent as $send)
{
	if (in_array($send->to,$remove))
		continue;

	$send->compare = $send->to;
	$newSent[] = $send;
}
dump($newSent);
$fuckMe = array_udiff($newPaid, $newSent, fn ($a, $b) => $a->compare <=> $b->compare);
$fuckYou = array_udiff($newSent, $newPaid, fn ($a, $b) => $a->compare <=> $b->compare);
dump($fuckMe);dump($fuckYou);
$abc=0;
foreach ($fuckYou as $meh)
{$abc++;
	echo "'$meh->to',<br>";
}
 



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

