@php
    use Carbon\Carbon;

    // Fetch all events and map them for the calendar
    $events = \App\Models\Event::all()->flatMap(function ($event) {
        // Ensure the event date is in Carbon format
        $eventDate = $event->date instanceof Carbon ? $event->date : Carbon::parse($event->date);

        $mappedEvents = [];

        // Add the event for the current year
        $mappedEvents[] = [
            'label' => $event->name,
            'description' => $event->description,
            'css' => $event->repeat ? '!bg-green-200' : '!bg-amber-200', // Different style for repeated events
            'date' => $eventDate->year(now()->year)->format('Y-m-d'), // Current year
        ];

        // Add the event for the next year if it's a recurring event
    if ($event->repeat) {
        for ($i = 1; $i <= 10; $i++) {
            $mappedEvents[] = [
                'label' => $event->name,
                'description' => $event->description,
                'css' => '!bg-green-200', // Same style for repeated events
                'date' => $eventDate->year(now()->year + $i)->format('Y-m-d'), // Add for each subsequent year
            ];
        }
    }

    return $mappedEvents;
});

$today = Carbon::today();

// Get today's event
    $todayEvent = \App\Models\Event::where('date', '=', $today)->orderBy('date', 'asc')->first();

    // Get the next upcoming event that is not today
    $upcomingEvent = \App\Models\Event::where('date', '>', $today)->orderBy('date', 'asc')->first();
@endphp

<x-card title="Events">
    @if ($upcomingEvent)
        <div>
            <x-alert :title="$upcomingEvent->name . ' on ' . $upcomingEvent->date->format('F j, Y')" :description="$upcomingEvent->description" icon="o-calendar" class="alert-info" />
        </div>
    @endif

    @if ($todayEvent)
        <div>
            <x-alert :title="'Today is ' . $todayEvent->name" :description="$todayEvent->description" icon="o-calendar" class="alert-success" />
        </div>
    @endif

    <div class="border rounded-md mt-5">
        <center>
            <x-calendar :events="$events->toArray()" weekend-highlight sunday-start months="4" />
        </center>
    </div>
</x-card>
