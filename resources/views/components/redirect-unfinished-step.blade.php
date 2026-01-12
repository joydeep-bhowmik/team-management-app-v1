<?php

use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    #[On('redirect-to-next')]
    function next()
    {
        $onboarding = auth()->user()->onboarding();

        if ($onboarding->inProgress()) {
            return $this->redirect($onboarding->nextUnfinishedStep()->link, navigate: true);
        }

        if ($onboarding->finished()) {
            return $this->redirect(route('profile'), navigate: true);
        }
    }
};
?>



@volt('redirect-unfinished-step')
    <div><x-button class="mt-5" wire:click="next" spinner>Next Unfinished Step</x-button></div>
@endvolt
