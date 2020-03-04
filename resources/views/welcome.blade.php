@extends('layouts.app')

@section('content')

    <section id="intro">
        <div class="intro-container wow fadeIn">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <h1 class="mb-4 pb-0">{{ __('messages.Find Any Thing') }}
                <br><span>{{ __('messages.Lost') }}</span> {{ __('messages.From You') }}</h1>
            <!-- <p class="mb-4 pb-0">10-12 December, Downtown Conference Center, New York</p> -->
            <a href="https://youtu.be/7s5eyNiE_ng" class="venobox play-btn mb-4" data-vbtype="video"
               data-autoplay="true"></a>
            <a href="{{ url('/people/search') }}" class="about-btn scrollto">{{ __('messages.People') }}</a>
            <a href="/items/search" class="about-btn scrollto">{{ __('messages.Items') }}</a>
        </div>
    </section>
    <!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
        <div class="alert alert-success" role="alert">
{{ session('status') }}
            </div>
@endif

        You are logged in!
    </div>
</div>
</div>
</div>
</div> -->
    <script>
        $(document).ready(function () {
            $(".alert").slideDown(300).delay(3000).slideUp(300);
        });
    </script>
@endsection
