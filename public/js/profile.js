function dataprofil() {
	var id=$.session.get('idgoogle');
	$.ajax({
		url:'loadprofil',
		data:{
			id:id,
		},
		method:'GET',
		success:function(data){
			$.session.set('id',data.data.id);
			$.session.set('usia',data.data.usia);
			$('#dataprofil').append('<div class="row"><div class="col-lg-12"><div class="row my-2"><div class="col-lg-6"><div class="row"><div class="col-lg-12">Id</div></div><div class="row"><div class="col-lg-12 pl-4"><small>'+data.data.idgoogle+'</small></div></div></div><div class="col-lg-6"><div class="row"><div class="col-lg-12">Nama Pengguna</div></div><div class="row"><div class="col-lg-12 pl-4"><small>'+data.data.nama+'</small></div></div></div></div><div class="row my-2"><div class="col-lg-6"><div class="row"><div class="col-lg-12">Email</div></div><div class="row"><div class="col-lg-12 pl-4"><small>'+data.data.email+'</small></div></div></div><div class="col-lg-6"><div class="row"><div class="col-lg-12">Negara Asal</div></div><div class="row"><div class="col-lg-12 pl-4"><span class="flagstrap-icon flagstrap-'+(data.data.negara).toLowerCase()+'"></span><small> '+data.data.negara+'</small></div></div></div></div><div class="row my-2"><div class="col-lg-6"><div class="row"><div class="col-lg-12">Usia</div></div><div class="row"><div class="col-lg-12 pl-4"><small>'+data.data.usia+'</small></div></div></div><div class="col-lg-6"><div class="row"><div class="col-lg-12">Pekerjaan</div></div><div class="row"><div class="col-lg-12 pl-4"><small>'+data.data.pekerjaan+'</small><i class="material-icons icon">edit</i></div></div></div></div></div></div>');
			$('#datagambar').append('<img src="/assets/img/'+data.data.foto+'" style="width: 100%;border-radius: 100%;margin-top: -60px;">')
		}
	})
}
