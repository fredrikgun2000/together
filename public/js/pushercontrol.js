var pusher = new Pusher('4b4340bbf5e9d9541a6b', {
  cluster: 'ap1'
});

var channel = pusher.subscribe('my-channel');
channel.bind('onlinebind', function(data) {
	onlineready();
});

channel.bind('memberpostbind', function(data) {
	loadkontakpost(data.id_post);
});

channel.bind('chatpostbind', function(data) {
	loadchatpost(data.id_post);
});

