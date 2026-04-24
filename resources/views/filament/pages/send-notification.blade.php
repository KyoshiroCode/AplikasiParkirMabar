<x-filament-panels::page>
    <form wire:submit="submit">
        {{ $this->form }}
        <br>
        <x-filament::button type="submit" class="mt-4">
            Kirim Notifikasi
        </x-filament::button>
    </form>
</x-filament-panels::page>
