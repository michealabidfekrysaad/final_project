@extends('layouts.app')

@section('content')



    <!--==========================

        Speakers Section

      ============================-->

    <section id="speakers" class="pt-5">

        <div class="container pt-5">

            <div class="section-header pt-5">

                <h2>{{ __('messages.Founders') }}</h2>

            </div>


            <div class="row">

                <div class="col-md-4">

                    <div class="speaker">

                        <img src="{{asset('img/speakers/micheal.jpg')}}" alt="Speaker 1"
                             style="width:400px;height:300px;">
                        <div class="details">

                            <h3><a>Micheal Abid</a></h3>

                            <p>Full Stack Developer</p>

                            <div class="social">

                                <a class="mr-2" href="https://github.com/michealabidfekrysaad"><i
                                        style="font-size: 20px" class="fa fa-github"></i></a>

                                <a class="mr-2" href="https://www.linkedin.com/in/micheal-abid-fekry-52a500184/"><i
                                        style="font-size: 20px" class="fa fa-linkedin"></i></a>

                                <a class="mr-2" href="{{asset('cvs/MichealResume.pdf')}} "><i style="font-size: 20px"
                                                                                              class="fa fa-download"
                                                                                              title="download CV"></i></a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="speaker">

                        <img src="{{asset('img/speakers/eslam.jpg')}}" alt="Speaker 2"
                             style="width:400px;height:300px;">
                        <div class="details">

                            <h3><a>Eslam Mohamed</a></h3>

                            <p>Full Stack Developer</p>

                            <div class="social">

                                <a class="mr-2" href="https://github.com/EslamMohamed74"><i style="font-size: 20px"
                                                                                            class="fa fa-github"></i></a>

                                <a class="mr-2" href="https://www.linkedin.com/in/eslam-mo-hussein/"><i
                                        style="font-size: 20px" class="fa fa-linkedin"></i></a>

                                <a class="mr-2" href="{{asset('cvs/Eslam-Mohamed-Resume.pdf')}}"><i
                                        style="font-size: 20px" class="fa fa-download" title="download CV"></i></a>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="speaker">

                        <img src="{{asset('img/speakers/abdelrahman.png')}}" alt="Speaker 3"
                             style="width:400px;height:300px;">
                        <div class="details">

                            <h3><a>Abdelrahman Fahmy</a></h3>

                            <p>Full Stack Developer</p>

                            <div class="social">

                                <a class="mr-2" href="https://github.com/abdelrhmanfahmi"><i style="font-size: 20px"
                                                                                             class="fa fa-github"></i></a>

                                <a class="mr-2" href="https://www.linkedin.com/in/abdelrahman-fahmy-3aa921184/"><i
                                        style="font-size: 20px" class="fa fa-linkedin"></i></a>

                                <a class="mr-2" href="{{asset('cvs/AbdelrhmanFahmy.pdf')}}"><i style="font-size: 20px"
                                                                                               class="fa fa-download"
                                                                                               title="download CV"></i></a>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-md-2">
                </div>

                <div class="col-md-4">

                    <div class="speaker">

                        <img src="{{asset('img/speakers/mohamed.jpg')}}" alt="Speaker 4"
                             style="width:400px;height:300px;">
                        <div class="details">

                            <h3><a>Mohamed ibrahim</a></h3>

                            <p>Full Stack Developer</p>

                            <div class="social">

                                <a class="mr-2" href="https://github.com/himaaaintake40"><i style="font-size: 20px"
                                                                                            class="fa fa-github"></i></a>

                                <a class="mr-2" href="https://www.linkedin.com/in/mohamed-ibrahim-77129a122"><i
                                        style="font-size: 20px" class="fa fa-linkedin"></i></a>

                                <a class="mr-2" href="{{asset('cvs/hima.pdf')}}"><i style="font-size: 20px"
                                                                                    class="fa fa-download"
                                                                                    title="download CV"></i></a>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="speaker">

                        <img src="{{asset('img/speakers/person.jpg')}}" alt="Speaker 5"
                             style="width:400px;height:300px;">
                        <div class="details">

                            <h3><a>Islam Emam</a></h3>

                            <p>Full Stack Developer</p>

                            <div class="social">

                                <a class="mr-2" href="https://github.com/Islam44"><i style="font-size: 20px"
                                                                                     class="fa fa-github"></i></a>

                                <a class="mr-2" href="https://www.linkedin.com/in/islam-emam-91409012a/"><i
                                        style="font-size: 20px" class="fa fa-linkedin"></i></a>

                                <a class="mr-2" href="{{asset('cvs/Islam-Emam (PHP Laravel)demo .pdf')}}"><i
                                        style="font-size: 20px" class="fa fa-download" title="download CV"></i></a>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-md-2">
                </div>


            </div>

        </div>


    </section>



    <!--==========================

          About Section

        ============================-->

    <section id="about">

        <div class="container">

            <div class="row">

                <div class="col-md-4 ">

                    <h2>{{ __('messages.About Us') }}</h2>
                    <ul style="list-style:none">
                        <li>
                            <p>{{ __('messages.aboutWeb') }}</p>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 ">
                    <h2>{{ __('messages.FAQ`s') }}</h2>
                    <ul style="list-style:none">
                        <li><a class="text-white" href="/people/search">{{ __('messages.searching about people') }}</a>
                        </li>
                        <li><a class="text-white"
                               href="/people/image">{{ __('messages.searching of people by image') }}</a></li>
                        <li><a class="text-white" href="/items/search">{{ __('messages.searching about Items') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 ">
                    <h2>{{ __('messages.Contacts') }}</h2>
                    <ul style="list-style:none">
                        <li><i class="fa fa-phone"></i> +012 0000000000</li>
                        <li><i class="fa fa-envelope-o"></i> info@tofind@gmail.com</li>
                        <li><i class="fa fa-globe"></i> www.tofind.com</li>
                    </ul>
                </div>


            </div>
            <div class="row mt-2 ">
                <div class="col-12 text-center ">

                    Copyright © 2020 tofind.com

                </div>
            </div>
        </div>

    </section>








@endsection
