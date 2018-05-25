<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_Model extends CI_Model {

    public function add_courses($c_name, $c_code, $c_duration, $c_mqf) {

        $data = array(
            'c_name'        => $c_name,
            'c_code'        => $c_code,
            'c_duration'   => $c_duration,
            'c_mqf'        => $c_mqf
        );

        // An INSERT query:
        // INSERT INTO tbl_users (cols) VALUES (cols)
        $this->db->insert('tbl_courses', $data);

        // gives us whatever the primary key (AI) value is
        return $this->db->insert_id();

    }

    public function all_courses() {

		// these lines are preparing the
		// query to be run.
		$this->db->select('*')
				 ->order_by('c_name', 'asc');

		// run the query using the parameters
		// above and below.
		return $this->db->get('tbl_courses');

	}

    public function all_courses_dropdown() {

		// these lines are preparing the
		// query to be run.
		$courses = $this->db->select('id, c_name')
            				 ->order_by('c_name', 'asc')
                             ->get('tbl_courses');

        $array = [];
        foreach ($courses->result_array() as $row)
        {
            $array[$row['id']] = $row['c_name'];
        }

        return $array;

	}

    public function all_applications() {

        // these lines are preparing the
        // query to be run.
        $this->db->select('*')
                 ->order_by('a_name', 'asc');

        // run the query using the parameters
        // above and below.
        return $this->db->get('tbl_courseapp');

    }

    public function get_course($id) {

        // run a query and return the row immediately
        return $this->db->select('*')
                        ->where('id', $id)
                        ->get('tbl_courses')
                        ->row_array();

    }

    public function get_applications($id) {

        // run a query and return the row immediately
        return $this->db->select('*')
                        ->where('id', $id)
                        ->get('tbl_courseapp')
                        ->row_array();

    }

    public function update_course($id, $c_name, $c_code, $c_duration, $c_mqf) {

        if ($this->check_course($id, $c_name, $c_code, $c_duration, $c_mqf)) {
            return TRUE;
        }

        // this is the data that needs to change
        $data = array();
        if (!empty($c_name)) $data['c_name'] = $c_name;
        if (!empty($c_code)) $data['c_code'] = $c_code;
        if (!empty($c_duration)) $data['c_duration'] = $c_duration;
        if (!empty($c_mqf)) $data['c_mqf'] = $c_mqf;

        // this is the entire update query
        $this->db->where('id', $id)
                 ->update('tbl_courses', $data);

        // TRUE or FALSE if there has been a change
        return $this->db->affected_rows() == 1;

    }

    public function check_course($id, $c_name, $c_code, $c_duration, $c_mqf) {

        // this is the data that needs to change
        $data = array('id'  => $id);
        if (!empty($c_name)) $data['c_name'] = $c_name;
        if (!empty($c_code)) $data['c_code'] = $c_code;
        if (!empty($c_duration)) $data['c_duration'] = $c_duration;
        if (!empty($c_mqf)) $data['c_mqf'] = $c_mqf;

        // TRUE or FALSE if there has been a change
        return $this->db->get_where('tbl_courses', $data)->num_rows() == 1;

    }

    public function unique_name($id, $c_name) {

        $data = array(
            'id !='     => $id,
            'c_name'     => $c_name
        );

        // will give me a true or false depending
        // on what comes up from the query
        return $this->db->get_where('tbl_courses', $data)->num_rows() == 0;

    }


    public function course_apply($a_name, $a_surname, $a_dob, $a_idnumber, $a_address, $a_mobile, $a_email, $a_nationality, $tbl_courses_id) {

        $data = array(
            'a_name'            => $a_name,
            'a_surname'         => $a_surname,
            'a_dob'             => $a_dob,
            'a_idnumber'        => $a_idnumber,
            'a_address'         => $a_address,
            'a_mobile'          => $a_mobile,
            'a_email'           => $a_email,
            'a_nationality'     => $a_nationality,
            'tbl_courses_id'    => $tbl_courses_id
        );

        // An INSERT query:
        // INSERT INTO tbl_users (cols) VALUES (cols)
        $this->db->insert('tbl_courseapp', $data);

        // gives us whatever the primary key (AI) value is
        return $this->db->insert_id();

    }
    public function delete_course($id)
    {
        $this->db->delete('tbl_courses', array('id' => $id));
    }
}
