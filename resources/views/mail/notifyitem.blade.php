@component('mail::message')
    @component('mail::message')
        hello {{$item->user->name}}<br>
        My Name Is {{auth()->user()->name}}<br>
        this {{($item->category)->category_name }} belong to me <br>
        his/her  Description   <br>
        {{($descriptionValidation)->description}} <br>
        if description is correct please contact him/her with following info    <br>
        name : {{auth()->user()->name}}  <br>
        email : {{auth()->user()->email}}  <br>
        phone : {{auth()->user()->phone}}  <br>
        @component('mail::button', ['url' => 'http://localhost:8000/acceptMessage/accept/'.$descriptionValidation->id])
            Accept
        @endcomponent
        @component('mail::button', ['url' => 'http://localhost:8000/acceptMessage/reject/'.$descriptionValidation->id])
            Reject
        @endcomponent
        Thanks,<br>
        ToFind
    @endcomponent
