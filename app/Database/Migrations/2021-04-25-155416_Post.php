<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Post extends Migration
{
	public function up()
	{
		$this->forge->addField([
	            'id'          => [
                    'type'           =>'BIGINT',
                    'unsigned'       => true,
                    'auto_increment' => true,
	            ],
	            'id_user'       => [
                    'type'       => 'BIGINT',
	            ],
	            'judul'       => [
                    'type'       => 'TEXT',
	            ],
	            'konten'       => [
                    'type'       => 'TEXT',
	            ],
	            'catagories'       => [
                    'type'       => 'TEXT',
                    'null'	=>true,
	            ],
	            'proteksi'       => [
                    'type'       => 'BOOLEAN',
	            ],
	            'negara'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
	            ],

	            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            
	            'deleted_at TIMESTAMP NULL',
	        ]);
	    $this->forge->addKey('id', true);
	    $this->forge->addForeignKey('id_user','users','id');
	    $this->forge->createTable('post');
	}

	public function down()
	{
		$this->forge->dropTable('post');
	}
}
