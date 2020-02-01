jQuery(document).ready(function ($) {

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn('slow');
    } else {
      $('.back-to-top').fadeOut('slow');
    }
  });
  $('.back-to-top').click(function () {
    $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
    return false;
  });

  // Header fixed on scroll
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('#header').addClass('header-scrolled');
    } else {
      $('#header').removeClass('header-scrolled');
    }
  });

  if ($(window).scrollTop() > 100) {
    $('#header').addClass('header-scrolled');
  }

  // Real view height for mobile devices
  if (window.matchMedia("(max-width: 767px)").matches) {
    $('#intro').css({ height: $(window).height() });
  }

  // Initiate the wowjs animation library
  new WOW().init();

  // Initialize Venobox
  $('.venobox').venobox({
    bgcolor: '',
    overlayColor: 'rgba(6, 12, 34, 0.85)',
    closeBackground: '',
    closeColor: '#fff'
  });

  // Initiate superfish on nav menu
  $('.nav-menu').superfish({
    animation: {
      opacity: 'show'
    },
    speed: 400
  });

  // Mobile Navigation
  if ($('#nav-menu-container').length) {
    var $mobile_nav = $('#nav-menu-container').clone().prop({
      id: 'mobile-nav'
    });
    $mobile_nav.find('> ul').attr({
      'class': '',
      'id': ''
    });
    $('body').append($mobile_nav);
    $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>');
    $('body').append('<div id="mobile-body-overly"></div>');
    $('#mobile-nav').find('.menu-has-children').prepend('<i class="fa fa-chevron-down"></i>');

    $(document).on('click', '.menu-has-children i', function (e) {
      $(this).next().toggleClass('menu-item-active');
      $(this).nextAll('ul').eq(0).slideToggle();
      $(this).toggleClass("fa-chevron-up fa-chevron-down");
    });

    $(document).on('click', '#mobile-nav-toggle', function (e) {
      $('body').toggleClass('mobile-nav-active');
      $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
      $('#mobile-body-overly').toggle();
    });

    $(document).click(function (e) {
      var container = $("#mobile-nav, #mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
          $('#mobile-body-overly').fadeOut();
        }
      }
    });
  } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
    $("#mobile-nav, #mobile-nav-toggle").hide();
  }

  // Smooth scroll for the menu and links with .scrollto classes
  $('.nav-menu a, #mobile-nav a, .scrollto').on('click', function () {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {
        var top_space = 0;

        if ($('#header').length) {
          top_space = $('#header').outerHeight();

          if (!$('#header').hasClass('header-fixed')) {
            top_space = top_space - 20;
          }
        }

        $('html, body').animate({
          scrollTop: target.offset().top - top_space
        }, 1500, 'easeInOutExpo');

        if ($(this).parents('.nav-menu').length) {
          $('.nav-menu .menu-active').removeClass('menu-active');
          $(this).closest('li').addClass('menu-active');
        }

        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
          $('#mobile-body-overly').fadeOut();
        }
        return false;
      }
    }
  });

  // Gallery carousel (uses the Owl Carousel library)
  $(".gallery-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    center: true,
    responsive: {
      0: { items: 1 }, 768: { items: 3 }, 992: { items: 4 }, 1200: { items: 5 }
    }
  });

  // Buy tickets select the ticket type on click
  $('#buy-ticket-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var ticketType = button.data('ticket-type');
    var modal = $(this);
    modal.find('#ticket-type').val(ticketType);
  })

});

$(document).ready(function () {

  // //filter_data();
  //
  // function filter_data() {
  //   var action = 'fetch_data';
  //   var gender = get_filter('gender');
  //   var age = get_filter('age');
  //     if($("#DropDownList1 :selected").text()!=" "){
  //         var city = $("#DropDownList1 :selected").text();
  //     }
  //     var data = {gender,city,age};
  //     $.ajax({
  //         method:"GET",
  //         url:"/filter/"+JSON.stringify(data),
  //         traditional: true,
  //         headers: {
  //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //         },
  //         //data: JSON.stringify(data),
  //         success:function(data){
  //             console.log(data);
  //         }}
  //   );
  //   var data = { "gender": gender, "age": age, "city": city };
  //   console.log(data);
  //
  //filter_data_people();
  //
  // function filter_data_people() {
  //   var gender = get_filter('gender');
  //   var age = get_filter('age');
  //   var city = $("#DropDownList1 :selected").text();
  //   $.ajax({
  //       url:"/filter/find",
  //       method:"POST",
  //       data:{ "gender": gender, "age": age, "city": city },
  //       success:function(data){
  //           // $('.filter_data_people').html(data);
  //
  //       }
  //   }
  //
  //   );
  //   var data = { "gender": gender, "age": age, "city": city };

  //   for (var key in data) {
  //     if (data.hasOwnProperty(key)) {
  //         console.log(key + " -> " + data[key]);
  //     }
  // }
  //
  // console.log(data);
  //   $('.filter_data').html();
  // }
  //
  // function get_filter(class_name) {
  //   var filter = [];
  //   $('.' + class_name + ':checked').each(function () {
  //     filter.push($(this).val());
  //   });
  //   return filter;
  // }
  //
  // $('.custom-control-input').click(function () {
  //   filter_data();
  // });
  //
  // $("#DropDownList1").change(function (e) {
  //
  //   filter_data();
  //
  // })
  //
  //   $('.filter_data_people').html();
  // }

  // function get_filter(class_name) {
  //   var filter = [];
  //   $('.' + class_name + ':checked').each(function () {
  //     filter.push($(this).val());
  //   });
  //   return filter;
  // }
  //
  // $('.custom-control-input').click(function () {
  //   filter_data_people();
  // });
  //
  // $("#DropDownList1").change(function (e) {
  //
  //   filter_data_people();
  //
  // })

  //filter_data_item();

  // function filter_data_item() {
  //
  //   var categoryList = $("#CategoryList :selected").text();
  //   var city = $("#city :selected").text();
  //   var region = $("#region :selected").text();
  //   $.ajax({
  //       url:"/filter/find",
  //       method:"POST",
  //       data:{ "category": categoryList , "city": city, "region": region},
  //       success:function(data){
  //           // $('.filter_data_item').html(data);
  //
  //       }
  //   }
  //
  //   );
  //   var data = { "category": categoryList , "city": city, "region": region};
  //
  //   for (var key in data) {
  //     if (data.hasOwnProperty(key)) {
  //         console.log(key + " -> " + data[key]);
  //     }
  // }
  //
  // }



  // $("#CategoryList").change(function (e) {
  //
  //   filter_data_item();
  //
  // })
  // $("#city").change(function (e) {
  //
  //   filter_data_item();
  //
  // })
  // $("#region").change(function (e) {
  //
  //   filter_data_item();
  //
  // })

});

