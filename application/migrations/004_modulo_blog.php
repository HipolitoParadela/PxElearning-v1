<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_modulo_blog extends CI_Migration
{

    public function up()
    {
        /// Tbl_cursos - tabla donde se registran los cursos creados
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Titulo_curso' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'Copete' => array(
                'type' => 'TEXT',
            ),
            'Contenido' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'Imagen' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'Fecha_ult_actualizacion' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'Usuario_creador_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'Ult_usuario_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'Visible' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE,
            ),

        ));
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table('tbl_blog');

        
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_blog');
    }
}
