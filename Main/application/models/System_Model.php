<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_Model extends CI_Model {

    public function add_user($email, $password, $salt, $role)
        {

            $data = array(
                'email'       => $email,
                'password'    => password_hash($salt.$password, CRYPT_BLOWFISH),
                'salt'        => strrev($salt),
                'role_id'     => $role
            );

            $this->db->insert('tbl_login', $data);

            return $this->db->insert_id();

        }

    # Checks the user details table for unchanged/existing data
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

    public function check_password($email, $password)
    {
        $info = $this->db->select('id, password, salt')
                    -> where('email', $email)
                    ->get('tbl_login')
                    ->row_array();
                    #streev = reverse string
        $checkstr = strrev($info['salt']).$password;
        #?= if
        #$info['id'] : False ; = $info['id'] = true  False ; = false
        return password_verify($checkstr,$info['password']) ? $info['id'] : FALSE ;
    }

    #write the login data and retrieve user's info
    public function set_login_data($id, $code)
    {

        #1. write the login information or stop the code Here
        if(!$this->persist($id, $code))
        {
            return FALSE;
        }

        return $this->db->select('  tbl_login.id,
                                    tbl_roles.name AS role,
                                    tbl_login.email,
                                    tbl_userdetails.name,
                                    tbl_userdetails.surname,
                                    tbl_userdetails.about,
                                    tbl_userdetails.mobile,
                                    tbl_login_info.persistence AS session_code')
                                ->join('tbl_userdetails', 'tbl_userdetails.	tbl_Login_id = tbl_login.id', 'left')
                                ->join('tbl_login_info', 'tbl_login_info.tbl_Login_id = tbl_login.id', 'left')
                                ->join('tbl_roles','tbl_roles.id = tbl_login.role_id', 'left')
                                ->where('tbl_login.id', $id)
                                ->get('tbl_login')
                                ->row_array();
    }

    #writes the login information to the database
    public function persist($id, $code)
    {
        $data= array(
            'tbl_Login_id' => $id,
            'login_time' => time(),
            'persistence' => $code
        );
        $this->db->insert('tbl_login_info', $data);

        return $this->db->affected_rows() == 1;
    }

    public function check_data($id, $email,$code)
    {
        $data = array(
            'tbl_login.id'                         => $id,
            'tbl_login.email'                  =>$email,
            'tbl_login_info.persistence'      =>$code
        );

        return $this->db->select('tbl_login.id')
                       ->join('tbl_login_info', 'tbl_login_info.tbl_Login_id = tbl_login.id','left')
                        ->get_where('tbl_login', $data)
                        ->num_rows() == 1;
    }

    public function delete_session($id, $code)
    {
        $data = array(
            'tbl_Login_id' => $id,
            'persistence'  => $code
        );

        $this->db->delete('tbl_login_info', $data);

    }

    public function select_role() {

		// these lines are preparing the
		// query to be run.
		$courses = $this->db->select('id, name')
            				 ->order_by('name', 'asc')
                             ->get('tbl_roles');

        $array = [];
        foreach ($courses->result_array() as $row)
        {
            $array[$row['id']] = $row['name'];
        }

        return $array;

	}


}
