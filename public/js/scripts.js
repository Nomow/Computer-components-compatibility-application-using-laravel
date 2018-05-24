$(document).ready(function() {

//scroll down to errors
$("#false").click(function() {
    $('html, body').animate({
        scrollTop: $(".desctitle").offset().top -80
    }, 500);
});

 //slides down when user clicks on dropdown btn
    $('#dropdown-btn').on('click',function() {
      if($("#drop > li").css("float") == "none"){
                $('#drop > li > ul').hide();
              if ($('#dropdown-btn').hasClass( "shown" )) {
                       $('#dropdown-btn').removeClass( "shown" );
                  $('.dropdown').slideUp(200);
           
              } else {
                 $('.dropdown').slideDown(200)
                  $('#dropdown-btn').addClass('shown');
                
              }
        }

    });
      // slides up when user click outside of the navigation
        $(".full-page-wrapper").click(function(){
       if($("#drop > li").css("float") == "none"){
     $('.dropdown').hide(200);

       
    }
});

   $('#drop > li > h5').on('click',function(e) {
      if($("#drop > li").css("float") == "none"){
        e.stopPropagation();
 

      if ($("#drop > li > ul").hasClass( "showned" )) {
         $('#drop > li > ul').hide(200);
         $('#drop > li > ul').removeClass( "showned" );
      } 

 
 if($(this)){

     $(this).next("#drop > li > ul").slideDown(200).addClass('showned');

    }

     }
});


// Desktop navigation dropdown functions
    $('#dropdown-btn').on({
      mouseenter: function () {
        //stuff to do on mouse enter
        if ($("#drop > li").css("float") == "left"){
          $('#drop > li > ul').show();
          $('.dropdown').slideDown(10);
      }

      },

      mouseleave: function () {
        //stuff to do on mouse leave
        if ($("#drop > li").css("float") == "left"){
          $('.dropdown').slideUp(10);
        }

      }
});

 //Goes to the top of the page
$('#top-up').click(function(){
    $('html, body').animate({scrollTop :0});
  
  });

    $('#filter-btn').on('click',function() {

        $('#filter-drop').slideDown(200);


    });
      // slides up when user click outside of the navigation
        $(".resp").click(function(){
     
     $('#filter-drop').slideUp(200);
});
       
  
$('ul.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  })


//save session on href click
$('.save-session').on('click', function(){
    var token = $('meta[name="csrf-token"]').attr('content'),
      $this = $(this),
      url = $this.data('url');

    $.post(url, { _token: token }).done(function(msg) {
     window.location.replace("saliec-pats");

    });
});

});



