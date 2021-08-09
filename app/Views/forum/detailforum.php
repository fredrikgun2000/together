<?php echo $this->extend('layout'); ?>

<?php echo $this->section('detailforum'); ?>
<input type="hidden" id="pagination" value="detailforum">
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-10 mx-auto" id="datapost"></div>
	</div>
</div>
<?php echo $this->endsection(); ?>