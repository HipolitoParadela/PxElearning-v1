<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{

//// USUARIOS       | VISTA | LISTADO
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
                    "body_class" => '',
                    "div_inicial_class" => 'class="hero-content"',
					"TituloPagina" => "Control de usuarios",
					"Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
				);
				$this->load->view('usuarios_listado',$data);
			} 
			else 
			{
                header("Location: " . base_url() . "login"); /// enviar a pagina de error
            }
        } 
    }

//// USUARIOS       | VISTA | DATOS
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
                    "body_class" => '',
                    "div_inicial_class" => 'class="hero-content"',
					"TituloPagina" => "Control de usuarios",
					"Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
				);
                $this->load->view('usuarios_datos', $data);
                
            } else {
                header("Location: " . base_url() . "login"); /// enviar a pagina de error
            }
        }
    }

//// USUARIOS 	    | OBTENER LISTADO
	public function obtener_listado_principal()
    {
			
        //Esto siempre va es para instanciar la base de datos
        $CI =& get_instance();
        $CI->load->database();
		//Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) {
            exit("No coinciden los token");
        }
        //$estado = $_GET["estado"];
        $estado = 1;

        $Rol_acceso = $this->datosObtenidos->Filtro_1;
        //$puesto = $_GET["puesto"];

        $this->db->select('	tbl_usuarios.Nombre as Nombre_principal,
                            tbl_usuarios.Telefono,
                            tbl_usuarios.Email,
                            tbl_usuarios.DNI,
                            tbl_usuarios.Id,
                            tbl_usuarios.Imagen,
                            tbl_usuarios.Rol_acceso,
                            tbl_usuarios.Pass,
                            tbl_roles.Nombre_rol'); 
                            /* tbl_empresas.Nombre_empresa, tbl_puestos.Nombre_puesto, tbl_lider.Nombre as Nombre_lider */
		$this->db->from('tbl_usuarios');
        
        $this->db->join('tbl_roles', 'tbl_roles.Acceso = tbl_usuarios.Rol_acceso','left');
        //$this->db->join('tbl_empresas', 'tbl_empresas.Id = tbl_usuarios.Empresa_id', 'left');
        //$this->db->join('tbl_puestos', 'tbl_puestos.Id = tbl_usuarios.Puesto_Id', 'left');
        //$this->db->join('tbl_usuarios as tbl_lider', 'tbl_lider.Id = tbl_usuarios.Superior_inmediato', 'left');

        $this->db->where('tbl_usuarios.Visible',$estado);

        if($Rol_acceso > 0) { $this->db->where('tbl_usuarios.Rol_acceso', $Rol_acceso); }
       // if ($puesto > 0) { $this->db->where('tbl_usuarios.Puesto_Id', $puesto); } 

		$this->db->order_by("Nombre", "asc");
        $query = $this->db->get();
		$result = $query->result_array();

		echo json_encode($result);
		
    }
    
//// USUARIOS 	    | OBTENER UN USUARIOS
    public function obtener_Usuario()
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

        $this->db->select('	tbl_usuarios.*,
                            tbl_usuarios.Nombre as Nombre_principal, 
							tbl_roles.Nombre_rol'); // BUSCAR SOLO DATOS NECESARIOS
        $this->db->from('tbl_usuarios');
        $this->db->join('tbl_roles', 'tbl_roles.Acceso = tbl_usuarios.Rol_acceso', 'left');
        
        $this->db->where('tbl_usuarios.Id', $Id);
        $this->db->order_by("tbl_usuarios.Nombre", "asc");
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// USUARIOS 	    | OBTENER Roles
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

    //// USUARIOS 	    | OBTENER LIDERES
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

        $this->db->select('	tbl_usuarios.Id,
                            tbl_usuarios.Nombre');
        $this->db->from('tbl_usuarios');
        $this->db->where('Lider', 1);
        $this->db->order_by("Nombre", "desc");
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// USUARIOS 	    | CARGAR O EDITAR USUARIOS
    public function cargar_Usuarios()
    {
        $CI =& get_instance();
        $CI->load->database();
        
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token)
        { 
            exit("No coinciden los token");
        }

        //$Id = $this->usuario_existe($this->datosObtenidos->Datos->DNI);
        $Id = null;
        if(isset($this->datosObtenidos->Datos->Id))
        {
            $Id = $this->datosObtenidos->Datos->Id;
        }
        $Fecha_alta = null;
        if(isset($this->datosObtenidos->Datos->Fecha_alta))
        {
            $Fecha_alta = $this->datosObtenidos->Datos->Fecha_alta;
        }
        
        $CUIT_CUIL =                (isset($this->datosObtenidos->Datos->CUIT_CUIL)) ? $this->datosObtenidos->Datos->CUIT_CUIL : null;
        $Fecha_nacimiento =         (isset($this->datosObtenidos->Datos->Fecha_nacimiento)) ? $this->datosObtenidos->Datos->Fecha_nacimiento : null;
        $Domicilio =                (isset($this->datosObtenidos->Datos->Domicilio)) ? $this->datosObtenidos->Datos->Domicilio : null;
        $Nacionalidad =             (isset($this->datosObtenidos->Datos->Nacionalidad)) ? $this->datosObtenidos->Datos->Nacionalidad : null;
        $Genero =                   (isset($this->datosObtenidos->Datos->Genero)) ? $this->datosObtenidos->Datos->Genero : null;
        $Obra_social =              (isset($this->datosObtenidos->Datos->Obra_social)) ? $this->datosObtenidos->Datos->Obra_social : null;
        $Numero_obra_social =       (isset($this->datosObtenidos->Datos->Numero_obra_social)) ? $this->datosObtenidos->Datos->Numero_obra_social : null;
        $Hijos =                    (isset($this->datosObtenidos->Datos->Hijos)) ? $this->datosObtenidos->Datos->Hijos : null;
        $Estado_civil =             (isset($this->datosObtenidos->Datos->Estado_civil)) ? $this->datosObtenidos->Datos->Estado_civil : null;
        $Datos_persona_contacto =   (isset($this->datosObtenidos->Datos->Datos_persona_contacto)) ? $this->datosObtenidos->Datos->Datos_persona_contacto : null;
        $Datos_bancarios =          (isset($this->datosObtenidos->Datos->Datos_bancarios)) ? $this->datosObtenidos->Datos->Datos_bancarios : null;
        $Periodo_liquidacion_sueldo = (isset($this->datosObtenidos->Datos->Periodo_liquidacion_sueldo)) ? $this->datosObtenidos->Datos->Periodo_liquidacion_sueldo : null;
        $Horario_laboral =          (isset($this->datosObtenidos->Datos->Horario_laboral)) ? $this->datosObtenidos->Datos->Horario_laboral : null;
        $Observaciones =            (isset($this->datosObtenidos->Datos->Observaciones)) ? $this->datosObtenidos->Datos->Observaciones : null;

        $fecha = date("Y-m-d");

        $data = array(
                        
                    'Nombre' => 			        $this->datosObtenidos->Datos->Nombre_principal,
                    'DNI' => 				        $this->datosObtenidos->Datos->DNI,
                    'CUIT_CUIL' => 			        $CUIT_CUIL,
                    'Pass' => 				        $this->datosObtenidos->Datos->Pass,
                    'Rol_acceso' => 		        $this->datosObtenidos->Datos->Rol_acceso,
                    //'Empresa_id' => 		        $this->datosObtenidos->Datos->Empresa_id,
                    //'Puesto_Id' => 		        $this->datosObtenidos->Datos->Puesto_Id,
                    'Telefono' => 			        $this->datosObtenidos->Datos->Telefono,
                    'Fecha_nacimiento' => 	        $Fecha_nacimiento,
                    'Domicilio' => 			        $Domicilio,
                    'Nacionalidad' => 		        $Nacionalidad,
                    'Genero' => 			        $Genero,
                    'Email' => 				        $this->datosObtenidos->Datos->Email,
                    'Obra_social' => 		        $Obra_social,
                    'Numero_obra_social' =>         $Numero_obra_social,
                    'Hijos' => 				        $Hijos,
                    'Estado_civil' => 		        $Estado_civil,
                    'Datos_persona_contacto' => 	$Datos_persona_contacto,
                    'Datos_bancarios' => 			$Datos_bancarios,
                    'Periodo_liquidacion_sueldo' => $Periodo_liquidacion_sueldo,
                    'Horario_laboral' => 			$Horario_laboral,
                    //'Lider' => 				    $this->datosObtenidos->Datos->Lider,
                    //'Superior_inmediato' =>       $this->datosObtenidos->Datos->Superior_inmediato,
                    'Fecha_alta' => 		        $Fecha_alta,
                    'Observaciones' => 		        $Observaciones,
                    
                    'Presencia' =>                  1,
                    'Visible' => 			        1,
                    'Ultimo_editor_id' => 		    $this->session->userdata('Id') 
                    
                );

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_usuarios');
                
        if ($insert_id >=0 ) 
        {   
            echo json_encode(array("Id" => $insert_id));         
        } 
        else 
        {
            echo json_encode(array("Id" => 0));
        }
    }

//// USUARIOS 	    | DESACTIVAR USUARIO
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
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_usuarios');
                
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

//// FORMACIONES 	| OBTENER FORMACIONES
    public function obtener_formaciones()
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

        $this->db->select('tbl_usuarios_formacion.*');
        $this->db->from('tbl_usuarios_formacion');
        $this->db->where('Usuario_id', $Id);
        $this->db->order_by("Anio_inicio", "asc");
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// FORMACIONES 	| CARGAR O EDITAR FORMACION
    public function cargar_formacion()
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

            'Titulo' => $this->datosObtenidos->Datos->Titulo,
            'Usuario_id' => $_GET["Id"],
            'Establecimiento' => $this->datosObtenidos->Datos->Establecimiento,
            'Anio_inicio' => $this->datosObtenidos->Datos->Anio_inicio,
            'Anio_finalizado' => $this->datosObtenidos->Datos->Anio_finalizado,
            'Descripcion_titulo' => $this->datosObtenidos->Datos->Descripcion_titulo,
        );

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_usuarios_formacion');

        if ($insert_id >= 0) {
            echo json_encode(array("Id" => $insert_id));
        } else {
            echo json_encode(array("Id" => 0));
        }
    }




    

//// EMPRESAS 	| OBTENER 
	public function obtener_empresas()
    {
			
        //Esto siempre va es para instanciar la base de datos
        $CI =& get_instance();
        $CI->load->database();
		$token = @$CI->db->token;


		$this->db->select('*');
		$this->db->from('tbl_empresas');
		$this->db->order_by("Nombre_empresa", "asc");
        $query = $this->db->get();
		$result = $query->result_array();

		echo json_encode($result);
		
    }

//// EMPRESAS 	| CARGAR O EDITAR EMPRESA
    public function cargar_empresa()
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
        if (isset($this->datosObtenidos->Data->Id)) {
            $Id = $this->datosObtenidos->Data->Id;
        }

        $data = array(

            'Nombre_empresa' => $this->datosObtenidos->Data->Nombre_empresa,
            'Descripcion' => $this->datosObtenidos->Data->Descripcion,

        );

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_empresas');

        if ($insert_id >= 0) {
            echo json_encode(array("Id" => $insert_id));
        } else {
            echo json_encode(array("Id" => 0));
        }
    }

//// PUESTOS 	| OBTENER 
	public function obtener_puestos()
    {
			
        //Esto siempre va es para instanciar la base de datos
        $CI =& get_instance();
        $CI->load->database();
		$token = @$CI->db->token;


		$this->db->select('*');
		$this->db->from('tbl_puestos');
		$this->db->order_by("Nombre_puesto", "asc");
        $query = $this->db->get();
		$result = $query->result_array();

		echo json_encode($result);
		
    }

//// PUESTOS 	| CARGAR O EDITAR
    public function cargar_puesto()
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
        if (isset($this->datosObtenidos->Data->Id)) {
            $Id = $this->datosObtenidos->Data->Id;
        }

        $data = array(

            'Nombre_puesto' =>  $this->datosObtenidos->Data->Nombre_puesto,
            'Descripcion' =>    $this->datosObtenidos->Data->Descripcion,

        );

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_puestos');

        if ($insert_id >= 0) {
            echo json_encode(array("Id" => $insert_id));
        } else {
            echo json_encode(array("Id" => 0));
        }
    }


//// USUARIOS 	| OBTENER 
	public function usuario_existe($DNI)
    {
			
        //Esto siempre va es para instanciar la base de datos
        $CI =& get_instance();
        $CI->load->database();
		$token = @$CI->db->token;


		$this->db->select('Id');
        $this->db->from('tbl_usuarios');
        $this->db->where('DNI', $DNI);

        $query = $this->db->get();
		$result = $query->result_array();

        if ($query->num_rows() > 0) 
        {
            $result = $query->row_array()['Id'];
        } else {
            $result = null;
        }
        
        return $result;
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

        $this->db->select(' tbl_usuarios_seguimiento.*,
                            tbl_usuarios.Nombre');
        
        $this->db->from('tbl_usuarios_seguimiento');
        $this->db->join('tbl_usuarios', 'tbl_usuarios.Id = tbl_usuarios_seguimiento.Usuario_id', 'left');

        $this->db->where('tbl_usuarios_seguimiento.Usuario_seguimiento_id', $Id);
        $this->db->where('tbl_usuarios_seguimiento.Visible', 1);

        $this->db->order_by('tbl_usuarios_seguimiento.Id', 'desc');
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

            'Usuario_seguimiento_id' =>     $this->datosObtenidos->Id,
            'Fecha' =>                      $this->datosObtenidos->Datos->Fecha,
            'Descripcion' =>                $this->datosObtenidos->Datos->Descripcion,
            'Usuario_id' =>                 $this->session->userdata('Id'),
            'Visible' =>                    1

        );
        //

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_usuarios_seguimiento');

        if ($insert_id >= 0) {
            echo json_encode(array("Id" => $insert_id));
        } else {
            echo json_encode(array("Id" => 'Error'));
        }
    }

//// SEGUIMIENTOS 	| SUBIR FOTO 
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
                        'Url_archivo' =>		$nombre_archivo,
                    );

                    $this->load->model('App_model');
                    $insert_id = $this->App_model->insertar($data, $Id, 'tbl_usuarios_seguimiento');
                    
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
