<?php

require __DIR__ . '/auth.php';
require __DIR__ . '/www.php';
require __DIR__ . '/play.php';





//tmp routes
Route::middleware('admin')->group(function ()
{
});
