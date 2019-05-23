<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cursos extends CI_Controller
{

//// CURSOS      | VISTA | LISTADO
    public function index()
    {
		if ($this->session->userdata('Login') != true) 
		{
            header("Location: " . base_url() . "login"); /// enviar a pagina de error
		} 
		else 
		{
			if ($this->session->userdata('Rol_acceso') > 3) 
			{
				$data = array(
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

//// CURSOS      | VISTA | DATOS
    public function datos()
    {
        if ($this->session->userdata('Login') != true) 
        {
            header("Location: " . base_url() . "login"); /// enviar a pagina de error
        } 
        else 
        {
            if ($this->session->userdata('Rol_acceso') > 3) 
            {
                $data = array(
					"TituloPagina" => "Control de cursos",
					"Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
				);
                $this->load->view('cursos_datos', $data);
                
            } else {
                header("Location: " . base_url() . "login"); /// enviar a pagina de error
            }
        }
    }

//// CURSOS MÓDULO | VISTA | DATOS
    public function modulo()
    {
        if ($this->session->userdata('Login') != true) 
        {
            header("Location: " . base_url() . "login"); /// enviar a pagina de error
        } 
        else 
        {
            if ($this->session->userdata('Rol_acceso') > 3) 
            {
                $data = array(
                    "TituloPagina" => "Control de modulo de un curso",
                    "Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
                );
                $this->load->view('cursos_datos_modulo', $data);
                
            } else {
                header("Location: " . base_url() . "login"); /// enviar a pagina de error
            }
        }
    }

//// CURSOS	    | OBTENER LISTADO PRINCIPAL
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
                            tbl_cursos.Fecha_ult_actualizacion_curso,
                            tbl_cursos.Descripcion_corta,
                            tbl_cursos.Costo_promocional,
                            tbl_cursos_categorias.Nombre_categoria,');
		$this->db->from('tbl_cursos');
        
        $this->db->join('tbl_cursos_categorias', 'tbl_cursos_categorias.Id = tbl_cursos.Categoria_id','left');

        if($Categoria_id > 0) { $this->db->where('tbl_cursos.Categoria_id', $Categoria_id); }
       // if ($puesto > 0) { $this->db->where('tbl_cursos.Puesto_Id', $puesto); } 

		$this->db->order_by("tbl_cursos.Titulo_curso", "asc");
        $query = $this->db->get();
		$result = $query->result_array();

		echo json_encode($result);
		
    }

//// CURSOS	    | CARGAR O EDITAR
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
        $Titulo_curso =         (isset($this->datosObtenidos->Datos->Titulo_curso)) ? $this->datosObtenidos->Datos->Titulo_curso : null;
        $Duracion =             (isset($this->datosObtenidos->Datos->Duracion)) ? $this->datosObtenidos->Datos->Duracion : null;
        $Descripcion_corta =    (isset($this->datosObtenidos->Datos->Descripcion_corta)) ? $this->datosObtenidos->Datos->Descripcion_corta : null;
        $Objetivos_curso =      (isset($this->datosObtenidos->Datos->Objetivos_curso)) ? $this->datosObtenidos->Datos->Objetivos_curso : null;
        $Descripcion_larga =    (isset($this->datosObtenidos->Datos->Descripcion_larga)) ? $this->datosObtenidos->Datos->Descripcion_larga : null;
        $Info_privada =         (isset($this->datosObtenidos->Datos->Info_privada)) ? $this->datosObtenidos->Datos->Info_privada : null;
        $Costo_normal =         (isset($this->datosObtenidos->Datos->Costo_normal)) ? $this->datosObtenidos->Datos->Costo_normal : null;
        $Costo_promocional =    (isset($this->datosObtenidos->Datos->Costo_promocional)) ? $this->datosObtenidos->Datos->Costo_promocional : null;
        $Info_promocional =     (isset($this->datosObtenidos->Datos->Info_promocional)) ? $this->datosObtenidos->Datos->Info_promocional : null;
        $Video_youtube =        (isset($this->datosObtenidos->Datos->Video_youtube)) ? $this->datosObtenidos->Datos->Video_youtube : null;
        

        //$fecha = date("Y-m-d");

        $data = array(
                        
                    'Categoria_id' => 			    $Categoria_id,
                    'Titulo_curso' => 	            $Titulo_curso,
                    'Duracion' => 			        $Duracion,
                    'Descripcion_corta' => 		    $Descripcion_corta,
                    'Objetivos_curso' => 			$Objetivos_curso,
                    'Descripcion_larga' => 		    $Descripcion_larga,
                    'Info_privada' =>               $Info_privada,
                    'Costo_normal' => 				$Costo_normal,
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
    
//// CURSOS	    | OBTENER DATOS
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

//// CURSOS	    | OBTENER Roles
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

//// CURSOS	    | OBTENER LIDERES
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



//// CURSOS	    | DESACTIVAR USUARIO
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

//// MODULOS 	| OBTENER MODULOS
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
        $this->db->where('Id', $Id);
        
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }
    

//// MODULOS 	| OBTENER UN MODULO
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

//// MODULOS 	| CARGAR O EDITAR
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

        $Id = null; if (isset($this->datosObtenidos->Datos->Id)) { $Id = $this->datosObtenidos->Datos->Id; }
        
        $Curso_id = $_GET["Id"];
        
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

//// MODULOS 	| SUBIR ARCHIVO 
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

//// EXAMEN 	| OBTENER EXAMEN
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


//// EXAMEN 	| OBTENER UN MODULO
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

//// EXAMEN 	| CARGAR O EDITAR
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

//// EXAMEN 	| SUBIR ARCHIVO 
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

///// fin documento
}
