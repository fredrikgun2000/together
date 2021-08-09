<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kontakpost extends Migration
{
	public function up()
	{
		$this->forge->addField([
	            'id'          => [
                    'type'           =>'BIGINT',
                    'unsigned'       => true,
                    'auto_increment' => true,
	            ],
	            'id_post'       => [
                    'type'       => 'BIGINT',
	            ],
	            'id_user'       => [
                    'type'       => 'BIGINT',
	            ],
	            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'deleted_at TIMESTAMP NULL',
	        ]);
	    $this->forge->addKey('id', true);
	    $this->forge->addForeignKey('id_post','post','id');
	    $this->forge->addForeignKey('id_user','users','id');
	    $this->forge->createTable('kontakpost');
	}

	public function down()
	{
		$this->forge->dropTable('kontakpost');
	}
}
