<?php

use Livewire\Volt\Component;

new class extends Component {
    public $user;
    public $year;
    public array $years = [];
    function mount($user = null)
    {
        $this->user = $user ?? auth()->user();
        $this->year = request('year', now()->year);

        $firstYear = DB::table('leave_applications')->selectRaw('MIN(YEAR(created_at)) as year')->value('year');
        $startYear = $firstYear ?? now()->year;
        $currentYear = now()->year;

        $years = range($startYear, $currentYear);
        $this->years = collect($years)->map(fn($y) => ['id' => $y, 'name' => $y])->toArray();
    }
};
?>


<x-card class="sapce-y-5" title="Leave Stats" subtitle="This is responsive">
    <x-slot:menu>
        <x-select class="ml-auto" wire:model.live="year" :options="$years" option-value="id" option-label="name" />
    </x-slot:menu>
    <x-progress class="progress-primary h-0.5" indeterminate wire:loading />
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <x-stat title="EL" :value="($user?->approvedEL($year) ?? 0) . ' / ' . ($user?->designation()?->first()?->EL ?? 0)" />

        <x-stat title="SL" :value="($user?->approvedSL($year) ?? 0) . ' / ' . ($user?->designation()?->first()?->SL ?? 0)" />

        <x-stat title="CL" :value="($user?->approvedCL($year) ?? 0) . ' / ' . ($user?->designation()?->first()?->CL ?? 0)" />
    </div>
</x-card>
