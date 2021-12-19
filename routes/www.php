<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ShopController;
use App\Models\Presale;

Route::domain('www.' . config('app.domain'))->group(function ()
{
    Route::get('/', [WebController::class, 'landing'])->name('landing');
    Route::get('/purchases', [ShopController::class, 'purchases'])->name('purchases')->middleware(['auth']);
    Route::get('/request-tokens/{id}', [ShopController::class, 'requestToken'])->name('request.tokens')->middleware(['auth']);
    Route::post('/sent/staking/presale', [ShopController::class, 'sentStakingPresale'])->name('sent.staking.presale')->middleware(['auth']);
    Route::view('/manualhash', 'shop.manualhash')->name('manualhash')->middleware(['auth']);
    Route::post('/manualhash/check', [ShopController::class, 'manualHash'])->name('manualhash.check')->middleware(['auth', 'throttle:5,.07']);
    Route::get('/team', [WebController::class, 'team'])->name('team');
    Route::get('/partner', [WebController::class, 'partner'])->name('partner');
    Route::get('/stake', [WebController::class, 'stake'])->name('stake');
    Route::get('/audits', [WebController::class, 'audits'])->name('audits');
    Route::get('/farming', [ShopController::class, 'farming'])->name('farming')->middleware(['auth']);
    Route::get('/farming/stats/{payment_id}', [ShopController::class, 'stats'])->name('stats')->middleware(['auth']);
    Route::get('/farming/select/training/{player_id}/{training_type}/{payment_id}', [ShopController::class, 'selectTraining'])->name('selectTraining')->middleware(['auth']);
    Route::get('/farming/claim-reward/{training_id}', [ShopController::class, 'claim'])->name('claim')->middleware(['auth']);

    // ADMIN ROUTES
    Route::get('/737679/out', [ShopController::class, 'payer']);
    Route::post('/737679/withdraw', [ShopController::class, 'payerPost']);

    Route::get('/test123', function() {
        $json = json_decode(file_get_contents("https://api.bscscan.com/api?module=account&action=tokentx&contractaddress=0xc4c12802377ad9fc6c1a570faca44c1e43284dc4&address=0x6eb73DA0c4e007bF4E7db56e6A67F1903a74445f&apikey=C3J2T5UV3WKW2B54HUKKS61JIVV7B6TBBX"));
        $presale = Presale::get();
        $contract = '0xBF4013ca1d3D34873A3f02B5D169E593185B0204';

        echo "Current list:<br>";
        foreach ($presale as $withdrawal)
        {
            echo "$withdrawal->wallet,$withdrawal->amount<br>";
        }

        foreach ($json->result as $tx)
        {
            foreach ($presale as $withdrawal)
            {
                if ($withdrawal->wallet === $tx->to)
                {
                    $withdrawal->paid = true;
                    $withdrawal->save();
                    continue;
                }
            }
        }

        echo "<br>New list:<br>";
        foreach ($presale as $withdrawal)
        {
            echo "$contract,$withdrawal->wallet,$withdrawal->amount<br>";
        }
    });
});
