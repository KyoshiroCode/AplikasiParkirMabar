<?php
namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    // 🔥 kirim ke 1 user
    public static function sendToUser($userId, $title, $message)
    {
        return Notification::create([
            'title' => $title,
            'message' => $message,
            'user_id' => $userId,
        ]);
    }

    // 🔥 broadcast ke banyak user
    public static function broadcast($users, $title, $message)
    {
        foreach ($users as $user) {
            Notification::create([
                'title' => $title,
                'message' => $message,
                'user_id' => $user->id,
            ]);
        }
    }

    // 🔥 broadcast ke role tertentu
    public static function toRole($role, $title, $message)
    {
        $users = User::where('role', $role)->get();

        self::broadcast($users, $title, $message);
    }
}
