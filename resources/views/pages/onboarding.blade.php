<?php

use Livewire\Volt\Component;

new class extends Component {
    public $step = 2;

    public $city;

    public $state;

    public $pincode;
};
?>


<x-onboarding-layout title="Onboarding">

    @if (auth()->user()->onboarding()->inProgress())
        <div>
            @foreach (auth()->user()->onboarding()->steps as $step)
                <span>
                    @if ($step->complete())
                        <i class="fa fa-check-square-o fa-fw"></i>
                        <s>{{ $loop->iteration }}. {{ $step->title }}</s>
                    @else
                        <i class="fa fa-square-o fa-fw"></i>
                        {{ $loop->iteration }}. {{ $step->title }}
                    @endif
                </span>

                <a href="{{ $step->link }}" {{ $step->complete() ? 'disabled' : '' }}>
                    {{ $step->cta }}
                </a>
            @endforeach
        </div>
    @endif
</x-onboarding-layout>
