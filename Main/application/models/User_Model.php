<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model {

    public function check_user_details( $name, $surname)
    {

        $data = array(
            'name'          => $name,
            'surname'       => $surname
        );

        return $this->db->get_where('tbl_userdetails', $data)->num_rows() == 1;
    }

    # Associate user details with the login data
    public function user_details($id, $name, $surname)
    {
        if ($this->check_user_details($id, $name, $surname))
        {
            return TRUE;
        }

        $data = array(
            'tbl_Login_id' => $id,
            'name'        => $name,
            'surname'     => $surname
        );

        $this->db->insert('tbl_userdetails', $data);

        return $this->db->affected_rows() == 1;
    }

    # Deletes a user from the database
    public function delete_user($id)
    {
        $this->db->delete('tbl_login', array('id' => $id));
    }


    #write the login data and retrieve user's info
    public function set_user($id)
    {

        return $this->db->select('  tbl_login.id,
                                    tbl_roles.name AS role,
                                    tbl_login.email,
                                    tbl_userdetails.name,
                                    tbl_userdetails.surname,
                                    tbl_userdetails.mobile,
                                    tbl_userdetails.about')

                                ->join('tbl_userdetails', 'tbl_userdetails.	tbl_Login_id = tbl_login.id', 'left')
                                ->join('tbl_roles','tbl_roles.id = tbl_login.role_id', 'left')
                                ->where('tbl_login.id', $id)
                                ->get('tbl_login')
                                ->row_array();
    }



    public function check_data($id, $email,$code)
    {
        $data = array(
            'tbl_login.id'                         => $id,
            'tbl_login.email'                  =>$email,
            'tbl_login_info.persistence'      =>$code
        );

        return $this->db->select('tbl_login.id')
                       ->join('tbl_login_info', 'tbl_login_info.user_id = tbl_login.id','left')
                        ->get_where('tbl_login', $data)
                        ->num_rows() == 1;
    }


    public function all_users() {

        // these lines are preparing the
        // query to be run.
        $this->db->select('*')
                 ->order_by('role_id', 'asc');

        // run the query using the parameters
        // above and below.
        return $this->db->get('tbl_login');
    }



    public function update_user($id, $name, $surname, $email, $about, $mobile) {
        $data = array(
            'email'                   =>$email
        );

        $this->db->where('id', $id)
            ->update('tbl_login', $data);

        $data = array(
            'name'              =>$name,
            'surname'           =>$surname,
            'mobile'            =>$mobile,
            'about'             =>$about
        );

        $this->db->where('tbl_login_id', $id)
            ->update('tbl_userdetails', $data);
    }

}
