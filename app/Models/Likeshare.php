<?php

namespace App\Models;

use CodeIgniter\Model;

class Likeshare extends Model
{
	protected $table                = 'likeshare';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $useSoftDeletes        = true;
	protected $allowedFields        = ['id_item','id_user','item'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

}
