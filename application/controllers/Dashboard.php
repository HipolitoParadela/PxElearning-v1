<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        if ($this->session->userdata('Login') != true) 
		{
            header("Location: " . base_url() . "login"); /// enviar a pagina de error
		} 
		else 
		{            
            // Si es profe o admin muestra este
            if($this->session->userdata('Rol_acceso') > 2 )
            {
                $data = array(
                    "body_class" => 'class="courses-page"',
                    "div_inicial_class" => 'class="page-header"',
                    "TituloPagina" => "Dashboard",
                    "Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
                );
                $this->load->view('dashboard', $data);
            }
            // Si es alumno, muestra otro
            else
            {   
                $compra = false;
                $datos_curso = null;

                /// SI DETECTA UNA VARIABLE GET, GENERA 
                if(isset($_GET["collection_id"]))
                {
                    $compra = true;
                    
                    // Cargo en base de datos al alumno con el curso comprado
                    $Profesor_id = null;              
                    $Fecha_inicio = date("Y-m-d");  
                    $Fecha_finalizacion = null;    

                    if($_GET["collection_status"] == 'approved')  
                    {
                        $Estado = 1; 
                    }
                    else
                    {
                        $Estado = 0; 
                    }                   
                    
                    $Nota_final = null;             
                    $Medio_pago = 'Mercado Pago - '.$_GET["payment_type"];          
                    $Url_archivo = null;          
                    $Observaciones = null;          
                    $Usuario_creador_id = $this->session->userdata('Id');     
                    
                        $data = array(

                            'Curso_id' =>           $_GET["external_reference"],
                            'Profesor_id' =>        $Profesor_id,
                            'Alumno_id' =>          $this->session->userdata('Id'),
                            'Fecha_inicio' =>       $Fecha_inicio,
                            'Fecha_finalizacion' => $Fecha_finalizacion,
                            'Estado' =>             $Estado,
                            'Nota_final' =>         $Nota_final,
                            'Medio_pago' =>         $Medio_pago,
                            'Url_archivo' =>        $Url_archivo,
                            'Observaciones' =>      $Observaciones,
                            'Usuario_creador_id' => $Usuario_creador_id,
                            'Ult_usuario_id' =>     $this->session->userdata('Id'),
                            'Visible' =>    1
                        );
                
                        $this->load->model('App_model');
                        $insert_id = $this->App_model->insertar($data, null, 'tbl_cursos_alumnos');
                
                        if ($insert_id >= 0) 
                        {
                            
                        } 
                        else 
                        {
                            
                        }

                        // me traigo datos del curso tambien
                        $this->db->select('*');
                        $this->db->from('tbl_cursos');
                        $this->db->where('Id', $_GET["external_reference"]);
                        $query = $this->db->get();
                        $datos_curso = $query->result_array();
                        

                        /* 
                        ARMAR DONDE GUARDAR ESTOS DATOS

                        echo $_GET["collection_id"];
                        echo $_GET["collection_status"];
                        echo $_GET["preference_id"]; 
                        echo $_GET["payment_type"];
                        echo $_GET["merchant_order_id"]; */
                    }

                $data = array(
                    "body_class" => 'class="courses-page"',
                    "div_inicial_class" => 'class="page-header"',
                    "TituloPagina" => "Bienvenido a su panel",
                    "Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
                    "Compra" => $compra,
                    "Datos_curso_comprado" => $datos_curso,
                );
                $this->load->view('dashboard_alumnos', $data);
            }
        }
    }
    
//// CURSOS	        | OBTENER DATOS
    public function obtener_alumnos_curzando()
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

        
        $this->db->select('	tbl_cursos.Id as Curso_id,
                            tbl_cursos.Titulo_curso,
                            tbl_cursos_alumnos.Id,
                            tbl_cursos_alumnos.Alumno_id,
                            tbl_cursos_alumnos.Fecha_inicio,
                            tbl_alumno.Nombre as Nombre_alumno,
                            tbl_alumno.Imagen,
                            tbl_alumno.Telefono,
                            tbl_profesor.Nombre as Nombre_profesor'); // BUSCAR SOLO DATOS NECESARIOS
        
        $this->db->from('tbl_cursos_alumnos');
        
        $this->db->join('tbl_usuarios as tbl_alumno', 'tbl_alumno.Id = tbl_cursos_alumnos.Alumno_id', 'left');
        $this->db->join('tbl_usuarios as tbl_profesor', 'tbl_profesor.Id = tbl_cursos_alumnos.Profesor_id', 'left');
        $this->db->join('tbl_cursos', 'tbl_cursos.Id = tbl_cursos_alumnos.Curso_id', 'left');
        
        $this->db->where('tbl_cursos_alumnos.Estado <',  3);

        if($this->session->userdata('Rol_acceso') == 3 )
        {
            $this->db->where('tbl_cursos_alumnos.Profesor_id', $this->session->userdata('Id'));
        }
        
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// CURSOS	        | OBTENER MOVIMIENTOS EXAMEN
    public function obtener_movimientos_examenes()
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

        
        $this->db->select('	tbl_cursos.Titulo_curso,
                            tbl_cursos_examen_alumno.Fecha_ult_actualizacion,
                            tbl_cursos_examen_alumno.Id,
                            tbl_cursos_examen_alumno.Estado,
                            tbl_alumno.Nombre as Nombre_alumno,
                            tbl_profesor.Nombre as Nombre_profesor'); // BUSCAR SOLO DATOS NECESARIOS
        
        $this->db->from('tbl_cursos_examen_alumno');
        
        
        $this->db->join('tbl_cursos_alumnos', 'tbl_cursos_alumnos.Id = tbl_cursos_examen_alumno.Curso_alumno_id', 'left');

        $this->db->join('tbl_cursos', 'tbl_cursos.Id = tbl_cursos_alumnos.Curso_id', 'left');
        $this->db->join('tbl_usuarios as tbl_profesor', 'tbl_profesor.Id = tbl_cursos_alumnos.Profesor_id', 'left');
        $this->db->join('tbl_usuarios as tbl_alumno', 'tbl_alumno.Id = tbl_cursos_alumnos.Alumno_id', 'left');
        
        if($this->session->userdata('Rol_acceso') == 3 )
        {
            $this->db->where('tbl_cursos_alumnos.Profesor_id', $this->session->userdata('Id'));
        }
        $this->db->order_by("tbl_cursos_examen_alumno.Fecha_ult_actualizacion", "desc");

        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// CURSOS	        | OBTENER CANTIDAD INSCRIPTOS
    public function cantidad_inscriptos()
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
        
        $this->db->from('tbl_usuarios');
        $this->db->where('Rol_acceso',  2);

        $query = $this->db->get();
        $result = $query->result_array();
        $cant = $query->num_rows();

        echo json_encode($cant);

    }


//// CURSOS	        | OBTENER CANTIDAD DE CURSOS
    public function cantidad_cursos()
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

        $query = $this->db->get();
        $result = $query->result_array();
        $cant = $query->num_rows();

        echo json_encode($cant);

    }

//// CURSOS	        | OBTENER CANTIDAD DE PROFESORES
    public function cantidad_profesores()
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
        
        $this->db->from('tbl_usuarios');
        $this->db->where('Rol_acceso',  3);

        $query = $this->db->get();
        $result = $query->result_array();
        $cant = $query->num_rows();

        echo json_encode($cant);

    }

//// CURSOS	        | OBTENER CURSOS ACTIVOS
    public function cantidad_cursos_activos()
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
        
        $this->db->from('tbl_cursos_alumnos');
        $this->db->where('Estado <',  3);

        $query = $this->db->get();
        $result = $query->result_array();
        $cant = $query->num_rows();

        echo json_encode($cant);

    }


//// CURSOS	        | OBTENER CURSOS DE UN ALUMNO, ordenados por estado
    public function obtener_cursos_deun_alumno()
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

        
        $this->db->select('	tbl_cursos.Titulo_curso,
                            tbl_cursos_alumnos.Id,
                            tbl_cursos_alumnos.Estado,
                            tbl_cursos_alumnos.Alumno_id,
                            tbl_cursos_alumnos.Fecha_inicio,
                            tbl_cursos_alumnos.Fecha_finalizacion,
                            tbl_cursos_alumnos.Nota_final,
                            tbl_alumno.Nombre as Nombre_alumno,
                            tbl_cursos.Imagen,
                            tbl_profesor.Nombre as Nombre_profesor'); // BUSCAR SOLO DATOS NECESARIOS
        
        $this->db->from('tbl_cursos_alumnos');
        
        $this->db->join('tbl_usuarios as tbl_alumno', 'tbl_alumno.Id = tbl_cursos_alumnos.Alumno_id', 'left');
        $this->db->join('tbl_usuarios as tbl_profesor', 'tbl_profesor.Id = tbl_cursos_alumnos.Profesor_id', 'left');
        $this->db->join('tbl_cursos', 'tbl_cursos.Id = tbl_cursos_alumnos.Curso_id', 'left');
        
        $this->db->where('tbl_cursos_alumnos.Alumno_id',  $this->session->userdata('Id'));
        $this->db->order_by("tbl_cursos_alumnos.Fecha_inicio", "desc");
        
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }

//// USUARIOS 	    | OBTENER UN USUARIOS
    public function obtener_datos_usuario()
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


        $this->db->select('	tbl_usuarios.*,
                            tbl_usuarios.Nombre as Nombre_principal, 
                            tbl_roles.Nombre_rol'); // BUSCAR SOLO DATOS NECESARIOS
        $this->db->from('tbl_usuarios');
        $this->db->join('tbl_roles', 'tbl_roles.Acceso = tbl_usuarios.Rol_acceso', 'left');
        
        $this->db->where('tbl_usuarios.Id', $this->session->userdata('Id'));
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);

    }


/////////
}
