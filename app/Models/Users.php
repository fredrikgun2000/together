<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
	protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['idgoogle','nama', 'email','negara','usia','status','updated_at','deleted_at'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

	protected $useSoftDeletes        = true;
	protected $validationRules      = [
        'negara'    =>  'required',
        'usia'    =>  'required|integer',
    ];
	protected $validationMessages   = [
        'negara'    =>[
            'required'  =>  'negara wajib diisi.'
        ],
        'usia'    =>[
            'required'  =>  'usia wajib diisi.',
            'integer'   =>  'usia harus bernilai angka bulat.'
        ]
    ];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
}
