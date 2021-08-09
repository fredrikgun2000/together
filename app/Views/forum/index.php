<?= $this->extend('layout') ?>

<?= $this->section('forum') ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-9">
			<div class="row mt-2 mb-3">
				<div class="col-lg-11 mx-auto">
					<input type=" text" name="" class="form-control" placeholder="You can search anything here..." id="searchforum">
				</div>
			</div>
			<div id="pagepostcommunity"></div>
		</div>
		<div class="col-lg-3 pl-2 pr-5" id="contributtion">
			<div class="row">
				<div class="col-lg-12 color1 my-2 pt-2" style="border-radius: 15px;max-height: 1500px;">
					<div class="row">
						<div class="col-lg-12">
							<small>
								<b>Contributtion</b>
							</small>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 py-2">
							<button class="form-control btn btn-primary my-1" data-toggle="modal" data-target="#modalpost" id="btnmakepost">
								make a post
							</button>
							<button class="form-control btn btn-outline-primary my-1" id="btnmakecomunity">
								make a community
							</button>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-lg-3">
							<small>
								<b>Online</b>
							</small>
						</div>
						<div class="col-lg-9 text-right">
							<span id="country" class="color1 ml-auto"></span>
						</div>
					</div>
					<div id="onlineuser">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- modal -->
<div class="modal fade" id="modalpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Make a Post</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" id="postpost">
				<?= csrf_field();?>
				<input type="hidden" name="id" id="id_user">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row my-2">
							<div class="col-lg-12">Tittle</div>
						</div>
						<div class="row my-2">
							<div class="col-lg-12">
								<input type="text" name="judul" class="form-control reset" required>
							</div>
						</div>
						<div class="row my-2">
							<div class="col-lg-12">Content</div>
						</div>
						<div class="row my-2">
							<div class="col-lg-12">
								<textarea class="form-control reset" name="konten" required></textarea>
							</div>
						</div>
						<div class="row my-2">
							<div class="col-lg-11">add your file</div>
							<div class="col-lg-1">
								<i class="material-icons icon" id="addfile">add</i>
							</div>
						</div>
						<div class="row my-1">
							<div class="col-lg-12" id="spangambar">

							</div>
						</div>
						<div class="row my-1">
							<div class="col-lg-12" id="spanvideo">

							</div>
						</div>
						<div class="row">
							<div class="col-lg-12" id="spanothers">

							</div>
						</div>
						<div class="row my-2">
							<div class="col-lg-12">Hastag/Catagories</div>
						</div>
						<div class="row my-2">
							<div class="col-lg-12">
								<input type="text" class="form-control reset" name="" id="searchcatagori" autocomplete="off">
								<textarea style="display: none;" id="areacatagori" name="catagori"></textarea>
								<div class="row">
									<div class="col-lg-12" id="spancatagori">
										<pre> </pre>
									</div>
								</div>
								<div class="row" id="pilihancatagori">

								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" id="customSwitch1" name="proteksi">
									<label class="custom-control-label" for="customSwitch1">do you want to turn your detection sensor?</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<form id="formgambar" method="POST"  style="display: none;" enctype="multipart/form-data">
	<?= csrf_field(); ?>
	<input type="hidden" name="id" id="id">
	<input type="file" name="file" id="file">
	<button type="submit" id="submitgambar"></button>		
</form>
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Image preview</h4>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>