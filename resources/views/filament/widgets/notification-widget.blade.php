<x-filament-widgets::widget>
    <div x-data="{ open: false }" style="position: relative; display: flex; justify-content: flex-end;">
        <!-- HEADER -->


        <!-- 🔔 BUTTON -->
        <button 
            @click="open = !open"
            style="
                position: relative;
                padding: 8px;
                border-radius: 50%;
                border: none;
                background: transparent;
                cursor: pointer;
                font-size: 20px;
            "
        >
            🔔

            @php
                $count = auth()->user()
                    ->notifications()
                    ->wherePivot('is_read', false)
                    ->count();
            @endphp

            @if ($count > 0)
                <span style="
                    position: absolute;
                    top: -5px;
                    right: -5px;
                    background: red;
                    color: white;
                    font-size: 10px;
                    padding: 2px 6px;
                    border-radius: 999px;
                ">
                    {{ $count }}
                </span>
            @endif
        </button>

        <!-- 📦 DROPDOWN -->
        <div 
            x-show="open"
            @click.outside="open = false"
            x-transition
            style="
                position: absolute;
                right: 0;
                top: 40px;
                width: 600px;
                height: auto;
                background: white;
                border: 1px solid #ddd;
                border-radius: 10px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.15);
                z-index: 999;
                overflow: hidden;
            "
        >

            <!-- HEADER -->
            <div style="
                padding: 10px;
                font-weight: bold;
                border-bottom: 1px solid #eee;
            ">
                Notifikasi
            </div>

            <!-- LIST -->
            <div style="max-height: 300px; overflow-y: auto;">

                @forelse ($this->getNotifications() as $notif)
                        <div style="
                            padding: 10px;
                            font-weight: bold;
                            border-bottom: 1px solid #eee;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            ">
                            <span>Notifikasi</span>

                            <button 
                                wire:click="clearNotifications"
                                style="
                                    font-size: 11px;
                                    color: red;
                                    background: none;
                                    border: none;
                                    cursor: pointer;
                                "
                            >
                                Clear All
                            </button>
                        </div>

                    <div style="
                        padding: 10px;
                        border-bottom: 1px solid #eee;
                    ">

                        <div style="display: flex; justify-content: space-between;">

                            <div>
                                <div style="font-weight: bold; font-size: 14px;">
                                    {{ $notif->title }}
                                </div>

                                <div style="font-size: 12px; color: gray;">
                                    {{ $notif->message }}
                                </div>
                            </div>

                            @if (!$notif->pivot->is_read)
                                <span style="
                                    width: 8px;
                                    height: 8px;
                                    background: red;
                                    border-radius: 50%;
                                    margin-top: 5px;
                                    display: inline-block;
                                "></span>
                            @endif

                        </div>

                        @php
                            if (!$notif->pivot->is_read) {
                                auth()->user()->notifications()
                                    ->updateExistingPivot($notif->id, [
                                        'is_read' => true,
                                        'read_at' => now()
                                    ]);
                            }
                        @endphp

                    </div>

                @empty
                    <div style="
                        padding: 15px;
                        text-align: center;
                        color: gray;
                        font-size: 13px;
                    ">
                        Tidak ada notifikasi
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</x-filament-widgets::widget>
