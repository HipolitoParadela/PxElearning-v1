<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elementoscomunes extends CI_Controller {

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
        $data = array(
            "TituloPagina" => "Cursos de formación Online, Instituto Jerónimo Luis de Caberar Río Segundo",
            "Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
        );
		$this->load->view('index', $data);
	}

	public function config()
	{   
        $data = array(
            "TituloPagina" => "Cursos de formación Online, Instituto Jerónimo Luis de Caberar Río Segundo",
            "Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
        );
		$this->load->view('config', $data);
	}

	 //// 			| ELIMINAR ALGO
	 public function eliminar()
	 {
		 $CI =& get_instance();
		 $CI->load->database();
		 
		 $token = @$CI->db->token;
		 $this->datosObtenidos = json_decode(file_get_contents('php://input'));
		 if ($this->datosObtenidos->token != $token)
		 { 
			 exit("No coinciden los token");
		 }
 
		 $Id = NULL;
		 $tabla = NULL;
 
		 if(isset($this->datosObtenidos->Id))
		 {
			 $Id = $this->datosObtenidos->Id;
		 }
 
		 if(isset($this->datosObtenidos->tabla))
		 {
			 $tabla = $this->datosObtenidos->tabla;
		 }
		 
		 $this->load->model('App_model');
		 $insert_id = $this->App_model->eliminar($Id, $tabla);
				 
	 }

//// IMAGENES
	public function subirImagen()
	{
		$status = "";
		$msg = "";
        $file_element_name = 'Archivo';
        $this->datosObtenidos = json_decode(file_get_contents('php://input'));
		
		if ($status != "error")
		{
			$config['upload_path'] = './uploads/imagenes';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 1024 * 8;
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
                    $Id 	= $_GET["Id"];
                    $tabla 	= $_GET["tabla"];
					
					$data = $this->upload->data();
					
					$file_info = $this->upload->data();
					$nombre_imagen = $file_info['file_name'];
					
					$data = array(    
						'Imagen' =>		$nombre_imagen,
					);

					$this->load->model('App_model');
					$insert_id = $this->App_model->insertar($data, $Id, $tabla);
					
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
		echo json_encode(array('status' => $status, 'Imagen' => $nombre_imagen));
    }
}
