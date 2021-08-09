<?php

namespace App\Models;

use CodeIgniter\Model;

class Tempfile extends Model
{
	protected $table                = 'tempfile';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $useSoftDeletes        = true;
	protected $allowedFields        = ['id_user','image','video','others','updated_at','deleted_at'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
}
