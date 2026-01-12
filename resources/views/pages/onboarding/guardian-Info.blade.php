<?php

use Livewire\Volt\Component;

new class extends Component {
    function with()
    {
        $user = auth()->user();

        return compact('user');
    }
};
?>

<x-onboarding-layout title="guardian info">
    @volt('relatives')
        <div class="space-y-5">
            <livewire:employee-relative :$user title="Legal guardian (Optional)" />

            <livewire:employee-relative :$user :isNominee='true' title="Nominee" dispatchOnSuccess='redirect-to-next' />
        </div>
    @endvolt
</x-onboarding-layout>
