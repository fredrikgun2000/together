<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Together</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	<meta name="google-signin-client_id" content="928345900516-ec3o0v4hkdfedlk4u7ridiv8jabigbb5.apps.googleusercontent.com">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" type="text/css" href="/css/flags.css">

	<script src="/js/register.js"></script>
</head>
<body class="bg-light">
<div id="alert" class="container-fluid my-2"></div>
<div class="container-fluid">
	<div class="row">
		<form class="col-lg-4 mt-5" style="background-color: white;margin: auto;" method="POST" id="postuser">
			<?= csrf_field(); ?>
			<input type="hidden" name="id" value="<?= $_GET['id']; ?>">
			<input type="hidden" name="email" value="<?= $_GET['email']; ?>">
			<input type="hidden" name="nama" value="<?= $_GET['nama']; ?>">
			<div class="row">
				<div class="col-lg-12 py-2">
					<small>
						kamu belum punya akun di <b class="text-primary">Together</b>.
						Silahkan lengkapi data dibawah ini untuk memproses akunmu.
					</small>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<label>Negara Asal</label>
				</div>
			</div>
			<div class="row mb-1">
				<div class="col-lg-12">
					<span id="country_regis" class="color1 ml-auto"></span>
					<input type="hidden" name="negara" id="negara">
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-lg-12">
					<label>Usia Anda</label>
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-lg-12">
					<input type="number" name="usia" class="form-control" min="1">
				</div>
			</div>
			<div class="row my-3">
				<div class="col-lg-12">
					<button class="btn btn-secondary" id="logout">Back</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>


<script src="/js/jquery.flagstrap.min.js"></script>
<script src="/js/jquery.flagstrap.js"></script>
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
</body>
</html>