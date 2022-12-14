<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel('chatting.{sender}.{receiver}', function ($user, $receiver) {
//     return true;
//  });

 Broadcast::channel('message-delete.{sender}.{receiver}', function ($user, $receiver) {
    return true;
 });

//  Broadcast::channel('groupChatting.{groupId}', function () {
//     return true;
//  });

 Broadcast::channel('agora-videocall', function ($user) {
    if($user != null){
        return ['id' => $user->id, 'name' => $user->name];
    }
});

// Broadcast::channel('trainer-message', function ($group) {
//     return true;
// });
