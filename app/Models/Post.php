<?php

namespace App\Models;

use CodeIgniter\Model;

class Post extends Model
{
	protected $table                = 'post';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $allowedFields        = ['id_user','judul','konten','catagories','proteksi','negara','updated_at','deleted_at'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
	
	protected $useSoftDeletes        = true;
	protected $validationRules      = [
		'id_user'=>'required',
		'judul'=>'required',
		'konten'=>'required',
	];
	protected $validationMessages   = [
		'id_user'	=> [
			'required'	=>	'id anda tidak ditemukan, mungkin anda belum login.'
		],
		'judul'	=> [
			'required'	=>	'judul wajib diisi.'
		],
		'konten'	=> [
			'required'	=>	'konten wajib diisi.'
		],
		
	];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

}
