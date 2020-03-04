@extends('layouts.app')

@section('content')
    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg  py-5">

        <div class="container py-5">

            <div class="section-header pt-5">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <h2>{{ __('messages.Contact Us') }}</h2>
            </div>
            <div class="form">
                <div id="sendmessage">{{ __('messages.Your message has been sent. Thank you!') }}</div>
                <div id="errormessage"></div>
                <form action="/contact/store" method="post" role="form" class="contactForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            @if(auth()->check())
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                       data-rule="minlen:4" data-msg="Please enter at least 4 chars"
                                       value="{{auth()->user()->name}}"/>
                            @else
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                       data-rule="minlen:4" data-msg="Please enter at least 4 chars"/>
                            @endif
                            <div class="validation"></div>
                        </div>
                        <div class="form-group col-md-6">
                            @if(auth()->check())
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email"
                                       value="{{auth()->user()->email}}"/>
                            @else
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="Your Email" data-rule="email"
                                       data-msg="Please enter a valid email"/>
                            @endif
                            <div class="validation"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" id="subject"
                               placeholder="{{ __('messages.Subject') }}" data-rule="minlen:4"
                               data-msg="Please enter at least 8 chars of subject"/>
                        <div class="validation"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5" data-rule="required"
                                  data-msg="Please write something for us"
                                  placeholder="{{ __('messages.Message') }}"></textarea>
                        <div class="validation"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit">{{ __('messages.Send Message') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section><!-- #contact -->


@endsection