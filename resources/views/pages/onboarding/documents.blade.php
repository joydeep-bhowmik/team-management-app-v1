<?php

use Mary\Traits\Toast;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use Toast, WithFileUploads;

    public $identity_proof_document;

    public $last_education_certificate;

    public $passbook;

    function save()
    {
        $user = auth()->user();

        $this->validate([
            'identity_proof_document' => [$user->getFirstMediaUrl('identity_proof_document') ? 'nullable' : 'required', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'passbook' => [$user->getFirstMediaUrl('passbook') ? 'nullable' : 'required', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'last_education_certificate' => [$user->getFirstMediaUrl('last_education_certificate') ? 'nullable' : 'required', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ]);

        if ($this->identity_proof_document) {
            $user->deleteMediaCollection('identity_proof_document');

            $user->addMedia($this->identity_proof_document)->toCollection('identity_proof_document', folder: 'employee_documents');
        }

        if ($this->last_education_certificate) {
            $user->deleteMediaCollection('last_education_certificate');

            $user->addMedia($this->last_education_certificate)->toCollection('last_education_certificate', folder: 'employee_documents');
        }

        if ($this->passbook) {
            $user->deleteMediaCollection('passbook');

            $user->addMedia($this->passbook)->toCollection('passbook', folder: 'employee_documents');
        }

        if ($user->save()) {
            $this->success('Saved');
            $this->dispatch('redirect-to-next');
        }
    }

    function with()
    {
        $user = auth()->user();

        return compact('user');
    }
};

?>


<x-onboarding-layout title="Documents">

    @volt('onboarding.documents')
        <div>
            <x-card title="Documents">
                <x-big-loading-screen wire:loading
                    wire:target='passbook,last_education_certificate,identity_proof_document' />

                <x-slot:menu> <x-button wire:click='save' spinner>save</x-button></x-slot:menu>

                <div class="space-y-3">

                    <div>

                        <x-file wire:model="identity_proof_document" label='Identity proof document (Adhaar or Similiar)' />

                        @php
                            $identity_proof_document = $user->getFirstMedia('identity_proof_document');

                        @endphp
                        @if ($identity_proof_document)
                            <x-button class="mt-1" icon='o-document' external :link='$identity_proof_document->getUrl()' :label='$identity_proof_document?->original_file_name' />
                        @endif


                    </div>


                    <div>
                        <x-file wire:model="passbook" label='Bank Passbook' />

                        @php
                            $passbook = $user->getFirstMedia('passbook');

                        @endphp
                        @if ($passbook)
                            <x-button class="mt-1" icon='o-document' external :link='$passbook->getUrl()' :label='$passbook->original_file_name' />
                        @endif
                    </div>

                    <div>
                        <x-file wire:model="last_education_certificate" label='Last education certificate' />
                        @php
                            $last_education_certificate = $user->getFirstMedia('last_education_certificate');

                        @endphp
                        @if ($last_education_certificate)
                            <x-button class="mt-1" icon='o-document' external :label='$last_education_certificate->original_file_name' :link='$last_education_certificate->getUrl()' />
                        @endif
                    </div>



                </div>
            </x-card>
        </div>
    @endvolt

</x-onboarding-layout>
