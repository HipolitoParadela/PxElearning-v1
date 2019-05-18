<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_modulo_usuarios extends CI_Migration
{

        public function up()
        {
                $this->dbforge->add_field(array(
                        'Id' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'Usuario_seguimiento_id' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                        ),
                        'Fecha' => array(
                                'type' => 'DATE'
                        ),
                        'URL_imagen' => array(
                                'type' => 'varchar',
                                'null' => TRUE,
                        ),
                        'Descripcion' => array(
                                'type' => 'TEXT',
                                'constraint' => 100,
                        ),
                        'Usuario_id' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                        ),
                        'Visible' => array(
                                'type' => 'TINYINT',
                                'constraint' => 1,
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('Id', TRUE);
                $this->dbforge->create_table('tbl_usuarios_seguimiento');
        }

        public function down()
        {
                $this->dbforge->drop_table('tbl_usuarios_seguimiento');
        }

        /* 'blog_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
        ), */
}
