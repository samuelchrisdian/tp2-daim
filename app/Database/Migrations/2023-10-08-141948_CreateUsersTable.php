<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => ['type' => 'INT', 'usigned' => true, 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'role_id' => ['type' => 'INT', 'usigned' => true, 'constraint' => 5, 'unsigned' => true],
            'employee_no' => ['type' => 'VARCHAR', 'constraint' => 200],
            'name' => ['type' => 'VARCHAR', 'constraint' => 200],
            'email' => ['type' => 'VARCHAR', 'constraint' => 200],
            'personal_email' => ['type' => 'VARCHAR', 'constraint' => 200],
            'password' => ['type' => 'VARCHAR', 'constraint' => 200],
            'address' => ['type' => 'VARCHAR', 'constraint' => 200],
            'status' => ['type' => 'VARCHAR', 'constraint' => 200],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addForeignKey('role_id', 'roles', 'role_id', 'NULL', 'NULL');
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropForeignKey('roles','role_id');
        $this->forge->dropTable('users');
    }
}
