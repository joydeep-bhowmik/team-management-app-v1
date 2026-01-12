@props(['user'])
<a {{ $attributes->merge(['class' => ' block rounded-full border bg-white pr-5 shadow-sm']) }}>


    <x-avatar class="!w-14" :image="$user?->avatar ?? '/empty-user.jpg'" :title="$user?->name ?? 'Deleted User'" :subtitle="$user?->designation()->first()?->name ?? 'No designation yet'" />

</a>
