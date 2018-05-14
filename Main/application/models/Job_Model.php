<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Model extends CI_Model {

    public function add_vacancies($j_name, $j_desc, $j_url, $tbl_jroles_id) {

        $data = array(
            'j_name'		      => $j_name,
            'j_desc'		      => $j_desc,
            'j_url'     	      => $j_url,
            'tbl_jroles_id'		  => $tbl_jroles_id
        );

        // An INSERT query:
        // INSERT INTO tbl_users (cols) VALUES (cols)
        $this->db->insert('tbl_job', $data);

        // gives us whatever the primary key (AI) value is
        return $this->db->insert_id();

    }

    public function all_vacancies() {

        // these lines are preparing the
        // query to be run.
        $this->db->select('*')
                 ->order_by('j_name', 'asc');

        // run the query using the parameters
        // above and below.
        return $this->db->get('tbl_job');

    }

    public function get_job($id) {

        // run a query and return the row immediately
        return $this->db->select('*')
                        ->where('id', $id)
                        ->get('tbl_job')
                        ->row_array();

    }

    public function update_job($id, $j_name, $j_desc, $j_url, $tbl_jroles_id) {

        if ($this->check_job($id, $j_name, $j_desc, $j_url, $tbl_jroles_id)) {
            return TRUE;
        }

        // this is the data that needs to change
        $data = array();
        if (!empty($j_name)) $data['j_name'] = $j_name;
        if (!empty($j_desc)) $data['j_desc'] = $j_desc;
        if (!empty($j_url)) $data['j_url'] = $j_url;
        if (!empty($tbl_jroles_id)) $data['tbl_jroles_id'] = $tbl_jroles_id;

        // this is the entire update query
        $this->db->where('id', $id)
                 ->update('tbl_job', $data);

        // TRUE or FALSE if there has been a change
        return $this->db->affected_rows() == 1;

    }

    public function check_job($id, $j_name, $j_desc, $j_url, $tbl_jroles_id) {

        // this is the data that needs to change
        $data = array('id'  => $id);
        if (!empty($j_name)) $data['j_name'] = $j_name;
        if (!empty($j_desc)) $data['j_desc'] = $j_desc;
        if (!empty($j_url)) $data['j_url'] = $j_url;
        if (!empty($tbl_jroles_id)) $data['tbl_jroles_id'] = $tbl_jroles_id;

        // TRUE or FALSE if there has been a change
        return $this->db->get_where('tbl_job', $data)->num_rows() == 1;

    }

    public function unique_job($id, $j_name) {

        $data = array(
            'id !='     => $id,
            'j_name'     => $j_name
        );

        // will give me a true or false depending
        // on what comes up from the query
        return $this->db->get_where('tbl_job', $data)->num_rows() == 0;

    }
}
