<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{

//// BLOG         | VISTA | LISTADO
    public function index()
    {
		
			
				$data = array(
                    "body_class" => 'class="courses-page"',
                    "div_inicial_class" => 'class="page-header"',
					"TituloPagina" => "Blog",
					"Descripcion" => "Blog de información sobre cursos online del instituto JLC",
				);
				$this->load->view('blog_listado',$data);
			
			
        
    }


//// BLOG CURSADO | VISTA | DATOS
    public function entrada()
    {   

        
            /// REALIZO LA BUSQUEDA PRIMERO PARA PODER URGAR ALGUNOS DATOS NECESARIOS A SABER
            //Esto siempre va es para instanciar la base de datos
            $CI = &get_instance();
            $CI->load->database();

            $Id = $_GET["Id"];

            ////BUSCANDO DATOS DEL ENTRADA
                $this->db->select('*');
                $this->db->from('tbl_blog');
                
                $this->db->where('Id', $Id);
                $query = $this->db->get();
                $result = $query->result_array();
            
            $data = array(
                "body_class" => ' class="single-courses-page"',
                "div_inicial_class" => 'class="page-header"',
                "TituloPagina" => $result[0]["Titulo_curso"],
                "Entrada" => $result[0],
                "Descripcion" => $result[0]["Copete"],
                "Imagen" => $result[0]["Imagen"],
            );
             
            $this->load->view('blog_entrada', $data);
                      
    }
    


//// BLOG	        | OBTENER LISTADO PRINCIPAL
	public function obtener_listado_principal()
    {
			
        //Esto siempre va es para instanciar la base de datos
        $CI =& get_instance();
        $CI->load->database();
		//Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) { exit("No coinciden los token"); }
        
        
        $this->db->select(' *');
        $this->db->from('tbl_blog');
        $this->db->order_by('Fecha_ult_actualizacion', 'desc');

        $query = $this->db->get();
        $result = $query->result_array();

		echo json_encode($result);
		
    }

//// BLOG	        | OBTENER LISTADO PRINCIPAL
    public function obtener_listado_noticias_index()
    {
            
        //Esto siempre va es para instanciar la base de datos
        $CI =& get_instance();
        $CI->load->database();
        //Seguridad
        $token = @$CI->db->token;
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
        if ($this->datosObtenidos->token != $token) { exit("No coinciden los token"); }
        
        
        $this->db->select(' *');
        $this->db->from('tbl_blog');
        $this->db->limit(3);  // Produces: LIMIT 10
        $this->db->order_by('Fecha_ult_actualizacion', 'desc');

        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);
        
    }

//// BLOG	        | CARGAR O EDITAR
    public function crear_entrada()
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
        
        $Titulo_curso =     (isset($this->datosObtenidos->Datos->Titulo_curso)) ? $this->datosObtenidos->Datos->Titulo_curso : null;
        $Copete =           (isset($this->datosObtenidos->Datos->Copete)) ? $this->datosObtenidos->Datos->Copete : null;
        $Contenido =        (isset($this->datosObtenidos->Datos->Contenido)) ? $this->datosObtenidos->Datos->Contenido : null;
        $Usuario_creador_id = (isset($this->datosObtenidos->Datos->Usuario_creador_id)) ? $this->datosObtenidos->Datos->Usuario_creador_id : $this->session->userdata('Id');

        $data = array(
                        
                    'Titulo_curso' => 			    $Titulo_curso,
                    'Copete' => 	                $Copete,
                    'Contenido' => 			        $Contenido,
                    'Usuario_creador_id' => 		$Usuario_creador_id,
                    'Ult_usuario_id' => 		    $this->session->userdata('Id'),
                    'Visible' => 			        1,
                    
                );

        $this->load->model('App_model');
        $insert_id = $this->App_model->insertar($data, $Id, 'tbl_blog');
                
        if ($insert_id >=0 ) 
        {   
            echo json_encode(array("Id" => $insert_id));         
        } 
        else 
        {
            echo json_encode(array("Id" => 0));
        }
    }
    
//// BLOG 	    | SUBIR ARCHIVO 
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
                        'Imagen' =>	$nombre_archivo,
                    );

                    $this->load->model('App_model');
                    $insert_id = $this->App_model->insertar($data, $Id, 'tbl_blog');
                    
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
        echo json_encode(array('status' => $status, 'Imagen' => $nombre_archivo));
    }
    
///// fin documento
}
