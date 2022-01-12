<?php


























require __DIR__ . '/auth.php';





//tmp routes
Route::middleware('admin')->group(function ()
{
require __DIR__ . '/www.php';
require __DIR__ . '/play.php';
});
