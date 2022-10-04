<?php

use Illuminate\Support\Facades\Storage;

function handleAvatar($avatar, $hostName) {
    $avatarStorage = Storage::disk('avatars')->url($avatar);
    if(!str_contains($avatarStorage, $hostName)) {
        $changerHttp = str_replace('http://', '', $avatarStorage);
        $index = strpos($changerHttp, '/');
        return 'http://' . str_replace(
                substr($changerHttp, 0, $index),
                $hostName,
                $changerHttp
            );
    }
}
