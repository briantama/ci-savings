function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};
    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

function numberFormat(idx){
  return parseInt(idx).toLocaleString(); 
}

function block() {
  var base_url  = window.location.origin;
  $.blockUI({ message : "<img src='"+base_url+"/ci-savings/stisla-master/images/load.gif' width='100px' height='100px' />",  css: { border: 'none', background: 'none' }  });
  //setTimeout(unBlock, 5000); 
}

function unBlock() {
  $.unblockUI();
}

function callpage(id, clsp, nvitem=''){ 
    //alert(id);
    if(id != ""){
    	var base_url  = window.location.origin;
        var dataString = 'content='+id;
        block();
        $.ajax({
            type : "POST",
            url  : id,
            data : dataString,
            success: function(result){
            	    //$("#load-content").hide();
            	    unBlock();
                    $("#body-ctntl").html(result);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    
                    //active class a
                    $('li.active').removeClass('active');
                    $('#'+clsp).addClass('active');
                    //

                    //active class li
                    if(nvitem != ""){
                        $('li').removeClass('active');
                        $('#'+nvitem).addClass('active');
                     }
                    //

                }});
    }
    else{
        alert("Ooops Terjadi Kesalahan, Silahkan Coba Lagi Nanti.");
    }
}


function blockForm(param){
	var base_url  = window.location.origin;
	$('#'+param).block({
       message: "<img src='"+base_url+"/ci-savings/stisla-master/images/load2.gif' width='80px' height='80px' />",  css: { border: 'none', background: 'none' } 
    });
}

function unblockForm(param) {
 	$('#'+param).unblock();
}
