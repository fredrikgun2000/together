<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Catagories extends Migration
{
	public function up()
	{
		$this->forge->addField([
	            'id'          => [
                    'type'           =>'BIGINT',
                    'unsigned'       => true,
                    'auto_increment' => true,
	            ],
	            'nama'       => [
                    'type'       => 'TEXT',

	            ],
	            'postingan'       => [
                    'type'       => 'TEXT',
                    'default'	=>0,
	            ],
	            
	            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'deleted_at TIMESTAMP NULL',
	        ]);
	    $this->forge->addKey('id', true);
	    $this->forge->createTable('catagories');
	}

	public function down()
	{
		$this->forge->dropTable('catagories');
	}
}
