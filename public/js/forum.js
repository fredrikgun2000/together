$(document).ready(function(){
	pagination();
	pilihnergara();
	ceklogin();
	onlineready();
	hapussession();
	$('#customSwitch1').prop('checked', true);
	if ($.session.get('pagination')!='detailforum') {
		loadpost('all');
	}
	loadproteksi();
});

function checkproteksi(text,id) {
	if (id=='t'|| id=='f') {
		id=id;
		if (id=='f'){
			return text=text;
		}
	}else{
		id=$('#proteksi'+id).text();
		if (id=='protect'){
			return text=text;
		}
	}
	var dataproteksi=$.session.get("dataproteksi").split(',');
	var text=text.toLowerCase();
	var texts='';
	String.prototype.repeat = function(num){
	  return new Array(num + 1).join(this);
	}
	 for(var i=0; i<dataproteksi.length; i++){
	    var pattern = new RegExp('\\b' + dataproteksi[i] + '\\b', 'g');
	    var replacement = '*'.repeat(dataproteksi[i].length);
	    text = text.replace(pattern, replacement);
 	 }
		return text;
}

function pagination() {
	var pagination=$.session.get('pagination');
	$('.pagination').removeClass('text-primary');
	$('#'+pagination).addClass('text-primary');
	if (pagination=='pforum') {
		$('#pagepostcommunity').append('<div id="datapost"></div>');
		$('#btnmakecomunity').hide();
		$('#btnmakepost').show();
	}else if (pagination=='community') {
		$('#pagepostcommunity').append('<div id="datacommunity"></div>');
		$('#btnmakecomunity').show();
		$('#btnmakepost').hide();
	}
}

function hapussession() {
	$.session.remove('selectcatagori');
}

function resetmodal() {
	$('.reset').val('');
	$('#areacatagori').val('');
	$.session.remove('selectcatagori');
	$('pre').remove();
	checkcatagori();
	loadtempfile();
	$('#id_user').val('');
	$('#id').val('');
	$('#file').val('');
	$('#modalpost').modal('hide');
}

function onlineready() {
	$.ajax({
		url:'loadonline',
		method:'GET',
		success:function(data){
			$('.onlineuser').remove();
			$.each(data.data,function(i,item){
				$('#onlineuser').append('<div class="row my-2 onlineuser" contextmenu="'+item.negara+'"><div class="col-lg-3"><img src="/assets/img/'+item.foto+'" style="width:50px;height:50px;border-radius:100%;" alt="a"></div><div class="col-lg-9 pt-3"><small>'+item.nama+'</small></div></div>');
			});
		}
	})
}

function onSignIn(googleUser) {
	var profile = googleUser.getBasicProfile();
	var id=btoa(profile.getId());
	var email=btoa(profile.getEmail());
	var name=profile.getName();
	var nama=btoa(profile.getName());
	$.ajax({
		url:'http://localhost:8080/checkuser',
		method:'GET',
		data:{
			'id':id,
			'email':email,
			'nama':nama,
		},
		success:function(data){
			$.session.set("idgoogle",id);
			$('#username').html(name);
			$('#btnlogin').remove();
			var idgoogle=$.session.get('idgoogle');
			if (idgoogle==null) {
				$('#usernamedropdown').hide();
				
			}else{
				$('#usernamedropdown').show();
				$('#username').show();
				$('#contributtion').show();
			}
			dataprofil();
			if ($.session.get('pagination')!='detailforum') {
				loadpost('all');
			}
		},error:function(data){
			window.location.replace("/register?id="+data.responseJSON.data.id+"&email="+data.responseJSON.data.email+"&nama="+data.responseJSON.data.nama);
		}
	});
	
}

function mustlogin() {
	if ($.session.get("idgoogle")==null) {
		$('.abcRioButtonContentWrapper').click();
	}
}

function ceklogin() {
	var idgoogle=$.session.get("idgoogle");
	if (idgoogle==null) {
		$('#usernamedropdown').hide();
		$('#contributtion').hide();
		
	}
}

function pilihnergara() {
	$('#country').flagStrap({
		buttonSize: "btn-sm",
		labelMargin: "10px",
		scrollable: true,
		scrollableHeight: "350px",
		onSelect: function(value, element) {
			$( ".onlineuser" ).each(function( index ) {
				$(this).show();
				if ($( this ).attr('contextmenu')!=value) {
					$(this).hide();
				}
				if(value==""){
					onlineready();
				}
			});
		}, 
	});
}

function checkcatagori() {
	var get=$.session.get('selectcatagori');
	if (get==null) {
		$('.spancatagori').remove();
		$('#spancatagori').append('<pre> </pre>');
	}else{
		var split=get.split(',');
		$('pre').remove();
		$('.spancatagori').remove();
		$.each(split,function(i,item){
			$('#spancatagori').append('<span class="spancatagori text-light bg-success px-2 mx-1" style="border-radius:5px;">'+item+'</span>');
		})
	}
}

function loadtempfile() {
	var id=btoa($.session.get("id"));
	$.ajax({
		url:'loadtempfile',
		data:{
			id:id
		},
		method:'GET',
		success:function(data){
			$('.spanfile').remove();
			$.each(data.data,function(i,item){
				$('#spangambar').append('<img src="/assets/data/img/'+item.image+'" style="width: 70px;height: 80px;" class="'+item.image+' spanfile"><span class="'+item.image+' mr-1 text-danger material-icons hapustempfile spanfile" id="'+item.id+'" style="font-size:20px; position:relative;top:-25px;">remove_circle</span>');
				$('#spanvideo').append('<video width="240px" class="'+item.video+' spanfile mx-1" controls><source src="/assets/data/video/'+item.video+'" type="video/mp4"></video><span class="'+item.video+' mr-1 text-danger material-icons hapustempfile spanfile" id="'+item.id+'" style="font-size:20px; position:relative;top:-25px;">remove_circle</span>');
				$('#spanothers').append('<span class="px-3 bg-light mx-1 '+item.others+' spanfile" style="border-radius: 10px;"><i class="material-icons text-success" style="font-size: 15px;">insert_drive_file</i><small>'+item.others+'</small></span><span class="'+item.others+' mr-1 text-danger material-icons hapustempfile spanfile" id="'+item.id+'" style="font-size:20px; position:relative;top:0;">remove_circle</span>');
			})
			$('.null').remove();
		}
	})
}

function loadpost(params) {
	var usia=$.session.get('usia');
	$.ajax({
		url:'/loadpost/'+params,
		method:'GET',
		success:function(data){
			$('.datapost').remove();
			$.each(data.data,function(i,item){
				item.judul=checkproteksi(item.judul,item.proteksi);
				item.konten=checkproteksi(item.konten,item.proteksi);
				var katagori='';
				var file='';
				for (var i = 0; i < item.catagories.length; i++) {
					if (item.catagories[i].katagoris!="") {
						if (katagori=='') {
							katagori='<span class="text-primary spandirectcatagori"> #'+item.catagories[i].katagoris+'</span>';
						}else{
							katagori=katagori+'<span class="text-primary spandirectcatagori"> #'+item.catagories[i].katagoris+'</span>';
						}
					}
				}
				for (var i = 0; i < item.file.length; i++) {
					if (file=='') {
						file='<img src="/assets/data/img/'+item.file[i].image+'" style="width:20%;" class="img '+item.file[i].image+'">';	
					}else{
						file=file+' '+'<img src="/assets/data/img/'+item.file[i].image+'" style="width:20%;" class="img '+item.file[i].image+'">';
					}
				}
				var proteksi;
				if (item.proteksi=="t") {
					proteksi='<small id="proteksi'+item.id+'" class="btn-success px-2" style="border-radius: 10px;">protected</small>';
				}else{
					proteksi='<small id="proteksi'+item.id+'" class="btn-danger px-2" style="border-radius: 10px;">protect</small>';
				}

				$('#datapost').append('<div class="row my-4 datapost '+item.proteksi+'"><div class="col-lg-11 mx-auto pt-2" style="background-color: white; border-radius: 10px;"><div class="row"><div class="col-lg-1"><img src="/assets/img/'+item.foto+'" alt="a" style="width:50px;height:50px;border-radius:100%;"></div><div class="col-lg-11"><div class="row"><div class="col-lg-11"> <b class="opendetailpost" id="opendetailpost'+item.id+'">'+item.judul+'</b> </div> <div class="col-lg-1 text-right"> <i class="material-icons">more_vert</i> </div> </div> <div class="row" style="margin-top: -10px;"> <div class="col-lg-12"> <small class="text-secondary">'+item.nama+'</small> </div> </div> </div> </div> <div class="row my-1"> <div class="col-lg-12"> <p>'+item.konten+'<br><small>'+katagori+'</small></p> </div> <div class="col-lg-12 loadfile">'+file+'</div> </div> <div class="row my-1"> <div class="col-lg-3"> <i class="material-icons icon likepost" id="likepost'+item.id+'">favorite_border</i><small class="mx-2" id="loadlikepost'+item.id+'"></small> <i class="material-icons icon copypost" id="copypost'+item.id+'">share</i><small class="mx-2" id="loadsharepost'+item.id+'"></small><i class="material-icons icon">people</i><small class="mx-2" id="memberpost'+item.id+'"></small> </div> <div class="col-lg-9 text-right text-secondary"> '+proteksi+' - <small>'+item.updated_at+'</small> - <small class="flagstrap-icon flagstrap-'+(item.negara).toLowerCase()+'"></small> </div> </div> <div class="row mb-3"> <div class="col-lg-12"> <button class="form-control text-primary" data-toggle="collapse" href="#collapsediscussionx'+item.id+'" role="button" aria-expanded="false" style="border: none;">show all discussion (<small id="countchat'+item.id+'"></small>) </button> </div> </div> <div class="row collapse my-2" id="collapsediscussionx'+item.id+'">  <div class="col-lg-12"> <div class="row" style="max-height: 300px; overflow-y:auto;transform: scaleY(-1);" id="chat'+item.id+'"> </div> <div class="row"> <div class="col-lg-12" id="actionpost'+item.id+'"><div class="row joinpost'+item.id+'"><div class="col-lg-12"><button class="form-control btn-primary btnjoinpost" id="'+item.id+'">join discussion</button></div></div></div> </div> </div> </div> </div> </div>'); 
				if ($.session.get('pagination')!='detailforum') {
					$('.loadfile').remove();
				}
				$('#loadlikepost'+item.id).html(item.total_like);
				loadchatpost(item.id);
				loadlikesharepost(item.id);
				loadkontakpost(item.id);
				$('.null').remove();
				if(usia<18){
					$('.f').remove();
				}
				})
			}
		})
	}

function loadchatpost(params) {
	$.ajax({
		url:'loadchatpost/',
		data:{
			id:btoa(params)
		},
		method:'GET',
		success:function(data){
			$('#countchat'+params).html(data.count_chat);
			$('.chat'+params).remove();
			$.each(data.data,function(i,item){

				item.chat=checkproteksi(item.chat,params);
				var iduser=$.session.get('id');
				var barischat='';
				if (item.id_user!=iduser) {
					barischat='<div class="row my-3 chat'+params+'"> <div class="col-lg-12"> <div class="row"> <div class="col-lg-1"> <img src="/assets/img/'+item.foto+'" alt="a" style="width:100%;border-radius:100%;"> </div> <div class="col-lg-10"> <div class="row"> <div class="col-lg-12"> <small> <b>'+item.nama+'</b> </small> </div> </div> <div class="row"> <div class="col-lg-12"> <p>'+item.chat+'</p> </div> </div> </div> <div class="col-lg-1 border-left text-center"> <div class="row"> <div class="col-lg-12"> <i class="material-icons">favorite_border</i> </div> </div> <div class="row"> <div class="col-lg-12"> <span>'+item.like+'</span> </div> </div> </div> </div> </div> </div>';
				}else{
					barischat='<div class="row my-1 py-2 chat'+params+'" style=" background-color: #f4f9f9;"> <div class="col-lg-12"> <div class="row"> <div class="col-lg-11"> <div class="row"> <div class="col-lg-12 text-right"> <small> <b>'+item.nama+'</b> </small> </div> </div> <div class="row"> <div class="col-lg-12 text-right"> <p>'+item.chat+'</p> </div> </div> </div> <div class="col-lg-1 border-left text-center"> <div class="row"> <div class="col-lg-12"> <i class="material-icons">favorite_border</i> </div> </div> <div class="row"> <div class="col-lg-12"> <span>'+item.like+'</span> </div> </div> </div> </div> </div> </div>';
				}
				$('#chat'+params).append('<div class="col-lg-12" style="transform: scaleY(-1);">'+barischat+'</div>');
			})

		}
	})
	
}

function loadkontakpost(params) {
	$.ajax({
		url:'loadkontakpost/'+btoa(params),
		method:'GET',
		success:function(data){
			if (data.data.length!=0) {
				$.each(data.data,function(i,item){
					$('#memberpost'+item.id_post).html(item.count_member);
					var iduser=$.session.get('id');
					if (iduser==item.id_user) {
						$('.inputchat'+item.id_post).remove();
						$('#actionpost'+item.id_post).append('<div class="row py-2 inputchat'+item.id_post+'"> <div class="col-lg-11"> <input type="text" name="" id="inputchat'+item.id_post+'" class="form-control inputchat"> </div> <div class="col-lg-1 text-center pt-2"> <i class="material-icons icons btnsend" id="btnsendx'+item.id_post+'">send</i> </div> </div>');
						$('.joinpost'+item.id_post).remove();
					}
				})
			}
		}
	})
}


function loadproteksi() {
	var dataproteksi=$.session.get("dataproteksi");
	if (dataproteksi==null) {
		$.ajax({
			url:'loadproteksi',
			method:'GET',
			success:function(data){
				$.each(data.data,function(i,item){
					var dataproteksi=$.session.get("dataproteksi");
					if (dataproteksi==null) {
						$.session.set('dataproteksi',item);
					}else{
						$.session.set('dataproteksi',[dataproteksi,item]);
					}
				});
			}
		})
	}
}

function loadlikesharepost(params) {
	var iduser=$.session.get('id');
	$.ajax({
		url:'loadlike',
		method:'GET',
		data:{
			id:btoa(params),
			id2:btoa(iduser),
			item:'post,post'
		},
		success:function(data){
			$('#loadlikepost'+params).html(data.data.total_like);
			if (data.data.status!="") {
				$('#likepost'+params).html('favorite').addClass('text-danger');
			}else{
				$('#likepost'+params).html('favorite_border').removeClass('text-danger');
			}
		}
	})
}

function sendchat(id) {
	var chat=$('#inputchat'+id).val();
	var id2=$.session.get('id');
	if (chat!='') {
		$.ajax({
			url:'sendchatpost',
			data:{
				id:btoa(id),
				id2:btoa(id2),
				chat:btoa(chat)
			},
			method:'GET',
			success:function(data){
				$('#inputchat'+id).val('');
			}
		})
	}
}


$(document).on('click','.hapustempfile',function(){
	var id=btoa($(this).attr('id'));
	$.ajax({
		url:'deletetempfile',
		data:{
			id:id
		},
		method:'GET',
		success:function(data){
			loadtempfile();
		}
	})
})

$(document).on('click','#logout',function(){
	var id=btoa($.session.get('id'));
	var auth2 = gapi.auth2.getAuthInstance();
	auth2.signOut().then(function () {
		$.session.clear();
		window.location.replace("logout/"+id);
	});
})

$(document).on('submit','#formgambar',function(e){
	e.preventDefault();
	$.ajax({
		url:'/postgambar',
		method:'POST',
		data:new FormData(this),
		dataType:'JSON',
		contentType: false,
		cache: false,
		processData: false,
		success:function(data){
			loadtempfile();
		}
	})
})

$(document).on('click','#addfile',function(){
	$('#id').val(btoa($.session.get('id')));
	$('#file').click();
})

$(document).on('change','#file',function(){
	var gambar=$('#file').val();
	if (gambar!="") {
		$('#submitgambar').click();
	}
})

$(document).on('change','#customSwitch1',function(){
	var usia=$.session.get('usia');
	if ($(this).is(":checked")==false) {
		if (usia<18) {
			$(this).prop('checked', true);
			alert('usia anda masih belum mencukupi');
		}
	}
})

$(document).on('keyup','#searchcatagori',function(){
	var search=$(this).val();
	if (search=='') {
		$('.floatinghastag').remove();
	}else{
		search=btoa(search);
		$.ajax({
			url:'searchcatagori',
			data:{
				q:search
			},
			method:'GET',
			success:function(data){
				$('.floatinghastag').remove();
				if (data.status=="success") {
					var get=$.session.get('selectcatagori');
					var split;
					if (get!=null) {
						var split=get.split(',');
					}
					$('#pilihancatagori').append('<div class="col-lg-11 color1 mx-auto floatinghastag"></div>');
					$.each(data.data, function( i, item ) {
						$('.floatinghastag').append('<div class="row" id="cat'+item.id+'"><div class="col-lg-12 py-1 hoverc"><b id="posttempkatagori">'+item.nama+'</b><small class="text-secondary ml-3">'+item.postingan+' post</small></div></div>');
						if ($.inArray(item.nama,split)!==-1) {
							$('#cat'+item.id).remove();
						}
					});
					$('#pilihancatagori').append('<div class="col-lg-11 color1 mx-auto floatinghastag"><div class="row"><div class="col-lg-12 py-1 hoverc" id="postcatagori">New Catagories or Tag</div></div></div>');
				}else{
					$('#pilihancatagori').append('<div class="col-lg-11 color1 mx-auto floatinghastag"><div class="row"><div class="col-lg-12 py-1 hoverc" id="postcatagori">New Catagories or Tag</div></div></div>');
				}
			}
		})
	}
})

$(document).on('click','#postcatagori',function(){
	var value=btoa($('#searchcatagori').val());
	$.ajax({
		url:'sendcatagori',
		data:{
			value:value
		},
		method:'GET',
		success:function(data){
			$('.floatinghastag').remove();
			$('#pilihancatagori').append('<div class="col-lg-11 color1 mx-auto floatinghastag"></div>');
			$.each(data.data,function(i,item){
				$('.floatinghastag').append('<div class="row" id="cat'+item.id+'><div class="col-lg-12 py-1 hoverc"><b id="posttempkatagori">'+item.nama+'</b><small class="text-secondary ml-3">'+data.data[0].postingan+' post</small></div></div>');
			})
		},error:function(data){
			$('#searchcatagori').val('');
			$('.floatinghastag').remove();
			alert('data sudah ada dalam katagori yang kamu pilih');
		}
	})
})

$(document).on('click','#posttempkatagori',function(){
	var value=$(this).html();
	var set;
	var get=$.session.get("selectcatagori");
	if (get==null) {
		set=$.session.set("selectcatagori",[[value]]);
	}else{
		set=$.session.set("selectcatagori",[[get],[value]]);
	}
	get=$.session.get("selectcatagori");
	$('#searchcatagori').val('');
	$('.floatinghastag').remove();
	checkcatagori();
})

$(document).on('click','.spancatagori',function(){
	var value=$(this).html();
	var get=$.session.get("selectcatagori");
	console.log(get);
	if (get.includes(",")) {
		get=get.split(",");
		console.log(get);
		if ($.inArray(value,get)!==-1) {
			get.splice($.inArray(value,get),1);
			$.session.set("selectcatagori",get);
		}
	}else{
		$.session.remove("selectcatagori");
	}
	checkcatagori();
})

$(document).on('submit','#postpost',function(e){
	e.preventDefault();
	$('#id_user').val(btoa($.session.get('id')));
	$('#areacatagori').val($.session.get('selectcatagori'));
	
	$.ajax({
		url:'/postpost',
		method:'POST',
		data:new FormData(this),
		dataType:'JSON',
		contentType: false,
		cache: false,
		processData: false,
		success:function(data){
			resetmodal();
			loadpost('all');
		}
	})

})

$(document).on('hidden.bs.modal','#modalpost', function (e) {
	resetmodal();
	var id=btoa($.session.get('id'));
	$.ajax({
		url:'deletetempfileall/'+id,
		method:'GET',
		success:function(){
			loadtempfile();
		}
	})
})


$(document).on('keyup','#searchforum',function(){
	var search=btoa($(this).val());
	if (search!='') {
		$('.datapost').remove();
		loadpost(search);
	}else{
		loadpost('all');
	}
})

$(document).on('click','.spandirectcatagori',function(){
	var search=$(this).html().split('#');
	loadpost(btoa(search[1]));
})

$(document).on('click','.btnjoinpost',function(){
	mustlogin();
	var id_post=$(this).attr('id');
	var id_user=$.session.get('id');
	$.ajax({
		url:'sendkontakpost',
		method:'GET',
		data:{
			id:btoa(id_post),
			id2:btoa(id_user)
		},
		success:function(data){
		}
	})
})

$(document).on('click','.btnsend',function(){
	var id=$(this).attr('id').split('x');
	var id=id[1];
	sendchat(id);
})

$(document).on('keypress',function(e){
	var code = e.keyCode || e.which;
	if (code==13) {
		var focus=$('.inputchat').is(":focus");
		if (focus) {
			var id=$('.inputchat').attr('id').split('inputchat');
			id=id[1];
			sendchat(id);	
		}
	}
})

$(document).on('click','.likepost',function(){
	mustlogin();
	var id=$(this).attr('id').split("likepost");
	id=id[1];
	var iduser=$.session.get('id');
	$.ajax({
		url:'sendlike',
		method:'GET',
		data:{
			id:btoa(id),
			id2:btoa(iduser),
			item:'post,post'
		},
		success:function(){
			loadlikesharepost(id);
		}
	})

})

$(document).on('click','.copypost',function(){
	var id = $(this).attr('id').split('copypost');
	id=id[1];
	link="http://localhost:8080/detailforum?id=load"+btoa(id);
	$('body').append('<input type="text" id="copy" value="'+link+'">');
	var copy=$('#copy');
	copy.select();
	document.execCommand("copy");
	alert("Copied");
	$('#copy').remove();
})

$(document).on('click','.pagination',function(){
	var id=$(this).attr('id');
	$.session.set('pagination',id);
	pagination();
})