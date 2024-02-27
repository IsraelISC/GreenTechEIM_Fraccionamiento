window.onload= function(){
    setTimeout(function(){
        $('#onload-load').fadeOut();
        $('body').removeClass('load_navbar-hidden');
    }, 250)
}