<?= $this->extend('layout') ?>

<?= $this->section('profil') ?>
<div class="container-fluid" style="margin-top: 80px;">
	<div class="row">
		<div class="col-lg-9 color1 mx-auto" style="border-radius: 10px;">
			<div class="row">
				<div class="col-lg-2 mx-auto" id="datagambar">
					
				</div>
			</div>
			<div class="row my-2 pt-4">
				<div class="col-lg-12 text-center">
					<span class="profilactive mr-2 font-weight-bold">Personal Info</span>
					<span class="mx-2">Timeline</span>
				</div>
			</div>
			<div id="dataprofil"></div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>