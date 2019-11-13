<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cursos extends CI_Controller
{

//// CURSOS         | VISTA | LISTADO
    public function index()
    {
		if ($this->session->userdata('Login') != true) 
		{
            header("Location: " . base_url() . "login"); /// enviar a pagina de error
		} 
		else 
		{
			if ($this->session->userdata('Rol_acceso') > 2) 
			{
				$data = array(
                    "body_class" => 'class="courses-page"',
                    "div_inicial_class" => 'class="page-header"',
					"TituloPagina" => "Control de cursos",
					"Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
				);
				$this->load->view('cursos_listado',$data);
			} 
			else 
			{
                header("Location: " . base_url() . "login"); /// enviar a pagina de error
            }
        } 
    }

//// CURSOS         | VISTA | DATOS
    public function datos()
    {
        if ($this->session->userdata('Login') != true) 
        {
            header("Location: " . base_url() . "login"); /// enviar a pagina de error
        } 
        else 
        {
            if ($this->session->userdata('Rol_acceso') > 2) 
            {
                $data = array(
                    "body_class" => 'class="courses-page"',
                    "div_inicial_class" => 'class="page-header"',
					"TituloPagina" => "Control de cursos",
					"Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
				);
                $this->load->view('cursos_datos', $data);
                
            } else {
                header("Location: " . base_url() . "login"); /// enviar a pagina de error
            }
        }
    }

//// CURSOS PAGO   | VISTA | PAGO EXITOSO
    public function recibopagoexitoso()
    {
        if ($this->session->userdata('Login') != true) 
        {
            header("Location: " . base_url() . "login"); /// enviar a pagina de error
        } 
        else 
        {
            if ($this->session->userdata('Rol_acceso') > 2) 
            {
                $data = array(
                    "body_class" => 'class="courses-page"',
                    "div_inicial_class" => 'class="page-header"',
                    "TituloPagina" => "Pago exitoso",
                    "Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
                );
                $this->load->view('cursos_pagos_exitoso', $data);
                
            } else {
                header("Location: " . base_url() . "login"); /// enviar a pagina de error
            }
        }
    }

//// CURSOS PAGO   | VISTA | PAGO EN PROCESO
    public function recibopagoproceso()
    {
        if ($this->session->userdata('Login') != true) 
        {
            header("Location: " . base_url() . "login"); /// enviar a pagina de error
        } 
        else 
        {
            if ($this->session->userdata('Rol_acceso') > 2) 
            {
                $data = array(
                    "body_class" => 'class="courses-page"',
                    "div_inicial_class" => 'class="page-header"',
                    "TituloPagina" => "Pago en proceso",
                    "Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
                );
                $this->load->view('cursos_pagos_proceso', $data);
                
            } else {
                header("Location: " . base_url() . "login"); /// enviar a pagina de error
            }
        }
    }


//// CURSOS MÓDULO  | VISTA | DATOS
    public function modulo()
    {
        if ($this->session->userdata('Login') != true) 
        {
            header("Location: " . base_url() . "login"); /// enviar a pagina de error
        } 
        else 
        {
            if ($this->session->userdata('Rol_acceso') > 2) 
            {
                $data = array(
                    "body_class" => 'class="single-courses-page"',
                    "div_inicial_class" => 'class="page-header"',
                    "TituloPagina" => "Control de modulo de un curso",
                    "Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
                );
                $this->load->view('cursos_datos_modulo', $data);
                
            } else {
                header("Location: " . base_url() . "login"); /// enviar a pagina de error
            }
        }
    }

//// CURSOS CURSADO | VISTA | DATOS
    public function cursado()
    {   
        
        if ($this->session->userdata('Login') != true) 
        {
            header("Location: " . base_url() . "login"); /// enviar a pagina de error
        } 
        else 
        {
            /// REALIZO LA BUSQUEDA PRIMERO PARA PODER URGAR ALGUNOS DATOS NECESARIOS A SABER
            //Esto siempre va es para instanciar la base de datos
            $CI = &get_instance();
            $CI->load->database();

            $Id = $_GET["Id"];

            ////BUSCANDO DATOS DEL CURSO
                $this->db->select(' tbl_cursos.*,
                                    tbl_cursos.Id as Curso_id,
                                    tbl_cursos_alumnos.*');
                $this->db->from('tbl_cursos_alumnos');
                $this->db->join('tbl_cursos', 'tbl_cursos.Id = tbl_cursos_alumnos.Curso_id', 'left');
                $this->db->where('tbl_cursos_alumnos.Id', $Id);
                $query = $this->db->get();
                $result = $query->result_array();

            /// BUSCANDO DATOS DE LOS MODULOS DE ESTE CURSO
                $this->db->select('*');
                $this->db->from('tbl_cursos_modulos');
                $this->db->where('Curso_id', $result[0]["Curso_id"]);
                
                $query = $this->db->get();
                $array_modulos = $query->result_array();
                
                $Datos_modulos = array();
                
                foreach ($array_modulos as $modulo) 
                {
                        
                    $this->db->select(' Id, 
                                        Examen_id, 
                                        Estado, 
                                        Nota');
                    $this->db->from('tbl_cursos_examen_alumno');
                    $this->db->where('Curso_alumno_id', $Id); 
                    $this->db->where('Modulo_id', $modulo["Id"]);

                    $query = $this->db->get();
                    $result_modulo = $query->result_array();
                    $cant = $query->num_rows();
                        
                        if($cant > 0) 
                        { 
                            $estado = $result_modulo[0]["Estado"];
                            $info_examen = $result_modulo[0];
                        }
                        
                        else
                        {
                            $estado = 0;
                            $info_examen = null;
                        }

                    $datos_modulo = array('Datos_modulo' => $modulo, 'Estado' => $estado, 'Info_examen' => $info_examen);  

                    array_push($Datos_modulos, $datos_modulo);
                }
            
            $data = array(
                "body_class" => ' class="single-courses-page"',
                "div_inicial_class" => 'class="page-header"',
                "TituloPagina" => $result[0]["Titulo_curso"],
                "Curso" => $result[0],
                "Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
                "Modulos" => $Datos_modulos,
            );
            
            /// podrá acceder al modulo si se cumple lo siguiente
                // que este logueado
                // que tenga rol 4 o mas
                // que sea el profe a cargo
                // que sea el alumno en cuestión
            
                if ($this->session->userdata('Rol_acceso') > 3 || $this->session->userdata('Id') == $result[0]["Profesor_id"]  || $this->session->userdata('Id') == $result[0]["Alumno_id"]) 
                {
                    
                    $this->load->view('cursos_cursado', $data);
                    
                } 

                else 
                {
                    header("Location: " . base_url() . "dashboard"); /// enviar a pagina de error
                }
        }
    }


//// CURSOS INFO | VISTA | DATOS
    public function informaciondelcurso()
    {   
        
        
            /// REALIZO LA BUSQUEDA PRIMERO PARA PODER URGAR ALGUNOS DATOS NECESARIOS A SABER
            //Esto siempre va es para instanciar la base de datos
            $CI = &get_instance();
            $CI->load->database();

            $Id = $_GET["Id"];

            ////BUSCANDO DATOS DEL CURSO
            $this->db->select(' tbl_cursos.*,
                                tbl_cursos.Id as Curso_id,
                                tbl_cursos_categorias.*');
            $this->db->from('tbl_cursos');
            $this->db->join('tbl_cursos_categorias', 'tbl_cursos_categorias.Id = tbl_cursos.Categoria_id', 'left');
            $this->db->where('tbl_cursos.Id', $Id);
            $query = $this->db->get();
            $result = $query->result_array();

            /// BUSCANDO DATOS DE LOS MODULOS DE ESTE CURSO
                $this->db->select('*');
                $this->db->from('tbl_cursos_modulos');
                $this->db->where('Curso_id', $result[0]["Curso_id"]);
                
                $query = $this->db->get();
                $array_modulos = $query->result_array();
            
                $data = array(
                    "body_class" => ' class="single-courses-page"',
                    "div_inicial_class" => 'class="page-header"',
                    "TituloPagina" => $result[0]["Titulo_curso"],
                    "Imagen" => $result[0]["Imagen"],
                    "Datos_curso" => $result[0],
                    "Descripcion" => "Aprende a distancia ".$result[0]["Titulo_curso"].". " . $result[0]["Descripcion_corta"],
                    "Modulos" => $array_modulos,
                    );

                $this->load->view('info_curso', $data);
    }

//// CURSOS INFO LISTADOS | VISTA | DATOS
    public function listado()
    {   
        
        
            /// REALIZO LA BUSQUEDA PRIMERO PARA PODER URGAR ALGUNOS DATOS NECESARIOS A SABER
            //Esto siempre va es para instanciar la base de datos
            $CI = &get_instance();
            $CI->load->database();

            $Categoria_id = 0;
            
            if(isset($_GET["Id"]))
            {
                $Categoria_id = $_GET["Id"];
            }


            ////BUSCANDO DATOS DEL CURSO
            $this->db->select(' tbl_cursos.*,
            tbl_cursos_categorias.*');
            $this->db->from('tbl_cursos');
            $this->db->join('tbl_cursos_categorias', 'tbl_cursos_categorias.Id = tbl_cursos.Categoria_id', 'left');
            
            if($Categoria_id > 0) { $this->db->where('tbl_cursos.Categoria_id', $Categoria_id); }

            $query = $this->db->get();
            $result = $query->result_array();

    
            
                $data = array(
                    "body_class" => ' class="single-courses-page"',
                    "div_inicial_class" => 'class="page-header"',
                    "TituloPagina" => "Formate con nuestros cursos online",
                    "Listado_cursos" => $result,
                    "Descripcion" => "Aprende a distancia, cursos con certifición nacional. Computación, desarrollo web, diseño gráfico, programación, oficina, y muchos más.",
                    );

                $this->load->view('info_listado_cursos', $data);
    }

//// CURSOS CURSADO MODULO | VISTA | DATOS
    public function cursado_modulo()
    {
        if ($this->session->userdata('Login') != true) 
        {
            header("Location: " . base_url() . "login"); /// enviar a pagina de error
        } 
        else 
        {
            if ($this->session->userdata('Rol_acceso') > 1) 
            {
                
                //Esto siempre va es para instanciar la base de datos
                $CI = &get_instance();
                $CI->load->database();

                ////BUSCANDO DATOS DEL EXAMEN, MODULO, CURSO
                    // mostrar info del modulo, del examen, y luego de otras cosas, pero esos son los que necesitaria en PHP
                    $Id = $_GET["Id"];

                    $this->db->select(' tbl_cursos_examen.*,
                                        tbl_cursos_examen.Id as Examen_id,
                                        tbl_cursos_examen.Contenido_html as Contenido_html_examen,
                                        tbl_cursos_examen.Url_archivo as Url_archivo_examen,
                                        tbl_cursos_modulos.*,
                                        tbl_cursos_modulos.Id as Modulo_id,
                                        tbl_cursos_modulos.Imagen as Imagen_modulo,
                                        tbl_cursos_modulos.Url_archivo as Url_archivo_modulo,
                                        tbl_cursos_modulos.Contenido_html as Contenido_html_modulo,
                                        tbl_cursos_examen_alumno.*,
                                        tbl_cursos_examen_alumno.Id as Examen_alumno_id'); // BUSCAR SOLO DATOS NECESARIOS

                    $this->db->from('tbl_cursos_examen_alumno');

                    $this->db->join('tbl_cursos_examen', 'tbl_cursos_examen.Id = tbl_cursos_examen_alumno.Examen_id', 'left');
                    $this->db->join('tbl_cursos_modulos', 'tbl_cursos_modulos.Id = tbl_cursos_examen_alumno.Modulo_id', 'left');

                    $this->db->where('tbl_cursos_examen_alumno.Id', $Id);

                    $query = $this->db->get();
                    $result = $query->result_array();
                    
                
                $data = array(
                    "body_class" => 'class="single-courses-page"',
                    "div_inicial_class" => '',
                    "TituloPagina" => $result[0]["Titulo_modulo"],
                    "Descripcion" => $result[0]["Descripcion_modulo"],
                    "Datos" => $result[0],
                    
                );
                $this->load->view('cursos_cursado_modulo', $data);
                
            } 
            else 
            {
                header("Location: " . base_url() . "login"); /// enviar a pagina de error
            }
        }
    }

//// CURSOS	        | OBTENER LISTADO PRINCIPAL
	public function obtener_listado_principal()
    {
			
        //Esto siempre va es para instanciar la base de datos
        $CI =& get_instance();
        $CI->load->database();
		//Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) { exit("No coinciden los token"); }
        
        
        //$estado = $_GET["estado"];
        $estado = 1;

        $Categoria_id = $this->datosObtenidos->Filtro_1;
        //$puesto = $_GET["puesto"];

        $this->db->select('	tbl_cursos.Id,
                            tbl_cursos.Titulo_curso as Nombre_principal,
                            tbl_cursos.Duracion,
                            tbl_cursos.Costo_normal,
                            tbl_cursos.Imagen,
                            tbl_cursos.Categoria_id,
                            tbl_cursos.Fecha_ult_actualizacion_curso,
                            tbl_cursos.Descripcion_corta,
                            tbl_cursos.Costo_promocional,
                            tbl_cursos_categorias.Nombre_categoria,');
		$this->db->from('tbl_cursos');
        
        $this->db->join('tbl_cursos_categorias', 'tbl_cursos_categorias.Id = tbl_cursos.Categoria_id','left');

        if($Categoria_id > 0) { $this->db->where('tbl_cursos.Categoria_id', $Categoria_id); }
        
        // SI ES PROFESOR, SOLO PUEDE VER LOS CURSOS CREADOS POR ÉL
        if($this->session->userdata('Rol_acceso') < 4 )
        {
            $this->db->where('tbl_cursos.Usuario_creador_id', $this->session->userdata('Id'));
        }

		$this->db->order_by("tbl_cursos.Titulo_curso", "asc");
        $query = $this->db->get();
		$result = $query->result_array();

		echo json_encode($result);
		
    }

//// CURSOS	        | CARGAR O EDITAR
    public function crear_curso()
    {
        $CI =& get_instance();
        $CI->load->database();
        
        /// SEGURIDAD
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {  exit("No coinciden los token"); }

        $Id = null;
        if(isset($this->datosObtenidos->Datos->Id))
        {
            $Id = $this->datosObtenidos->Datos->Id;
        }
        
        $Categoria_id =         (isset($this->datosObtenidos->Datos->Categoria_id)) ? $this->datosObtenidos->Datos->Categoria_id : null;
        $Nombre_principal =         (isset($this->datosObtenidos->Datos->Nombre_principal)) ? $this->datosObtenidos->Datos->Nombre_principal : null;
        $Duracion =             (isset($this->datosObtenidos->Datos->Duracion)) ? $this->datosObtenidos->Datos->Duracion : null;
        $Descripcion_corta =    (isset($this->datosObtenidos->Datos->Descripcion_corta)) ? $this->datosObtenidos->Datos->Descripcion_corta : null;
        $Objetivos_curso =      (isset($this->datosObtenidos->Datos->Objetivos_curso)) ? $this->datosObtenidos->Datos->Objetivos_curso : null;
        $Descripcion_larga =    (isset($this->datosObtenidos->Datos->Descripcion_larga)) ? $this->datosObtenidos->Datos->Descripcion_larga : null;
        $Info_privada =         (isset($this->datosObtenidos->Datos->Info_privada)) ? $this->datosObtenidos->Datos->Info_privada : null;
        $Costo_normal =         (isset($this->datosObtenidos->Datos->Costo_normal)) ? $this->datosObtenidos->Datos->Costo_normal : null;
        $Script_pago_normal =         (isset($this->datosObtenidos->Datos->Script_pago_normal)) ? $this->datosObtenidos->Datos->Script_pago_normal : null;
        $Script_pago_promocional =         (isset($this->datosObtenidos->Datos->Script_pago_promocional)) ? $this->datosObtenidos->Datos->Script_pago_promocional : null;
        $Costo_promocional =    (isset($this->datosObtenidos->Datos->Costo_promocional)) ? $this->datosObtenidos->Datos->Costo_promocional : null;
        $Info_promocional =     (isset($this->datosObtenidos->Datos->Info_promocional)) ? $this->datosObtenidos->Datos->Info_promocional : null;
        $Video_youtube =        (isset($this->datosObtenidos->Datos->Video_youtube)) ? $this->datosObtenidos->Datos->Video_youtube : null;
        

        //$fecha = date("Y-m-d");

        $data = array(
                        
                    'Categoria_id' => 			    $Categoria_id,
                    'Titulo_curso' => 	            $Nombre_principal,
                    'Duracion' => 			        $Duracion,
                    'Descripcion_corta' => 		    $Descripcion_corta,
                    'Objetivos_curso' => 			$Objetivos_curso,
                    'Descripcion_larga' => 		    $Descripcion_larga,
                    'Info_privada' =>               $Info_privada,
                    'Costo_normal' => 				$Costo_normal,
                    'Script_pago_normal' => 				$Script_pago_normal,
                    'Script_pago_promocional' => 				$Script_pago_promocional,
                    'Costo_promocional' => 		    $Costo_promocional,
                    'Info_promocional' => 	        $Info_promocional,
                    'Video_youtube' => 			    $Video_youtube,
                    'Usuario_creador_id' => 		$this->session->userdata('Id'),
                    'Ult_usuario_id' => 		    $this->session->userdata('Id'),
                    'Visible' => 			        1,
                    
                );

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_cursos');
                
        if ($insert_id >=0 ) 
        {   
            echo json_encode(array("Id" => $insert_id));         
        } 
        else 
        {
            echo json_encode(array("Id" => 0));
        }
    }
    
//// CURSOS	        | OBTENER DATOS
    public function obtener_curso()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        $Id = $_GET["Id"];

        $this->db->select('	tbl_cursos.*,
                            tbl_cursos.Titulo_curso as Nombre_principal, 
                            tbl_cursos_categorias.Nombre_categoria'); // BUSCAR SOLO DATOS NECESARIOS
        $this->db->from('tbl_cursos');
        $this->db->join('tbl_cursos_categorias', 'tbl_cursos_categorias.Id = tbl_cursos.Categoria_id', 'left');
        
        $this->db->where('tbl_cursos.Id', $Id);
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// CATEGORIAS 	| OBTENER CATEGORIAS
    public function obtener_categorias()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        $this->db->select('*');
        $this->db->from('tbl_cursos_categorias');
        $this->db->order_by("Nombre_categoria", "asc");
        
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// CATEGORIAS 	| CARGAR O EDITAR
    public function cargar_categorias()
    {
        $CI = &get_instance();
        $CI->load->database();

        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token)
        { 
            exit("No coinciden los token");
        }

        $Id = null;
        if (isset($this->datosObtenidos->Datos->Id)) {
            $Id = $this->datosObtenidos->Datos->Id;
        }

        $data = array(

            'Nombre_categoria' =>   $this->datosObtenidos->Datos->Nombre_categoria,
            'Descripcion' =>        $this->datosObtenidos->Datos->Descripcion,
            'Visible' =>            1,
        );

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_cursos_categorias');

        if ($insert_id >= 0) {
            echo json_encode(array("Id" => $insert_id));
        } else {
            echo json_encode(array("Id" => 0));
        }
    }

//// CURSOS	        | OBTENER Roles
    public function obtener_roles()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        $this->db->select('*');
        $this->db->from('tbl_roles');
        $this->db->order_by("Acceso", "desc");
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// CURSOS	        | OBTENER LIDERES
    public function obtener_lideres()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        $this->db->select('	tbl_cursos.Id,
							tbl_cursos.Nombre');
        $this->db->from('tbl_cursos');
        $this->db->where('Lider', 1);
        $this->db->order_by("Nombre", "desc");
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }



//// CURSOS	        | DESACTIVAR USUARIO
	public function desactivar_usuario()
    {
        $CI =& get_instance();
		$CI->load->database();
		
		$token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token)
        { 
            exit("No coinciden los token");
        }

		//$Id = $this->usuario_existe($this->datosObtenidos->usuarioData->DNI);
        $Id = $this->datosObtenidos->Id;

		$fecha = date("Y-m-d");

		$data = array(
                        
                'Fecha_baja' =>             $fecha,   
                'Activo' => 	            0,
                'Ultima_actualizacion' =>   $fecha,
                'Ultimo_editor_id' => 		$this->session->userdata('Id')    
				);

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_cursos');
                
		if ($insert_id >=0 ) 
		{   
            echo json_encode(array("Id" => $insert_id));         
		} 
		else 
		{
            echo json_encode(array("Id" => 0));
        }

        /// , A TENER EN CUENTA PARA LLEVAR UN SEGUIMIENTO DE QUIEN ELIMINO A ESTE USUARIO
    }

//// MODULOS 	    | OBTENER MODULOS
    public function obtener_modulos()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        $Id = $_GET["Id"];

        $this->db->select('*');
        $this->db->from('tbl_cursos_modulos');
        $this->db->where('Curso_id', $Id);
        
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }
    

//// MODULOS 	    | OBTENER UN MODULO
    public function obtener_un_modulo()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        $Id = $_GET["Id"];

        $this->db->select(' tbl_cursos_modulos.*,
                            tbl_cursos_modulos.Titulo_modulo as Nombre_principal,
                            tbl_cursos.Titulo_curso,
                            tbl_cursos_modulos.Url_archivo as Url_archivo_modulo,
                            tbl_cursos.Id as Curso_id,
                            tbl_creador.Nombre as Nombre_creador,
                            tbl_actualizador.Nombre as Nombre_actualizador');

        $this->db->from('tbl_cursos_modulos');
        $this->db->join('tbl_cursos', 'tbl_cursos.Id = tbl_cursos_modulos.Curso_id', 'left');
        $this->db->join('tbl_usuarios as tbl_creador', 'tbl_creador.Id = tbl_cursos.Usuario_creador_id', 'left');
        $this->db->join('tbl_usuarios as tbl_actualizador', 'tbl_actualizador.Id = tbl_cursos.Ult_usuario_id', 'left');

        $this->db->where('tbl_cursos_modulos.Id', $Id);

        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// MODULOS 	    | CARGAR O EDITAR
    public function cargar_modulo()
    {
        $CI = &get_instance();
        $CI->load->database();

        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token)
        { 
            exit("No coinciden los token");
        }

        $Id = $_GET["Id"];          if (isset($this->datosObtenidos->Datos->Id))         { $Id = $this->datosObtenidos->Datos->Id; }
        
        $Curso_id  = $_GET["Id"];          if (isset($this->datosObtenidos->Datos->Curso_id))         { $Curso_id = $this->datosObtenidos->Datos->Curso_id; }
        
        $Titulo_modulo = null;          if (isset($this->datosObtenidos->Datos->Titulo_modulo))         { $Titulo_modulo = $this->datosObtenidos->Datos->Titulo_modulo; }
        $Descripcion_modulo = null;     if (isset($this->datosObtenidos->Datos->Descripcion_modulo))    { $Descripcion_modulo = $this->datosObtenidos->Datos->Descripcion_modulo; }
        $Contenido_html = null;         if (isset($this->datosObtenidos->Datos->Contenido_html))        { $Contenido_html = $this->datosObtenidos->Datos->Contenido_html; }
        $URL_archivo = null;            if (isset($this->datosObtenidos->Datos->URL_archivo))           { $URL_archivo = $this->datosObtenidos->Datos->URL_archivo; }
        $Usuario_creador_id = $this->session->userdata('Id');     if (isset($this->datosObtenidos->Datos->Usuario_creador_id))    { $Usuario_creador_id = $this->datosObtenidos->Datos->Usuario_creador_id; }

        $data = array(

            'Curso_id' =>           $Curso_id,
            'Titulo_modulo' =>      $Titulo_modulo,
            'Descripcion_modulo' => $Descripcion_modulo,
            'Contenido_html' =>     $Contenido_html,
            'URL_archivo' =>        $URL_archivo,
            'Usuario_creador_id' => $Usuario_creador_id,
            'Ult_usuario_id' =>     $this->session->userdata('Id'),
        );

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_cursos_modulos');

        if ($insert_id >= 0) {
            echo json_encode(array("Id" => $insert_id));
        } else {
            echo json_encode(array("Id" => 0));
        }
    }

//// MODULOS 	    | SUBIR ARCHIVO 
    public function subir_archivo()
    {
        $status = "";
        $msg = "";
        $file_element_name = 'Archivo';
        
        if ($status != "error")
        {
            $config['upload_path'] = './uploads/imagenes';
            $config['allowed_types'] = 'jpg|jpeg|doc|docx|xlsx|pdf';
            $config['max_size'] = 0;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name))
            {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
            else
            {
                /// coloco el dato en la base de datos
                    $Id = $_GET["Id"];
                    $data = $this->upload->data();
                    $file_info = $this->upload->data();
                    $nombre_archivo = $file_info['file_name'];
                    
                    $data = array(    
                        'Url_archivo' =>	$nombre_archivo,
                    );

                    $this->load->model('App_model');
                    $insert_id = $this->App_model->insertar($data, $Id, 'tbl_cursos_modulos');
                    
                    // $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
                    if($insert_id > 0)
                    {
                        $status = 1;
                        $msg = "File successfully uploaded";
                    }
                    else
                    {
                        unlink($data['full_path']);
                        $status = 0;
                        $msg = "Something went wrong when saving the file, please try again.";
                    }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'Url_archivo' => $nombre_archivo));
    }

//// SEGUIMIENTOS 	| OBTENER Listado
    public function obtener_seguimientos()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        $Id = $_GET["Id"];

        $this->db->select(' tbl_cursos_seguimiento.*,
                            tbl_usuarios.Nombre');
        
        $this->db->from('tbl_cursos_seguimiento');
        $this->db->join('tbl_usuarios', 'tbl_usuarios.Id = tbl_cursos_seguimiento.Usuario_id', 'left');

        $this->db->where('tbl_cursos_seguimiento.Curso_seguimiento_id', $Id);
        $this->db->where('tbl_cursos_seguimiento.Visible', 1);

        $this->db->order_by('tbl_cursos_seguimiento.Id', 'desc');
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// SEGUIMIENTOS 	| CARGAR O EDITAR
    public function cargar_seguimiento()
    {
        $CI = &get_instance();
        $CI->load->database();

        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        $Id = null;
        if(isset($this->datosObtenidos->Datos->Id))
        {
            $Id = $this->datosObtenidos->Datos->Id;
        }

        $data = array(

            'Curso_seguimiento_id' =>   $this->datosObtenidos->Id,
            'Fecha' =>                  $this->datosObtenidos->Datos->Fecha,
            'Descripcion' =>            $this->datosObtenidos->Datos->Descripcion,
            'Usuario_id' =>             $this->session->userdata('Id'),
            'Visible' =>                1

        );
        //

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_cursos_seguimiento');

        if ($insert_id >= 0) {
            echo json_encode(array("Id" => $insert_id));
        } else {
            echo json_encode(array("Id" => 'Error'));
        }
    }

//// SEGUIMIENTOS 	| SUBIR ARCHIVO 
    public function subirFotoSeguimiento()
    {
        $status = "";
        $msg = "";
        $file_element_name = 'Archivo';
        
        if ($status != "error")
        {
            $config['upload_path'] = './uploads/seguimientos';
            $config['allowed_types'] = 'jpg|jpeg|doc|docx|xlsx|pdf';
            $config['max_size'] = 0;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name))
            {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
            else
            {
                /// coloco el dato en la base de datos
                    $Id = $_GET["Id"];
                    
                    $data = $this->upload->data();
                    
                    $file_info = $this->upload->data();
                    $nombre_archivo = $file_info['file_name'];
                    
                    $data = array(    
                        'URL_archivo' =>	$nombre_archivo,
                    );

                    $this->load->model('App_model');
                    $insert_id = $this->App_model->insertar($data, $Id, 'tbl_cursos_seguimiento');
                    
                    // $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
                    if($insert_id > 0)
                    {
                        $status = 1;
                        $msg = "File successfully uploaded";
                    }
                    else
                    {
                        unlink($data['full_path']);
                        $status = 0;
                        $msg = "Something went wrong when saving the file, please try again.";
                    }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'Url_archivo' => $nombre_archivo));
    }

//// EXAMEN 	    | OBTENER EXAMEN
    public function obtener_examens()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        $Id = $_GET["Id"];

        $this->db->select('*');
        $this->db->from('tbl_cursos_examen');
        $this->db->where('Modulo_id', $Id);
        
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }


//// EXAMEN 	    | OBTENER 
    public function obtener_un_examen()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        $Id = $_GET["Id"];

        $this->db->select(' tbl_cursos_examens.*,
                            tbl_cursos_examens.Titulo_examen as Nombre_principal,
                            tbl_cursos.Titulo_curso,
                            tbl_cursos.Id as Curso_id,
                            tbl_cursos_modulos.Id as Modulo_id,
                            tbl_creador.Nombre as Nombre_creador,
                            tbl_actualizador.Nombre as Nombre_actualizador');

        $this->db->from('tbl_cursos_examens');
        $this->db->join('tbl_cursos', 'tbl_cursos.Id = tbl_cursos_examens.Curso_id', 'left');
        $this->db->join('tbl_cursos_modulos', 'tbl_cursos_modulos.Id = tbl_cursos_examens.Modulo_id', 'left');
        $this->db->join('tbl_usuarios as tbl_creador', 'tbl_creador.Id = tbl_cursos.Usuario_creador_id', 'left');
        $this->db->join('tbl_usuarios as tbl_actualizador', 'tbl_actualizador.Id = tbl_cursos.Ult_usuario_id', 'left');

        $this->db->where('tbl_cursos_examens.Id', $Id);

        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// EXAMEN 	    | CARGAR O EDITAR
    public function cargar_examen()
    {
        $CI = &get_instance();
        $CI->load->database();

        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token)
        { 
            exit("No coinciden los token");
        }

        $Id = null; if (isset($this->datosObtenidos->Datos->Id)) { $Id = $this->datosObtenidos->Datos->Id; }
        
        $Modulo_id = $_GET["Id"];
        $Curso_id = $this->datosObtenidos->Curso_id;
        
        $Titulo_examen = null;          if (isset($this->datosObtenidos->Datos->Titulo_examen))         { $Titulo_examen = $this->datosObtenidos->Datos->Titulo_examen; }
        $Descripcion_examen = null;     if (isset($this->datosObtenidos->Datos->Descripcion_examen))    { $Descripcion_examen = $this->datosObtenidos->Datos->Descripcion_examen; }
        $Contenido_html = null;         if (isset($this->datosObtenidos->Datos->Contenido_html))        { $Contenido_html = $this->datosObtenidos->Datos->Contenido_html; }
        $URL_archivo = null;            if (isset($this->datosObtenidos->Datos->URL_archivo))           { $URL_archivo = $this->datosObtenidos->Datos->URL_archivo; }
        $Usuario_creador_id = $this->session->userdata('Id');     if (isset($this->datosObtenidos->Datos->Usuario_creador_id))    { $Usuario_creador_id = $this->datosObtenidos->Datos->Usuario_creador_id; }

        $data = array(

            'Curso_id' =>           $Curso_id,
            'Modulo_id' =>          $Modulo_id,
            'Titulo_examen' =>      $Titulo_examen,
            'Descripcion_examen' => $Descripcion_examen,
            'Contenido_html' =>     $Contenido_html,
            'URL_archivo' =>        $URL_archivo,
            'Usuario_creador_id' => $Usuario_creador_id,
            'Ult_usuario_id' =>     $this->session->userdata('Id'),
        );

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_cursos_examen');

        if ($insert_id >= 0) {
            echo json_encode(array("Id" => $insert_id));
        } else {
            echo json_encode(array("Id" => 0));
        }
    }

//// EXAMEN 	    | SUBIR ARCHIVO 
    public function subir_archivo_examen()
    {
        $status = "";
        $msg = "";
        $file_element_name = 'Archivo';
        
        if ($status != "error")
        {
            $config['upload_path'] = './uploads/imagenes';
            $config['allowed_types'] = 'jpg|jpeg|doc|docx|xlsx|pdf';
            $config['max_size'] = 0;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name))
            {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
            else
            {
                /// coloco el dato en la base de datos
                    $Id = $_GET["Id"];
                    $data = $this->upload->data();
                    $file_info = $this->upload->data();
                    $nombre_archivo = $file_info['file_name'];
                    
                    $data = array(    
                        'Url_archivo' =>	$nombre_archivo,
                    );

                    $this->load->model('App_model');
                    $insert_id = $this->App_model->insertar($data, $Id, 'tbl_cursos_examen');
                    
                    // $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
                    if($insert_id > 0)
                    {
                        $status = 1;
                        $msg = "File successfully uploaded";
                    }
                    else
                    {
                        unlink($data['full_path']);
                        $status = 0;
                        $msg = "Something went wrong when saving the file, please try again.";
                    }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'Url_archivo' => $nombre_archivo));
    }

//// INSCRIPTOS 	| OBTENER INSCRIPTOS
    public function obtener_personas_curso()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        $Id = $_GET["Id"];

        $Estado = $this->datosObtenidos->Filtro_1;

        $this->db->select(' tbl_cursos_alumnos.Id,
                            tbl_cursos_alumnos.Alumno_id,
                            tbl_cursos_alumnos.Profesor_id,
                            tbl_cursos_alumnos.Observaciones,
                            tbl_cursos_alumnos.Fecha_inicio,
                            tbl_cursos_alumnos.Fecha_finalizacion,
                            tbl_cursos_alumnos.Medio_pago,
                            tbl_alumno.Nombre as Nombre_alumno,
                            tbl_alumno.Email,
                            tbl_alumno.Imagen,
                            tbl_alumno.Telefono,
                            tbl_profesor.Nombre as Nombre_profesor,
                            tbl_profesor.Observaciones as Observaciones_profesor');
        $this->db->from('tbl_cursos_alumnos');
        $this->db->join('tbl_usuarios as tbl_alumno', 'tbl_alumno.Id = tbl_cursos_alumnos.Alumno_id', 'left');
        $this->db->join('tbl_usuarios as tbl_profesor', 'tbl_profesor.Id = tbl_cursos_alumnos.Profesor_id', 'left');

        $this->db->where('tbl_cursos_alumnos.Estado', $Estado);
        $this->db->where('tbl_cursos_alumnos.Curso_id', $Id);

        
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }


//// INSCRIPTOS 	| CARGAR O EDITAR
    public function cargar_inscripto()
    {
        $CI = &get_instance();
        $CI->load->database();

        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token)
        { exit("No coinciden los token"); }


        $Id = null; if (isset($this->datosObtenidos->Datos->Id)) { $Id = $this->datosObtenidos->Datos->Id; }
        
        $Curso_id = $_GET["Id"];
        
        $Profesor_id = null;            if (isset($this->datosObtenidos->Datos->Profesor_id))       { $Profesor_id = $this->datosObtenidos->Datos->Profesor_id; }
        $Alumno_id = null;              if (isset($this->datosObtenidos->Datos->Alumno_id))         { $Alumno_id = $this->datosObtenidos->Datos->Alumno_id; }
        $Fecha_inicio = date("Y-m-d");  if (isset($this->datosObtenidos->Datos->Fecha_inicio))      { $Fecha_inicio = $this->datosObtenidos->Datos->Fecha_inicio; }
        $Fecha_finalizacion = null;     if (isset($this->datosObtenidos->Datos->Fecha_finalizacion)){ $Fecha_finalizacion = $this->datosObtenidos->Datos->Fecha_finalizacion; }
        $Estado = 1;                    if (isset($this->datosObtenidos->Datos->Estado))            { $Estado = $this->datosObtenidos->Datos->Estado; }
        $Nota_final = null;             if (isset($this->datosObtenidos->Datos->Nota_final))        { $Nota_final = $this->datosObtenidos->Datos->Nota_final; }
        $Medio_pago = null;          if (isset($this->datosObtenidos->Datos->Medio_pago))     { $Medio_pago = $this->datosObtenidos->Datos->Medio_pago; }
        $Url_archivo = null;            if (isset($this->datosObtenidos->Datos->Url_archivo))       { $Url_archivo = $this->datosObtenidos->Datos->Url_archivo; }
        $Observaciones = null;          if (isset($this->datosObtenidos->Datos->Observaciones))     { $Observaciones = $this->datosObtenidos->Datos->Observaciones; }
        $Usuario_creador_id = $this->session->userdata('Id');     if (isset($this->datosObtenidos->Datos->Usuario_creador_id))    { $Usuario_creador_id = $this->datosObtenidos->Datos->Usuario_creador_id; }

        //// CONTROLAR SI TAL USUARIO NO TIENE CREADO YA EL MISMO CURSO
        $this->db->select('Id');
        $this->db->from('tbl_cursos_alumnos');
        $this->db->where('Curso_id', $Curso_id);
        $this->db->where('Alumno_id', $Alumno_id);

        $query = $this->db->get();
        $result = $query->result_array();
        $cant = $query->num_rows();

        if($cant > 0)
        { 
            $Id = $result[0]["Id"];
        }
            $data = array(

                'Curso_id' =>           $Curso_id,
                'Profesor_id' =>        $Profesor_id,
                'Alumno_id' =>          $Alumno_id,
                'Fecha_inicio' =>       $Fecha_inicio,
                'Fecha_finalizacion' => $Fecha_finalizacion,
                'Estado' =>             $Estado,
                'Nota_final' =>         $Nota_final,
                'Medio_pago' =>      $Medio_pago,
                'Url_archivo' =>        $Url_archivo,
                'Observaciones' =>      $Observaciones,
                'Usuario_creador_id' => $Usuario_creador_id,
                'Ult_usuario_id' =>     $this->session->userdata('Id'),
            );
    
            $this->load->model('App_model');
            $insert_id = $this->App_model->insertar($data, $Id, 'tbl_cursos_alumnos');
    
            if ($insert_id >= 0) {
                echo json_encode(array("Id" => $insert_id));
            } else {
                echo json_encode(array("Id" => 0));
            }
        

    
    }

//// INSCRIPTOS 	| OBTENER 
    public function obtener_curso_alumno()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        
        $Id = $_GET["Id"];       
        if (isset($this->datosObtenidos->Filtro_1))       
        { 
            /// CONSULTAR EL ID DEL CURSO RELACIONADO A ESTE MODULO-EXAMEN
            $this->db->select('Curso_alumno_id');
            $this->db->from('tbl_cursos_examen_alumno');
            $this->db->where('Id', $Id);
            $query = $this->db->get();
            $result_examen = $query->result_array();

            $Id = $result_examen[0]["Curso_alumno_id"]; 
        }

        $this->db->select(' tbl_cursos_alumnos.*,
                            tbl_cursos.*,
                            tbl_cursos.Imagen as Imagen_curso,

                            tbl_alumno.Nombre as Nombre_alumno,
                            tbl_alumno.Imagen as Imagen_alumno,
                            tbl_alumno.Email as Email_alumno,

                            tbl_profesor.Nombre as Nombre_profesor,
                            tbl_profesor.Observaciones as Observaciones_profesor,
                            tbl_profesor.Imagen as Imagen_profesor,
                            tbl_profesor.Email as Email_profesor,

                            tbl_cursos_categorias.Nombre_categoria,

                            tbl_creador.Nombre as Nombre_creador,

                            tbl_actualizador.Nombre as Nombre_actualizador');

        $this->db->from('tbl_cursos_alumnos');

        $this->db->join('tbl_cursos', 'tbl_cursos.Id = tbl_cursos_alumnos.Curso_id', 'left');
        $this->db->join('tbl_cursos_categorias', 'tbl_cursos_categorias.Id = tbl_cursos.Categoria_id', 'left');
        $this->db->join('tbl_usuarios as tbl_alumno', 'tbl_alumno.Id = tbl_cursos_alumnos.Alumno_id', 'left');
        $this->db->join('tbl_usuarios as tbl_profesor', 'tbl_profesor.Id = tbl_cursos_alumnos.Profesor_id', 'left');
        $this->db->join('tbl_usuarios as tbl_creador', 'tbl_creador.Id = tbl_cursos_alumnos.Usuario_creador_id', 'left');
        $this->db->join('tbl_usuarios as tbl_actualizador', 'tbl_actualizador.Id = tbl_cursos_alumnos.Ult_usuario_id', 'left');

        $this->db->where('tbl_cursos_alumnos.Id', $Id);

        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// CURSOS RECOMENDADOS 	| OBTENER LISTADO
    public function obtener_cursos_recomendados()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

       /*  $Id = $_GET["Id"];       
        if (isset($this->datosObtenidos->Filtro_1))       
        { 
            /// CONSULTAR EL ID DEL CURSO RELACIONADO A ESTE MODULO-EXAMEN
            $this->db->select('Curso_alumno_id');
            $this->db->from('tbl_cursos_examen_alumno');
            $this->db->where('Id', $Id);
            $query = $this->db->get();
            $result = $query->result_array();

            $Id = $result[0]["Curso_alumno_id"]; 
        } */

        $Id = $_GET["Categoria_id"];

        $limite = $this->datosObtenidos->limite;

        $this->db->select('*');
        $this->db->from('tbl_cursos');
        //$this->db->where('Categoria_id', $Id);
        $this->db->limit($limite);  // Produces: LIMIT 10
        $this->db->order_by('rand()');
        
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// EXAMEN MODULO 	| CARGAR O EDITAR
    public function generar_examen()
    {
        $CI = &get_instance();
        $CI->load->database();

        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token)
        { 
            exit("No coinciden los token");
        }

    //// posible error aca
        /* $Id = null;     
        if ($_GET["Id"] != null) 
        { 
            $Id = $_GET["Id"]; 
        } */
        $Id = null;    if (isset($this->datosObtenidos->Datos->Id))    { $Id = $this->datosObtenidos->Datos->Id; }
        //$Id = null;
        
        $Curso_alumno_id = $_GET["Id"];    if (isset($this->datosObtenidos->Datos->Curso_alumno_id))    { $Curso_alumno_id = $this->datosObtenidos->Datos->Curso_alumno_id; }
    //// posible error aca

        $Examen_id = null;                  if (isset($this->datosObtenidos->Datos->Examen_id))    { $Examen_id = $this->datosObtenidos->Datos->Examen_id; }
        $Modulo_id = null;                  if (isset($this->datosObtenidos->Datos->Modulo_id))    { $Modulo_id = $this->datosObtenidos->Datos->Modulo_id; }

        $Fecha_habilitado = date("Y-m-y");  if (isset($this->datosObtenidos->Datos->Fecha_habilitado))        { $Fecha_habilitado = $this->datosObtenidos->Datos->Fecha_habilitado; }

        $Estado =                           $this->datosObtenidos->Estado;        

        $Observaciones = null;              if (isset($this->datosObtenidos->Datos->Observaciones))    { $Observaciones = $this->datosObtenidos->Datos->Observaciones; }
        $Observaciones_correccion = null;   if (isset($this->datosObtenidos->Datos->Observaciones_correccion))    { $Observaciones_correccion = $this->datosObtenidos->Datos->Observaciones_correccion; }
        $Respuesta_html = null;             if (isset($this->datosObtenidos->Datos->Respuesta_html))    { $Respuesta_html = $this->datosObtenidos->Datos->Respuesta_html; }
    
        $Fecha_realizado = null;   if ($Estado == 2)  { $Fecha_realizado = date("Y-m-d"); }
        
        $Fecha_corregido = null;   if ($Estado == 3)  { $Fecha_corregido = date("Y-m-d"); $Fecha_realizado = $this->datosObtenidos->Datos->Fecha_realizado; }

        $Url_archivo = null;                if (isset($this->datosObtenidos->Datos->Url_archivo))    { $Url_archivo = $this->datosObtenidos->Datos->Url_archivo; }
        $Nota = null;                       if (isset($this->datosObtenidos->Datos->Nota))    { $Nota = $this->datosObtenidos->Datos->Nota; }
        $Usuario_creador_id = $this->session->userdata('Id');     if (isset($this->datosObtenidos->Datos->Usuario_creador_id))    { $Usuario_creador_id = $this->datosObtenidos->Datos->Usuario_creador_id; }
         
        $data = array(

            'Examen_id' =>              $Examen_id,
            'Modulo_id' =>              $Modulo_id,
            'Curso_alumno_id' =>        $Curso_alumno_id,
            'Fecha_habilitado' =>       $Fecha_habilitado,
            'Fecha_realizado' =>        $Fecha_realizado,
            'Fecha_corregido' =>        $Fecha_corregido,
            'Respuesta_html' =>         $Respuesta_html,
            'Url_archivo' =>            $Url_archivo,
            'Estado' =>                 $Estado,
            'Nota' =>                   $Nota,
            'Observaciones' =>          $Observaciones,
            'Observaciones_correccion' =>  $Observaciones_correccion,
            'Usuario_creador_id' =>     $Usuario_creador_id,
            'Ult_usuario_id' =>         $this->session->userdata('Id'),
        );

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_cursos_examen_alumno');

        if ($insert_id >= 0) {
            echo json_encode(array("Id" => $insert_id, "Estado" => $Estado));
        } else {
            echo json_encode(array("Id" => 0));
        }
    }

//// EXAMEN 	    | SUBIR ARCHIVO 
    public function subir_archivo_respuesta_examen()
    {
        $status = "";
        $msg = "";
        $file_element_name = 'Archivo';
        
        if ($status != "error")
        {
            $config['upload_path'] = './uploads/archivos';
            $config['allowed_types'] = 'jpg|jpeg|doc|docx|xlsx|pdf|png|rar';
            $config['max_size'] = 0;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name))
            {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
            else
            {
                /// coloco el dato en la base de datos
                    $Id = $_GET["Id"];
                    $data = $this->upload->data();
                    $file_info = $this->upload->data();
                    $nombre_archivo = $file_info['file_name'];
                    
                    $data = array(    
                        'Url_archivo' =>	$nombre_archivo,
                    );

                    $this->load->model('App_model');
                    $insert_id = $this->App_model->insertar($data, $Id, 'tbl_cursos_examen_alumno');
                    
                    // $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
                    if($insert_id > 0)
                    {
                        $status = 1;
                        $msg = "File successfully uploaded";
                    }
                    else
                    {
                        unlink($data['full_path']);
                        $status = 0;
                        $msg = "Something went wrong when saving the file, please try again.";
                    }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'Url_archivo' => $nombre_archivo));
    }


//// CURSO EXAMEN ALUMNO 	| OBTENER 
    public function obtener_curso_examen_alumno()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        
        $Id = $_GET["Id"];       
 
            /// CONSULTAR EL ID DEL CURSO RELACIONADO A ESTE MODULO-EXAMEN
            $this->db->select('*');
            $this->db->from('tbl_cursos_examen_alumno');
            $this->db->where('Id', $Id);
            $query = $this->db->get();
            $result = $query->result_array();

        echo json_encode($result);

    }

//// CURSOS RECOMENDADOS 	| OBTENER LISTADO
    public function obtener_cursos_gratis_index()  //// POR EL MOMENTO QUE SELECCIONE DOS ALEATOREOS
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        //$limite = $this->datosObtenidos->limite;
        $limite = 2;

        $this->db->select('*');
        $this->db->from('tbl_cursos');
        //$this->db->where('Costo_normal', 0); SI SE DAN CURSOS GRATIS VOLVER A HABILITAR ESTA PARTE
        $this->db->limit($limite);  // Produces: LIMIT 10
        $this->db->order_by('rand()');
        
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }


//// CURSOS	        | OBTENER CANTIDAD DE CURSOS
    public function cantidad_cursos_gratis()
    {

        //Esto siempre va es para instanciar la base de datos
        $CI = &get_instance();
        $CI->load->database();
        
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }

        //// DEBO PODER VER TODOS LOS ALUMNOS CURZANDO, PERO SI SOY PROFE, SOLO DEBO VER LOS QUE ESTEN VINCULADOS A MI COMO PROFE

        
        $this->db->select('Id'); // BUSCAR SOLO DATOS NECESARIOS
        
        $this->db->from('tbl_cursos');
        $this->db->where('Costo_normal', 0);

        $query = $this->db->get();
        $result = $query->result_array();
        $cant = $query->num_rows();

        echo json_encode($cant);

    }


//// CURSOS	        | OBTENER LISTADO PRINCIPAL PUBLICO
	public function obtener_listado_principal_publico()
    {
			
        //Esto siempre va es para instanciar la base de datos
        $CI =& get_instance();
        $CI->load->database();
		//Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) { exit("No coinciden los token"); }
        
        
        $Categoria_id = 0;  
        
        if(isset($_GET["Id"]))
        {
            $Categoria_id = $_GET["Id"];
        }

        $this->db->select('	tbl_cursos.Id,
                            tbl_cursos.Titulo_curso,
                            tbl_cursos.Duracion,
                            tbl_cursos.Costo_normal,
                            tbl_cursos.Imagen,
                            tbl_cursos.Categoria_id,
                            tbl_cursos.Fecha_ult_actualizacion_curso,
                            tbl_cursos.Descripcion_corta,
                            tbl_cursos.Costo_promocional,
                            tbl_cursos_categorias.Nombre_categoria,');
		$this->db->from('tbl_cursos');
        
        $this->db->join('tbl_cursos_categorias', 'tbl_cursos_categorias.Id = tbl_cursos.Categoria_id','left');

        if($Categoria_id > 0) { $this->db->where('tbl_cursos.Categoria_id', $Categoria_id); }
        
        

		$this->db->order_by("tbl_cursos.Titulo_curso", "asc");
        $query = $this->db->get();
		$result = $query->result_array();

		echo json_encode($result);
		
    }
//// CURSOS	        | OBTENER LISTADO DE ÚLTIMOS CURSOS 
    public function obtener_ultimos_cursos()
    {
            
        //Esto siempre va es para instanciar la base de datos
        $CI =& get_instance();
        $CI->load->database();
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) { exit("No coinciden los token"); }
        $limite = 5;

        $this->db->select('	tbl_cursos.Id,
                            tbl_cursos.Titulo_curso,
                            tbl_cursos.Duracion,
                            tbl_cursos.Costo_normal,
                            tbl_cursos.Imagen,
                            tbl_cursos.Categoria_id,
                            tbl_cursos.Fecha_ult_actualizacion_curso,
                            tbl_cursos.Descripcion_corta,
                            tbl_cursos.Costo_promocional,
                            tbl_cursos_categorias.Nombre_categoria,');
        $this->db->from('tbl_cursos');
        
        $this->db->join('tbl_cursos_categorias', 'tbl_cursos_categorias.Id = tbl_cursos.Categoria_id','left');        
        $this->db->limit($limite);  // Produces: LIMIT 10
        $this->db->order_by("tbl_cursos.Fecha_ult_actualizacion_curso", "desc");

        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);
        
    }
    
///// fin documento
}
