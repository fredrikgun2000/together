<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\I18n\Time;
use Pusher;
use App\Models\Users;
use App\Models\Status;
use App\Models\Datauser;
use App\Models\Catagories;
use App\Models\Tempfile;
use App\Models\File;
use App\Models\Post;
use App\Models\Kontakpost;
use App\Models\Chatpost;
use App\Models\Likeshare;

class Home extends BaseController
{
	//library
	protected $session=null;
	//model
	protected $modeluser=null;
	protected $modelstatus=null;
	protected $modeldatauser=null;
	protected $modelcatagories=null;
	protected $modeltempfile=null;
	protected $modelfile=null;
	protected $modelpost=null;
	protected $modelkontakpost=null;
	protected $modelchatpost=null;
	protected $modellikeshare=null;

	public function __construct()
	{
		helper('filesystem');
		date_default_timezone_set("Asia/Bangkok");
		$this->session=\Config\Services::session();
		$this->modeluser=new Users();
		$this->modelstatus=new Status();
		$this->modeldatauser=new Datauser();
		$this->modelcatagories=new Catagories();
		$this->modeltempfile=new Tempfile();
		$this->modelfile=new File();
		$this->modelpost=new Post();
		$this->modelkontakpost=new Kontakpost();
		$this->modelchatpost=new Chatpost();
		$this->modellikeshare=new Likeshare();
	}  

	public function indexHome()
	{
		return view('home/index');
	}

	public function indexForum()
	{
		return view('forum/index');
	}

	public function indexRegister()
	{
		return view('register/index');
	}

	public function indexProfil()
	{
		return view('profil/index');
	}

	public function indexDetailforum()
	{
		return view('forum/detailforum');
	}

	public function test()
	{

		$this->Pusherfunction();
	}

	public function checkUser()
	{
		$idgoogle_enc=$this->request->getVar('id');
		$emailgoogle_enc=$this->request->getVar('email');
		$namagoogle_enc=$this->request->getVar('nama');
		$idgoogle=base64_decode($idgoogle_enc);
		$check=$this->modeluser->where('idgoogle',$idgoogle)->first();
		if ($check) {
			$id=$check['id'];
			$this->checkLogin($id,"login","t");
			$api=array(
				"data"=>"data ditemukan.",
				"status"=>"success",
			);
			return $this->response->setJson($api);
		}else{
			$api=array(
				"data"=>array(
					"id"=>$idgoogle_enc,
					"email"=>$emailgoogle_enc,
					"nama"=>$namagoogle_enc,
				)

			);
			return $this->response->setJson($api)->setStatusCode(500);
		}
	}

	public function checkLogin($id,$action,$status)
	{
		$check=$this->modelstatus->where('id_user',$id)->orderBy('id',"desc")->first();
		if ($check) {
			if ($check['action']=="login" && $action=="login") {
				return;
			}else{
				$data=array(
						"status"=>'f'
					);
					$this->modelstatus->set($data)->where("id_user",$id)->update();
				$data=array(
					"id_user"=>$id,
					"action"=>$action,
					"status"=>$status
				);
			$this->OnlineBindfunction($data);
			}
		}else{
			$data=array(
				"id_user"=>$id,
				"action"=>$action,
				"status"=>"t"
			);
			$this->OnlineBindfunction($data);
		}
	}

	public function loadOnline()
	{
		$push=$this->modelstatus->join('datauser','datauser.id_user = status.id_user')->join('users','users.id = status.id_user')->where('status.status',true)->findAll();
			foreach ($push as $key) {
				$datapusher[]=$key;
			}
			$api=array(
				"data"=>$datapusher,
				"status"=>"success",
			);
			return $this->response->setJson($api);
	}

	public function OnlineBindfunction($data)
	{	
		$options = array(
		'cluster' => 'ap1',
		'useTLS' => true
		);
		$pusher = new Pusher\Pusher(
		'4b4340bbf5e9d9541a6b',
		'9e81cd3e808c947b8980',
		'1193057',
		$options
		);
		if ($this->modelstatus->save($data)) {
			$pusher->trigger('my-channel', 'onlinebind', 'sukses');
		}
	}

	public function MemberPostBindfunction($data)
	{
		$options = array(
		'cluster' => 'ap1',
		'useTLS' => true
		);
		$pusher = new Pusher\Pusher(
		'4b4340bbf5e9d9541a6b',
		'9e81cd3e808c947b8980',
		'1193057',
		$options
		);
		if ($this->modelkontakpost->save($data)) {
			$pusher->trigger('my-channel', 'memberpostbind', $data);
		}
	}

	public function ChatPostBindfunction($data)
	{
		$options = array(
		'cluster' => 'ap1',
		'useTLS' => true
		);
		$pusher = new Pusher\Pusher(
		'4b4340bbf5e9d9541a6b',
		'9e81cd3e808c947b8980',
		'1193057',
		$options
		);
		if ($this->modelchatpost->save($data)) {
			$pusher->trigger('my-channel', 'chatpostbind', $data);
		}
	}

	public function loadProfil()
	{
		$idgoogle_enc=$this->request->getVar('id');
		$idgoogle=base64_decode($idgoogle_enc);
		$check=$this->modeluser->join('datauser','datauser.id_user = users.id')->where('users.idgoogle',$idgoogle)->first();
		$api=array(
			"data"=>[
				"id"=>$check['id'],
				"idgoogle"=>$check['idgoogle'],
				"nama"=>$check['nama'],
				"email"=>$check['email'],
				"negara"=>$check['negara'],
				"usia"=>$check['usia'],
				"pekerjaan"=>$check['pekerjaan'],
				"foto"=>$check['foto'],
				"status"=>$check['status'],
			],
			"status"=>"success"
		);
		return $this->response->setJson($api);
	}

	public function loadtempFile()
	{
		$id=base64_decode($this->request->getVar('id'));
		$check=$this->modeltempfile->where('id_user',$id)->findAll();
		$data=[];
		foreach ($check as $d) {
			$data[]=array(
				"id"=>$d['id'],
				"image"=>$d['image'],
				"video"=>$d['video'],
				"others"=>$d['others'],
			);
		}
		$api=array(
			"data"=>$data,
			"status"=>"success"
		);
		return $this->response->setJson($api);;
	}

	public function loadPost($params)
	{
		if ($params=='all') {
			$check=$this->modelpost->orderBy('id','DESC')->findAll();
		}else if(strpos($params, 'load')!==false){
			$params=explode('load', $params);
			$params=base64_decode($params[1]);
			$check=$this->modelpost->where('id',$params)->findAll();
		}else{
			$search=base64_decode($params);
			$search=strtolower($search);
			$check=$this->modelpost->like('LOWER(catagories)',$search)->orlike('LOWER(judul)',$search)->orlike('LOWER(negara)',$search)->orderBy('id','DESC')->findAll();
		}
		$data=[];
		foreach ($check as $d) {
			$check2=$this->modeluser->where('id',$d['id_user'])->first();
			$check3=$this->modeldatauser->where('id_user',$d['id_user'])->first();
			$check4=$this->modelfile->where('id_post',$d['id'])->findAll();
			$check5=$this->modellikeshare->where('id_item',$d['id'])->countAllResults();
			$data2=[];
			foreach ($check4 as $d2) {
				$data2[]=array(
					"image"=>$d2['image'],
					"video"=>$d2['video'],
					"others"=>$d2['others'],
				);
			}
			$katagori=explode(",", $d['catagories']);
			$katagoris=[];
			foreach ($katagori as $k) {
				$katagoris[]=array(
					"katagoris"=>$k
				);
			}

			$data[]=array(
				"id"=>$d['id'],
				"id_user"=>$d['id_user'],
				"judul"=>$d['judul'],
				"konten"=>$d['konten'],
				"catagories"=>$katagoris,
				"proteksi"=>$d['proteksi'],
				"negara"=>$d['negara'],
				"updated_at"=>$d['updated_at'],
				"file"=>$data2,
				"nama"=>$check2['nama'],
				"foto"=>$check3['foto'],
				"negara"=>$check2['negara'],
				"total_like"=>$check5
			);
		}
		$api=array(
			"data"=>$data,
			"status"=>"success"
		);
		return $this->response->setJson($api);
	}

	public function loadkontakPost($params)
	{
		$params=base64_decode($params);
		if ($params=='all') {
			
		}else{
			$check=$this->modelkontakpost->where('id_post',$params)->findAll();
			$check2=$this->modelkontakpost->where('id_post',$params)->countAllResults();
			$data=[];
			foreach ($check as $d) {
				$data[]=array(
					"id"=>$d['id'],
					"id_post"=>$d['id_post'],
					"id_user"=>$d['id_user'],
					"count_member"=>$check2
				);
			}
			$api=array(
				"data"=>$data,
				"status"=>"success",
			);
			return $this->response->setJson($api);
		}
	}

	public function deletetempFile()
	{
		$id=base64_decode($this->request->getVar('id'));
		$this->modeltempfile->delete($id);
		$api=array(
			"data"=>"data telah dihapus",
			"status"=>"success"
		);
		return $this->response->setJson($api);
	}

	public function loadchatPost()
	{
		$id_post=base64_decode($this->request->getVar('id'));
		$check=$this->modelchatpost->join('datauser','datauser.id_user = chatpost.id_user')->join('users','users.id = chatpost.id_user')->where('id_post',$id_post)->orderBy('chatpost.id','DESC')->findAll();
		$data=[];
		foreach ($check as $d) {
			$data[]=array(
				"id_post"=>$d['id_post'],
				"id_user"=>$d['id_user'],
				"chat"=>$d['chat'],
				"like"=>$d['like'],
				"nama"=>$d['nama'],
				"foto"=>$d['foto'],
			);
		}
		$check2=$this->modelchatpost->where('id_post',$id_post)->countAllResults();
		$api=array(
			"data"=>$data,
			"count_chat"=>$check2,
			"status"=>"success"
		);
		return $this->response->setJson($api);
	}

	public function loadProteksi()
	{
		$data = file_get_contents('D:\xampp\htdocs\together\public\assets\file\proteksi.txt');
		$data=explode(PHP_EOL, $data);
		$api=array(
			"data"=>$data,
			"status"=>"success"
		);
		return $this->response->setJson($api);
	}

	public function loadLike()
	{
		$id=base64_decode($this->request->getVar('id'));
		$id2=base64_decode($this->request->getVar('id2'));
		$item=$this->request->getVar('item');
		$check=$this->modellikeshare->where(['id_item'=>$id,'item'=>$item])->countAllResults();
		$check2=$this->modellikeshare->where(['id_item'=>$id,'id_user'=>$id2,'item'=>$item])->first();
		$status='';
		if ($check2) {
			$status=$check2['id'];
		}
		$data=array(
			"total_like"=>$check,
			"status"=>$status,
		);

		$api=array(
			"data"=>$data,
			"status"=>"success"
		);
		return $this->response->setJson($api);
	}
	// public function Pusherfunction()
	// {
	// 	$options = array(
	// 	'cluster' => 'ap1',
	// 	'useTLS' => true
	// 	);
	// 	$pusher = new Pusher\Pusher(
	// 	'4b4340bbf5e9d9541a6b',
	// 	'9e81cd3e808c947b8980',
	// 	'1193057',
	// 	$options
	// 	);
	// 	return $pusher;
	// }

	public function searchCatagori()
	{
		$q=$this->request->getVar('q');	
		$search=base64_decode($q);
		$check=$this->modelcatagories->like('LOWER(nama)',$search)->orderBy('postingan','DESC')->findAll();
		if ($check) {
			$data=[];
			foreach ($check as $d) {
				$data[]=array(
					"nama"=>$d['nama'],
					"postingan"=>$d['postingan'],
				);
			}
			$api=array(
				"data"=>$data,
				"status"=>"success",
			);
		}else{
			$api=array(
				"data"=>"data tidak ditemukan",
				"status"=>"insert",
			);
		}
			return $this->response->setJson($api);
	}	

	public function sendCatagori()
	{
		$value=base64_decode($this->request->getVar('value'));
		$data=array(
			"nama"=>$value
		);
		$check=$this->modelcatagories->where('nama',$value)->first();
		if ($check) {
			$api=array(
				"data"=>"data sudah dipilih",
				"status"=>"insert"
			);
			return $this->response->setJson($api)->setStatusCode(411);
		}else{
			$this->modelcatagories->save($data);
		}
		$check=$this->modelcatagories->like('nama',$value)->orderBy('id','DESC')->findAll();
		if ($check) {
			$data=[];
			foreach ($check as $d) {
				$data[]=array(
					"nama"=>$d['nama'],
					"postingan"=>$d['postingan'],
				);
			}
			$api=array(
				"data"=>$data,
				"status"=>"success",
			);
		}else{
			$api=array(
				"data"=>"data tidak ditemukan",
				"status"=>"insert",
			);
		}
		return $this->response->setJson($api);
	}

	public function sendkontakPost()
	{
		$id_post=base64_decode($this->request->getVar('id'));
		$id_user=base64_decode($this->request->getVar('id2'));
		$data=array(
			"id_post"=>$id_post,
			"id_user"=>$id_user,
		);
		$check=$this->modelkontakpost->where($data)->first();
		if (!$check) {
			$this->MemberPostBindfunction($data);
		}
		$api=array(
			"data"=>"data berhasil disimpan",
			"status"=>"success"
		);
		return $this->response->setJson($api);
	}

	public function sendchatPost()
	{
		$id_post=base64_decode($this->request->getVar('id'));
		$id_user=base64_decode($this->request->getVar('id2'));
		$chat=base64_decode($this->request->getVar('chat'));
		$data=array(
			"id_post"=>$id_post,
			"id_user"=>$id_user,
			"chat"=>$chat,
		);
		$this->ChatPostBindfunction($data);
	}

	public function sendLike()
	{
		$id=base64_decode($this->request->getVar('id'));
		$id_user=base64_decode($this->request->getVar('id2'));
		$item=$this->request->getVar('item');
		$data=array(
			"id_item"=>$id,
			"id_user"=>$id_user,
			"item"=>$item,
		);
		$check=$this->modellikeshare->where($data)->first();
		if (!$check) {
			$this->modellikeshare->save($data);
		}else{
			$this->modellikeshare->where($data)->delete();
		}
		$api=array(
			"data"=>"data terorganisir",
			"status"=>"success",
		);
		return $this->response->setJson($api);

	}

	public function sendProteksi()
	{
		    if ( ! write_file('D:\xampp\htdocs\together\public\assets\file\proteksi.txt', $data))
		    {
		            echo 'Unable to write the file';
		    }
		    else
		    {
		            echo 'File written!';
		    }
	}

	public function logout($id)
	{
		$id=base64_decode($id);
		$check=$this->modeluser->where('id',$id)->first();
		$id=$check['id'];
		$this->checkLogin($id,"logout","f");
		return redirect()->to('/');
	}

	public function deletetempFileall($id)
	{
		$id=base64_decode($id);
		$this->modeltempfile->where('id_user',$id)->delete();
	}

	//post
	public function insertUser()
	{
		$negara=$this->request->getVar('negara');
		$usia=$this->request->getVar('usia');
		$idgoogle_enc=$this->request->getVar('id');
		$emailgoogle_enc=$this->request->getVar('email');
		$namagoogle_enc=$this->request->getVar('nama');
		$idgoogle=base64_decode($idgoogle_enc);
		$emailgoogle=base64_decode($emailgoogle_enc);
		$namagoogle=base64_decode($namagoogle_enc);

		$data=array(
			"idgoogle"=>$idgoogle,
			"nama"=>$namagoogle,
			"email"=>$emailgoogle,
			"negara"=>$negara,
			"usia"=>$usia,
			"status"=>"aktif",
		);

		if ($this->modeluser->save($data)===false) {
			return $this->response->setJson($this->modeluser->errors())->setStatusCode(411);
		}

		$check=$this->modeluser->where($data)->first();
		$data=array(
			"id_user"=>$check['id'],
		);

		if ($this->modeldatauser->save($data)===false) {
			return $this->response->setJson($this->modeldatauser->errors())->setStatusCode(411);
			
		}
		$api=array(
			"data"=>"data berhasil disimpan.",
			"status"=>"success"
		);
		return $this->response->setJson($api);
	}

	public function insertGambar()
	{
		$file=$this->request->getFile('file');
		$id_enc=$this->request->getVar('id');
		$id=base64_decode($id_enc);
		$ext=strtolower($file->guessExtension());

		$filename=$file->getName();
		$arrayimage=["jpg","png","tif","tiff","jpeg","gif"];
		$arrayvideo=["webm","mkv","avi","mov","wmv","mp4","m4p"];
	
		if (in_array($ext, $arrayimage)) {
			if (file_exists("assets/data/img/".$filename)) {

			}else{
				$file->move('assets/data/img');
			}
			$data=array(
				"id_user"=>$id,
				"image"=>$filename,
			);
		}else if (in_array($ext, $arrayvideo)) {
			if (file_exists("assets/data/video/".$filename)) {

			}else{
				$file->move('assets/data/video');
			}
			$data=array(
				"id_user"=>$id,
				"video"=>$filename,
			);
		}else{
			if (file_exists("assets/data/others/".$filename)) {

			}else{
				$file->move('assets/data/others');
			}
			$data=array(
				"id_user"=>$id,
				"others"=>$filename,
			);
		}
		$this->modeltempfile->save($data);
		$api=array(
			"data"=>"file ".$ext." berhasil dikirim",
			"status"=>"success"
		);
		return $this->response->setJson($api);

	}

	public function insertPost()
	{
		$id=base64_decode($this->request->getVar('id'));
		$judul=$this->request->getVar('judul');		  
		$konten=$this->request->getVar('konten');		  
		$catagori=$this->request->getVar('catagori');		  
		$proteksi=$this->request->getVar('proteksi');
		if ($proteksi=="on") {
			$proteksi='true';
		}else{
			$proteksi='false';
		}
		if ($catagori=='') {
			$catagori=null;
		}
		$catagoris=explode(',', $catagori);
		for ($i=0; $i <count($catagoris) ; $i++) { 
			$this->modelcatagories->set(['postingan'=>+1])->where('nama',$catagoris[$i])->update();
		}
		$check=$this->modeluser->where('id',$id)->first();
		$data=array(
			"id_user"=>$id,
			"judul"=>$judul,
			"konten"=>$konten,
			"catagories"=>$catagori,
			"proteksi"=>$proteksi,
			"negara"=>$check['negara'],
		);
		if ($this->modelpost->save($data)) {
			$check=$this->modelpost->where('id_user',$id)->orderBy('id','DESC')->first();
			$id_post=$check['id'];
			$check=$this->modeltempfile->where('id_user',$id)->findAll();
			foreach ($check as $d) {
				$data=array(
					"id_post"=>$id_post,
					"image"=>$d['image'],
					"video"=>$d['video'],
					"others"=>$d['others'],
				);
				if ($this->modelfile->save($data)) {
					$this->deletetempFileall(base64_encode($id));
				}
			}
		}
		$api=array(
			"data"=>"data telah dikirim",
			"status"=>"success",
		);
		return $this->response->setJson($api);
	}

	public function InsertChat()
	{
		$options = array(
		    'cluster' => 'ap1',
		    'useTLS' => true
		  );
		  $pusher = new Pusher\Pusher(
		    '4b4340bbf5e9d9541a6b',
		    '9e81cd3e808c947b8980',
		    '1193057',
		    $options
		  );

		  if (condition) {
		  	$pusher->trigger('my-channel', 'my-event', $data);
		  }
	}
		
}
