$(document).ready(function(){
	if ($('#pagination').val()=='detailforum') {
		loaddetailforum();
	}
})

function loaddetailforum() {
 var url = window.location.search.substring(1);

    var url = url.split('id=');
    loadpost(url[1]);
}

$(document).on('click','.opendetailpost',function(){
	var id=$(this).attr('id').split('opendetailpost')[1];
	window.location.replace('/detailforum?id=load'+btoa(id));
})