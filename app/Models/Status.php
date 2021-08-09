<?php

namespace App\Models;

use CodeIgniter\Model;

class Status extends Model
{
	protected $table                = 'status';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $allowedFields        = ['id_user','action','status','updated_at','deleted_at'];

	// Dates
	protected $useTimestamps        = True;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	protected $useSoftDeletes        = true;
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
}
