$(document).ready(function(){
	registernegara();
})

function registernegara() {
		$('#country_regis').flagStrap({
	    buttonSize: "btn-sm",
	    labelMargin: "10px",
	    scrollable: true,
	    scrollableHeight: "350px",
	    onSelect: function(value, element) {
	    	$('#negara').val(value);
	    }
	})
}

$(document).on('click','#logout',function(){
	var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
    	window.location.replace("/");
    });
})

$(document).on('submit','#postuser',function(e){
	e.preventDefault();
	$.ajax({
		url:'/postuser',
		method:'POST',
		data:new FormData(this),
		dataType:'JSON',
		contentType: false,
		cache: false,
		processData: false,
		success:function(data){
			window.location.replace("/");
		},
		error:function(data){
			$.each(data.responseJSON, function( i, item ) {
				 $('#alert').append('<div class="alert alert-danger" role="alert">'+item+'</div>');
			});
			
		}
	})
})

function onLoad() {
  gapi.load('auth2', function() {
   	gapi.auth2.init();
  });
}