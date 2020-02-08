@extends('layouts.app')

@section('content')



<!--==========================
  
        Speakers Section
  
      ============================-->
  
      <section id="speakers" class="pt-5">
  
        <div class="container pt-5">
  
          <div class="section-header pt-5">
  
            <h2>Founders</h2>
  
            {{-- <p>Here are some of our speakers</p> --}}
  
          </div>
  
  
  
          <div class="row">
  
            <div class="col-md-4">
  
              <div class="speaker">
  
              <img src="{{asset('img/speakers/1.jpg')}}" alt="Speaker 1" class="img-fluid">
  
                <div class="details">
  
                  <h3><a href="/about/view1">Brenden Legros</a></h3>
  
                  <p>Quas alias incidunt</p>
  
                  <div class="social">
  
                    <a href=""><i class="fa fa-twitter"></i></a>
  
                    <a href=""><i class="fa fa-facebook"></i></a>
  
                    <a href=""><i class="fa fa-google-plus"></i></a>
  
                    <a href=""><i class="fa fa-linkedin"></i></a>
  
                  </div>
  
                </div>
  
              </div>
  
            </div>
  
            <div class="col-md-4">
  
              <div class="speaker">
  
                <img src="img/speakers/2.jpg" alt="Speaker 2" class="img-fluid">
  
                <div class="details">
  
                  <h3><a href="speaker-details.html">Hubert Hirthe</a></h3>
  
                  <p>Consequuntur odio aut</p>
  
                  <div class="social">
  
                    <a href=""><i class="fa fa-twitter"></i></a>
  
                    <a href=""><i class="fa fa-facebook"></i></a>
  
                    <a href=""><i class="fa fa-google-plus"></i></a>
  
                    <a href=""><i class="fa fa-linkedin"></i></a>
  
                  </div>
  
                </div>
  
              </div>
  
            </div>
            
            <div class="col-md-4">
  
              <div class="speaker">
  
                <img src="img/speakers/3.jpg" alt="Speaker 3" class="img-fluid">
  
                <div class="details">
  
                  <h3><a href="speaker-details.html">Cole Emmerich</a></h3>
  
                  <p>Fugiat laborum et</p>
  
                  <div class="social">
  
                    <a href=""><i class="fa fa-twitter"></i></a>
  
                    <a href=""><i class="fa fa-facebook"></i></a>
  
                    <a href=""><i class="fa fa-google-plus"></i></a>
  
                    <a href=""><i class="fa fa-linkedin"></i></a>
  
                  </div>
  
                </div>
  
              </div>
  
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-4">
  
              <div class="speaker">
  
                <img src="img/speakers/4.jpg" alt="Speaker 4" class="img-fluid">
  
                <div class="details">
  
                  <h3><a href="speaker-details.html">Jack Christiansen</a></h3>
  
                  <p>Debitis iure vero</p>
  
                  <div class="social">
  
                    <a href=""><i class="fa fa-twitter"></i></a>
  
                    <a href=""><i class="fa fa-facebook"></i></a>
  
                    <a href=""><i class="fa fa-google-plus"></i></a>
  
                    <a href=""><i class="fa fa-linkedin"></i></a>
  
                  </div>
  
                </div>
  
              </div>
  
            </div>
  
            <div class="col-md-4">
  
              <div class="speaker">
  
                <img src="img/speakers/5.jpg" alt="Speaker 5" class="img-fluid">
  
                <div class="details">
  
                  <h3><a href="speaker-details.html">Alejandrin Littel</a></h3>
  
                  <p>Qui molestiae natus</p>
  
                  <div class="social">
  
                    <a href=""><i class="fa fa-twitter"></i></a>
  
                    <a href=""><i class="fa fa-facebook"></i></a>
  
                    <a href=""><i class="fa fa-google-plus"></i></a>
  
                    <a href=""><i class="fa fa-linkedin"></i></a>
  
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
  
              <h2>About Us</h2>
              <ul style="list-style:none">
              <li>
              <p>Our website helps users to find missing people 
                  , things and trying to facilate connection between the one
                   who find and the other who search</p>
                </li>
                </ul>
        </div>
  
            <div class="col-md-4 ">
             <h2>FAQ's</h2>
              <ul style="list-style:none">
              <li><a class="text-white" href="/people/search">searching about people</a></li>
              <li><a class="text-white" href="/people/image">searching of people by image</a></li>
              <li><a class="text-white" href="/items/search">searching about Items</a></li>
              </ul>
            </div>
            <div class="col-md-4 ">
                <h2>Contacts</h2>
                <ul style="list-style:none">
                <li><i class="fa fa-phone"></i> +91 9169490000</li>
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