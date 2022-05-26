<?php

use App\My;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel(My::ROW_IMPORT_PROGRESS_CHANNEL . '.*', static function($user, $id) {
    return (int)$id === (int)config('app.user_id');
});

Broadcast::channel(My::ROW_IMPORT_ERROR_CHANNEL . '.*', static function($user, $id) {
    return (int)$id === (int)config('app.user_id');
});
