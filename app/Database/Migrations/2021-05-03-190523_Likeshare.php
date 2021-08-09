<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Likeshare extends Migration
{
	public function up()
	{
		$this->forge->addField([
	            'id'          => [
                    'type'           =>'BIGINT',
                    'unsigned'       => true,
                    'auto_increment' => true,
	            ],
	            'id_item'       => [
                    'type'       => 'BIGINT',
	            ],
	            'id_user'       => [
                    'type'       => 'BIGINT',
	            ],
	            'item'       => [
                    'type'       => 'TEXT',	            
                ],
	            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'deleted_at TIMESTAMP NULL',
	        ]);
	    $this->forge->addKey('id', true);
	    $this->forge->addForeignKey('id_user','users','id');
	    $this->forge->createTable('likeshare');
	}

	public function down()
	{
		$this->forge->dropTable('likeshare');
	}
}
