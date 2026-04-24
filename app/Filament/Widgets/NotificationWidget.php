<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class NotificationWidget extends Widget
{
    protected string $view = 'filament.widgets.notification-widget';

    protected int|string|array $columnSpan = 'full';

    public function getNotifications()
    {
        return auth()->user()
            ->notifications()
            ->latest()
            ->take(10)
            ->get();
    }
    public function clearNotifications()
    {
        DB::table('notification_user')
            ->where('user_id', auth()->id())
            ->delete();
    }

    protected static bool $isLazy = false;
}
