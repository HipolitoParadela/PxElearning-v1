<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function index()
    {

        $data = array(
            "body_class" => '',
            "div_inicial_class" => 'class="hero-content"',
            "TituloPagina" => "Iniciar Sesión",
            "Descripcion" => "Cursos de formación Online del Instituto Jerónimo Luis de Caberar Río Segundo, certificados por el Concejo Provincial de Informática de Córdoba y por la UTN Córdoba",
        );
        $this->load->view('login', $data);
    }

    public function iniciar_session()
    {
        $dni = $this->input->post('dni');
        $Pass = $this->input->post('Pass');

        $this->load->model('user');
        $fila = $this->user->getUser($dni);

        if ($fila != null) //// si el usuario existe
        {
            if ($fila->Pass == $Pass) /// si la contraseña es correcta
            {
                if ($fila->Rol_acceso >= 4) /// si es admin
                {
                    $data = array(
                        'Nombre'        => $fila->Nombre,
                        'Id'            => $fila->Id,
                        'Login'         => true,
                        'Rol_acceso'    => $fila->Rol_acceso,
                        'Imagen'        => $fila->Imagen,
                    );

                    $this->session->set_userdata($data);

                    header("Location: " . base_url() . "dashboard");
                } else /// si no es admin
                {
                    if ($fila->Presencia == 1) /// si tiene activo el control de presencia y con un rol distinto a 1 y a 5
                    {
                        $data = array(
                            'Nombre' => $fila->Nombre,
                            'Id' => $fila->Id,
                            'Login' => true,
                            'Rol_acceso' => $fila->Rol_acceso,
                            'Imagen'    => $fila->Imagen,
                        );

                        $this->session->set_userdata($data);

                        header("Location: " . base_url() . "dashboard");
                    } else /// si tiene NO esta activo el control de presencia
                    {
                        header("Location: " . base_url() . "login?Error=3");
                    }
                }
            } else /// si la contraseña NO es correcta
            {
                header("Location: " . base_url() . "login?Error=1");
            }
        } else //// si el usuario NO existe
        {
            header("Location: " . base_url() . "login?Error=2");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        header("Location: " . base_url() . "login"); /// enviar a pagina de error

    }

//// INICIAR SESIÓN DESDE GOOGLE
    public function iniciar_session_google()
    {
        

        /// TOMANDO DATOS ENVIADOS POR AJAX
            $datos_ajax = array(
                'Nombre'       => $this->input->get('Name'),
                'Google_id'    => $this->input->get('Google_id'),
                'Login'        => true,
                'Imagen'       => $this->input->get('Image_URL'),
                'Email'        => $this->input->get('Email'),
            );

        /// CONSULTANDO EN BASE DE DATOS SI EXISTE UN REGISTRO CON EL MISMO Google_id o el mismo email
            //Esto siempre va es para instanciar la base de datos
            $CI = &get_instance();
            $CI->load->database();

            $this->db->select('*');
            $this->db->from('tbl_usuarios');
            
            $this->db->where('Email', $this->input->get('Email'));
            
            $query = $this->db->get();
            $result = $query->result_array();
            $cant = $query->num_rows();
            
            // SI ENCUENTRA, LO ENVÍA AL DASHBOARD DE USUARIOS, PERO ADEMAS INTENTA UNIFICAR DATOS, agregando mail o google id si les falta
                if($cant > 0)
                {
                    $data = array(
                        'Nombre'        => $result[0]["Nombre"],
                        'Id'            => $result[0]["Id"],
                        
                        'Login'         => true,
                        'Rol_acceso'    => $result[0]["Rol_acceso"],
                        'Imagen'        => $result[0]["Imagen"],
                    );

                    $this->session->set_userdata($data);

                    //header("Location: " . base_url() . "dashboard");
                    echo json_encode(array("Estado" => TRUE));
                    
                }

                else
                {
                    /// SI NO LO ENCUENTRA, LO DEBE REGISTRAR
                    $fecha = date("Y-m-d");

                    $data = array(
                                    
                                'Nombre' => 			        $this->input->get('Name'),
                                'Google_id' => 			        $this->input->get('Google_id'),
                                'Imagen' => 			        $this->input->get('Image_URL'),
                                'Rol_acceso' => 		        1,
                                'Email' => 				        $this->input->get('Email'),
                                'Fecha_alta' => 		        $fecha,
                                'Presencia' =>                  1,
                                'Visible' => 			        1,
                                
                            );
            
                    $this->load->model('App_model');
                    $insert_id = $this->App_model->insertar($data, null, 'tbl_usuarios');
                            
                    if ($insert_id >=0 ) 
                    {   
                        //echo json_encode(array("Id" => $insert_id));
                        
                        $data = array(
                            'Nombre'        => $this->input->get('Name'),
                            'Id'            => $insert_id,
                            
                            'Login'         => true,
                            'Rol_acceso'    => 1,
                            'Imagen'        => $this->input->get('Image_URL'),
                            
                        );
        
                        $this->session->set_userdata($data);
        
                        ///header("Location: " . base_url() . "dashboard");
                        echo json_encode(array("Estado" => TRUE));

                    } 
                    else 
                    {
                        echo json_encode(array("Estado" => FALSE));
                    }

                }
        

        //echo json_encode($datos_ajax);

        
        /* $dni = $this->input->post('dni');
        $Pass = $this->input->post('Pass');

        $this->load->model('user');
        $fila = $this->user->getUser($dni);

        if ($fila != null) //// si el usuario existe
        {
            if ($fila->Pass == $Pass) /// si la contraseña es correcta
            {
                if ($fila->Rol_acceso >= 4) /// si es admin
                {
                    $data = array(
                        'Google_id'        => $fila->Nombre,
                        'Id'            => $fila->Id,
                        'Login'         => true,
                        'Rol_acceso'    => $fila->Rol_acceso,
                        'Imagen'        => $fila->Imagen,
                    );

                    $this->session->set_userdata($data);

                    header("Location: " . base_url() . "dashboard");
                } else /// si no es admin
                {
                    if ($fila->Presencia == 1) /// si tiene activo el control de presencia y con un rol distinto a 1 y a 5
                    {
                        $data = array(
                            'Nombre' => $fila->Nombre,
                            'Id' => $fila->Id,
                            'Login' => true,
                            'Rol_acceso' => $fila->Rol_acceso,
                            'Imagen'    => $fila->Imagen,
                        );

                        $this->session->set_userdata($data);

                        header("Location: " . base_url() . "dashboard");
                    } else /// si tiene NO esta activo el control de presencia
                    {
                        header("Location: " . base_url() . "login?Error=3");
                    }
                }
            } else /// si la contraseña NO es correcta
            {
                header("Location: " . base_url() . "login?Error=1");
            }
        } else //// si el usuario NO existe
        {
            header("Location: " . base_url() . "login?Error=2");
        } */
    }
}
