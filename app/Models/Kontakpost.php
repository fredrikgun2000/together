<?php

namespace App\Models;

use CodeIgniter\Model;

class Kontakpost extends Model
{
	protected $table                = 'kontakpost';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $useSoftDeletes        = true;
	protected $allowedFields        = ['id_post','id_user'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
}
