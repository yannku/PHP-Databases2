<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MY_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

        public function index()
        {
            $this->load->view('upload_form', array('error' => ' ' ));
        }

        public function do_upload($name) {
            $config['file_name']            = $name;
            $config['upload_path']          = './uploads/images/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('upload_form', $error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());

                    $this->load->view('upload_success', $data);
            }
        }

        public function upload(){
            // jekk il-user ghazel file, ha jitla
            // u jekk le, ha jaqbzu
            if ($_FILES['userfile']['name'] !='')
            {
                //upload here
                $this->do_upload('hello', "image");
            }
        }

        public function forms(){

            $this->build('forms');
        }

        public function uploadform(){

            $this->build('upload_form');
        }

        public function timetable(){

            $this->build('timetable');
        }

        public function calendar(){

            $this->build('calender');
        }

}
?>
