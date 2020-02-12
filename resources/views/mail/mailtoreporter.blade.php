@component('mail::message')
    hello {{$report->user->name}}
    'you are lately make a report
    for a lost person on our website
    and there is someone who searching or founding
    for the same person and his information

    name : {{auth()->user()->name}}
    email : {{auth()->user()->email}}
    phone : {{auth()->user()->phone}}
    @component('mail::button', ['url' => 'http://localhost:8000/people/details/'.$report->id])
        View Report
    @endcomponent
    please make an action after meet him/her
    @component('mail::button', ['url' => 'http://localhost:8000/closereport/'.$report->id])
        Close Report
    @endcomponent
    @component('mail::button', ['url' => 'http://localhost:8000/stillreport/'.$report->id])
      Still Report
    @endcomponent
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
