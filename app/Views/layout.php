<!DOCTYPE html>
<html lang="en">
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

	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/flags.css">

<body class="bg-light">
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: white;position: fixed;top: 0px;width: 100%;z-index: 2;">
	  <a class="navbar-brand" href="#">Together</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link pagination" id="home" href="/">Home</a>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link" href="#" id="forum" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Forum
	        </a>
	        <div class="dropdown-menu" aria-labelledby="forum">
	          <a class="dropdown-item pl-2 pagination" id="pforum" href="#">Public Forum</a>
	          <a class="dropdown-item pl-2 pagination" id="mforum" href="#">My Forum</a>
	        </div>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link pagination" id="community" href="#">Community</a>
	      </li>
	    </ul>
	    <div class="ml-auto dropleft px-3" id="usernamedropdown">
	    	<span class="ml-auto dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="username" style="display: none;"></span>
		    <div class="dropdown-menu">
			    <a class="dropdown-item" href="/profil">
			    	<i class="icon material-icons">person</i>
			    	Profile
			    </a>
			    <a class="dropdown-item" href="#">
			    	<i class="icon material-icons">settings</i>
			    	Settings
			    </a>
			    <a class="dropdown-item text-danger" href="#" id="logout">
			    	<i class="icon material-icons">logout</i>
			    	Logout
			    </a>
			  </div>
	    </div>
	    <div class="g-signin2 ml-auto" data-onsuccess="onSignIn" id="btnlogin"></div>
	  </div>
	</nav>
	<div style="margin-top: 60px;">
		
		<div id="alert" class="container-fluid my-2"></div>

		<?= $this->renderSection('home') ?>
		<?= $this->renderSection('forum') ?>
		<?= $this->renderSection('profil') ?>
		<?= $this->renderSection('detailforum') ?>
	</div>

	<script src="/js/forum.js"></script>
	<script src="/js/detailforum.js"></script>
	<script src="/js/profile.js"></script>
	<script src="/js/jquery.md5.js"></script>
	<script src="/js/jquery.flagstrap.min.js"></script>
	<script src="/js/jquery.flagstrap.js"></script>
	<script src="https://apis.google.com/js/platform.js?" async defer></script>
	<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
	<script src="/js/pushercontrol.js"></script>
	<script src="/js/jquery.session.js"></script>


</body>
</html>
