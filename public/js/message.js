function message($alert,$message,$redirectTo){ 
  toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-top-center",
      "onclick": null,
      "showDuration": "5000",
      "hideDuration": "5000",
      "timeOut": "5000",
      "extendedTimeOut": "5000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    if($alert == "fail"){
        toastr.warning($message, $alert);
    }else if($alert == "error"){
        toastr.error($message, $alert);
    }else if($alert == "info"){
        toastr.info($message, $alert);
    }else{
        toastr.success($message, $alert);
    } 
    $("body").removeClass('loading');
    if(typeof $redirectTo != "undefined"){
         $.each($('a.sub'), function(i,v){ 
             if($(v).data('url')== $redirectTo){
                $(v).click(); 
             }
         }); 
    } 
}
 