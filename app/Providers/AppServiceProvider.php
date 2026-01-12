<?php

namespace App\Providers;

use App\Models\User;
use Spatie\Onboard\Facades\Onboard;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Listeners\DeleteExpiredNotificationTokens;
use Illuminate\Notifications\Events\NotificationFailed;

class AppServiceProvider extends ServiceProvider
{



    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {



        Event::listen(
            NotificationFailed::class,
            DeleteExpiredNotificationTokens::class
        );


        Onboard::addStep('Basic Details')
            ->link('/onboarding/basic')
            ->cta('Basic Details')
            ->completeIf(function (User $model) {

                $arr = [

                    $model->gender,

                    $model->phone_number,

                    $model->whatsapp_number,

                    $model->emergency_phone_number,

                    $model->date_of_birth,

                ];

                $isTure = !in_array(null, $arr);

                return $isTure;
            });

        Onboard::addStep('Bank Details')
            ->link('/onboarding/bank-details')
            ->cta('Bank Details')
            ->completeIf(function (User $model) {

                $hasBankDetails = $model->bank_details && count($model->bank_details) == 4 ? true : false;

                return $hasBankDetails;
            });

        Onboard::addStep('Documents')
            ->link('/onboarding/documents')
            ->cta('Documents')
            ->completeIf(function (User $model) {

                $isTrue = !in_array(null, [$model->getFirstMedia('identity_proof_document'), $model->getFirstMedia('passbook'), $model->getFirstMedia('last_education_certificate')]);
                return $isTrue;
            });

        Onboard::addStep('Address')
            ->link('/onboarding/address')
            ->cta('Address')
            ->completeIf(function (User $model) {

                //to make sure permanent and current address both are given
                return $model->address()->get()?->count() > 1;
            });

        Onboard::addStep('Guardian Information')
            ->link('/onboarding/guardian-information')
            ->cta('Guardian Information')
            ->completeIf(function (User $model) {
                // Fetch the guardian and nominee
                $guardian = $model->relatives()->where('is_nominee', false)->first();
                $nominee = $model->relatives()->where('is_nominee', true)->first();



                // Check if the guardian and nominee exist and have an 'identity_proof_document' media file
                $guardianHasIdentityProof = $guardian && auth()->user()->media('guardian_identity_proof_document')->count() > 0;
                $nomineeHasIdentityProof = $nominee && auth()->user()->media('nominee_identity_proof_document')->count() > 0;

                // Step is complete only if both guardian and nominee exist, and both have an identity proof document
                return $nomineeHasIdentityProof;
            });
    }
}
