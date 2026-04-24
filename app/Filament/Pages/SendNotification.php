<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification as FilamentNotification;

use App\Models\User;
use App\Models\Notification;

class SendNotification extends Page implements Forms\Contracts\HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.send-notification';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bell';

    public ?array $data = [];

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('title')
                    ->required(),

                Forms\Components\Textarea::make('message')
                    ->required(),

                Forms\Components\Select::make('type')
                    ->options([
                        'broadcast' => 'All User',
                        'role' => 'By Role',
                        'personal' => 'User Tertentu',
                    ])
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // reset biar ga nyangkut
                        $set('user_ids', null);
                        $set('target_role', null);
                    }),

                Forms\Components\Select::make('target_role')
                    ->options([
                        'admin' => 'Admin',
                        'staff' => 'Staff',
                        'owner' => 'Owner',
                    ])
                    ->hidden(fn ($get) => $get('type') !== 'role')
                    ->dehydrated(fn ($get) => $get('type') === 'role'),

                Forms\Components\Select::make('user_ids')
                    ->multiple()
                    ->options(User::pluck('name', 'id')->toArray())
                    ->searchable()
                    ->preload()
                    ->hidden(fn ($get) => $get('type') !== 'personal')
                    ->dehydrated(fn ($get) => $get('type') === 'personal'),
            ])
            ->statePath('data');
    }

    public function submit()
    {
        $data = $this->form->getState(); // 🔥 WAJIB

        // validasi manual personal
        if ($data['type'] === 'personal' && empty($data['user_ids'])) {
            FilamentNotification::make()
                ->title('Error')
                ->body('Pilih minimal 1 user!')
                ->danger()
                ->send();

            return;
        }

        $notif = Notification::create([
            'title' => $data['title'],
            'message' => $data['message'],
            'created_by' => auth()->id(),
            'type' => $data['type'],
            'target_role' => $data['target_role'] ?? null,
        ]);

        // tentukan target user
        if ($data['type'] === 'broadcast') {
            $users = User::pluck('id');
        } elseif ($data['type'] === 'role') {
            $users = User::where('role', $data['target_role'])->pluck('id');
        } else {
            $users = collect($data['user_ids']);
        }

        // attach ke pivot
        $attachData = [];

        foreach ($users as $id) {
            $attachData[$id] = [
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $notif->users()->attach($attachData);

        // reset form
        $this->form->fill([]);

        FilamentNotification::make()
            ->title('Berhasil')
            ->body('Notif berhasil dikirim')
            ->success()
            ->send();
    }
}
