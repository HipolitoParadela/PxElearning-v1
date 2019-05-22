<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_modulo_cursos extends CI_Migration
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
            'Categoria_id' => array(
                'type' => 'INT',
                'constraint' => 2,
            ),
            'Titulo_curso' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'Duracion' => array(
                'type' => 'INT',
                'constraint' => 2,
            ),
            'Descripcion_corta' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'Objetivos_curso' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'Descripcion_larga' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'Info_privada' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'Costo_normal' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'Costo_promocional' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ),
            'Info_promocional' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'Imagen' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'Video_youtube' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'Fecha_ult_actualizacion_curso' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'Fecha__actualizacion_modulos' => array(
                'type' => 'DATE',
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
        $this->dbforge->create_table('tbl_cursos');

        /// tbl_cursos_modulos - tabla donde se registran los modulos de los cursos creados
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Curso_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'Titulo_modulo' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'Descripcion_modulo' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'Contenido_html' => array(
                'type' => 'LONGTEXT',
                'null' => TRUE,
            ),
            'Imagen' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'Archivo_pdf' => array(
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
        $this->dbforge->create_table('tbl_cursos_modulos');

        /// tbl_cursos_categorias - tabla donde se registran los modulos de los cursos creados
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Nombre_categoria' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'Descripcion' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'Visible' => array(
                'type' => 'INT',
                'constraint' => 1,
            ),

        ));
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table('tbl_cursos_categorias');

        /// tbl_cursos_examen - tabla donde se registran los examenes de los modulos de los cursos creados
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Curso_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'Modulo_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'Titulo_examen' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'Descripcion_examen' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'Contenido_html' => array(
                'type' => 'LONGTEXT',
                'null' => TRUE,
            ),
            'Imagen' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'Archivo_pdf' => array(
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
        $this->dbforge->create_table('tbl_cursos_examen');

        /// tbl_cursos_alumnos - tabla donde se vinculas los alumnos a los cursos creados
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Curso_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'Profesor_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'Alumno_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'Fecha_inicio' => array(
                'type' => 'DATE'
            ),
            'Fecha_finalizacion' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'Estado' => array(
                'type' => 'INT',
                'constraint' => 1
            ),
            'Nota_final' => array(
                'type' => 'INT',
                'constraint' => 2,
                'null' => TRUE,
            ),
            'Monto_abonado' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ),
            'Archivo_pdf' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'Observaciones' => array(
                'type' => 'TEXT',
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
        $this->dbforge->create_table('tbl_cursos_alumnos');

        /// tbl_cursos_examen_alumno - tabla donde se registran los resultados de los examenes de los modulos de los cursos creados
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Examen_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'Fecha_habilitado' => array(
                'type' => 'DATE'
            ),
            'Fecha_realizado' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'Fecha_corregido' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'Respuesta_html' => array(
                'type' => 'LONGTEXT',
                'null' => TRUE,
            ),


            'Archivo_pdf' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'Estado' => array(
                'type' => 'INT',
                'constraint' => 1,
            ),
            'Nota' => array(
                'type' => 'INT',
                'constraint' => 2,
                'null' => TRUE,
            ),


            'Observaciones' => array(
                'type' => 'TEXT',
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
        $this->dbforge->create_table('tbl_cursos_examen_alumno');

        /// tbl_cursos_alumnos_seguimiento - tabla donde se lleva un seguimiento del alumno en cada curso
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
            'Curso_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'Fecha' => array(
                'type' => 'DATE'
            ),
            'URL_imagen' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
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
        $this->dbforge->create_table('tbl_cursos_alumnos_seguimiento');

        /// tbl_mensajes - mensajes entre profesores y alumnos
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Emisor_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'Receptor_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'Fecha_envio' => array(
                'type' => 'DATE'
            ),
            'Fecha_leido' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'URL_adjunto' => array(
                'type' => 'varchar',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'Contenido' => array(
                'type' => 'TEXT',
                'constraint' => 100,
            ),
            'Visible' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table('tbl_mensajes');

        /// tbl_cursos_seguimiento - mensajes entre profesores y alumnos
        $this->dbforge->add_field(array(
            'Id' => array(
                    'type' => 'INT',
                    'constraint' => 10,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
            ),
            'Curso_seguimiento_id' => array(
                    'type' => 'INT',
                    'constraint' => 10,
            ),
            'Fecha' => array(
                    'type' => 'DATE'
            ),
            'Url_archivo' => array(
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
    $this->dbforge->create_table('tbl_cursos_seguimiento');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_cursos');
        $this->dbforge->drop_table('tbl_cursos_categorias');
        $this->dbforge->drop_table('tbl_cursos_modulos');
        $this->dbforge->drop_table('tbl_cursos_examen');
        $this->dbforge->drop_table('tbl_cursos_alumnos');
        $this->dbforge->drop_table('tbl_cursos_examen_alumno');
        $this->dbforge->drop_table('tbl_cursos_alumnos_seguimiento');
        $this->dbforge->drop_table('tbl_mensajes');
    }
}
