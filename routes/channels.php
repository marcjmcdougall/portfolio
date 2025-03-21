<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// Allows any user to broadcast quick scan update events
// Broadcast::channel('quick-scan.{id}', function ($user, $id) {
//     return true; // Or implement proper authorization
// });