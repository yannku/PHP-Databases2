<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PortfolioUpload extends MY_Controller {
#multiple file upload
function form()
    {
        $this->load->helper(['form', 'url']);

        $data = array(
            'form'  => array(
                'Files'      => array(
                    'type'          => 'file',
                    'name'          => 'images[]',
                    'multiple'      => NULL,
                    'accept-type'   => 'image/*'
                )
            )
        );

        $this->load->view('portfolio-upload', $data);
    }

    function submit()
{

    $user_id = 1; // this can come from the session.
    
    # Configuration - generic for all images to upload.
    $config['upload_path']      = './uploads/portfolio/';
    $config['allowed_types']    = 'gif|jpg|png';
    $config['max_size']         = 10240;
    $config['max_width']        = 4000;
    $config['max_width']        = 4000;

    # Start the library with the above config setup.
    $this->load->library('upload', $config);

    # Create a new "name" in the $_FILES submission.
    # This is to separate all the items for upload.
    $_FILES['single-image'] = array();

    # Loop through all the images uploaded.
    # The attributes are all collected in their own definitions (name, type, etc.)
    for ($i = 0; $i < count($_FILES['images']['name']); $i++)
    {
        $config['file_name'] = "{$user_id}_{$i}";
        $this->upload->initialize($config);

        # Here, recreate a single submission for each of the images uploaded.
        foreach ($_FILES['images'] as $key => $value)
            $_FILES['single-image'][$key] = $value[$i];

        # Upload the new "single-image" name, which we have just created by hand.
        if (!$this->upload->do_upload('single-image'))
        {
            # If the file didn't upload, here's an error.
            echo $this->upload->display_errors(), "<br>";
        }
        else
        {
            # If the file was uploaded, then we're all good.
            echo "{$_FILES['single-image']['name']} uploaded!", "<br>";
        }
    }

}
}
