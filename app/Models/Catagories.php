<?php

namespace App\Models;

use CodeIgniter\Model;

class Catagories extends Model
{
	protected $table                = 'catagories';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $useSoftDeletes        = true;
	protected $allowedFields        = ['nama','postingan','updated_at','deleted_at'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
}
