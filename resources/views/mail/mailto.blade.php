@component('mail::message')
    hello {{$report}}
    'you are lately make a report
    for a lost person on our website
    and there is someone whosearching
    for the same person and his information


    Name : {{$otherUser->name}}
    Email :{{$otherUser->email}}
    Phone Number : {{$otherUser->phone}}

    @component('mail::button', ['url' => '/people/reports/'.$report->id])
        View Report
    @endcomponent

    @component('mail::button', ['url' => '/closereport/'.$this->report->id])
        Close Report
    @endcomponent

    @component('mail::button', ['url' => '/'])
      Still Report
    @endcomponent
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
