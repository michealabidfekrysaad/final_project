@component('mail::message')
    @component('mail::message')
        hello {{$item->user->name}} My Name Is {{auth()->user()->name}} )
                         this {{($item->category)->category_name }} belong to me
                           and my description is
                          {{($descriptionValidation)->description}}
                          if description is correct please contact him/her
                           name : {{auth()->user()->name}}
                           email : {{auth()->user()->email}}
                           phone : {{auth()->user()->phone}}
        @component('mail::button', ['url' => 'http://localhost:8000/acceptMessage/accept/'.$descriptionValidation->id])
            Accept
        @endcomponent
        @component('mail::button', ['url' => 'http://localhost:8000/acceptMessage/reject/'.$descriptionValidation->id])
            Reject
        @endcomponent
        Thanks,<br>
        {{ config('app.name') }}
@endcomponent
