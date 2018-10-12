<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Rule_inferensi_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all($limit, $uri) {

        $result = $this->db->get('rule_inferensi', $limit, $uri);
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }
    
    function get_one($id_peny_gejala) {
        $this->db->where('id_peny_gejala', $id_peny_gejala);
        $result = $this->db->get('rule_inferensi');
        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    function save() {
           $data = array(
        
            'id_penyakit' => $this->input->post('id_penyakit', TRUE),
           
            'id_gejala' => $this->input->post('id_gejala', TRUE),
            // 'densitas' => $this->input->post('densitas', TRUE),
           
            'datetime' => date('Y-m-d H:i:s'),
           
        );
        $this->db->insert('rule_inferensi', $data);
    }

    function update($id_peny_gejala) {
        $data = array(
        // 'id_peny_gejala' => $this->input->post('id_peny_gejala',TRUE),
       'id_penyakit' => $this->input->post('id_penyakit', TRUE),
       
       'id_gejala' => $this->input->post('id_gejala', TRUE),
       // 'densitas' => $this->input->post('densitas', TRUE),
       
       'datetime' => date('Y-m-d H:i:s'),
       
        );
        $this->db->where('id_peny_gejala', $id_peny_gejala);
        $this->db->update('rule_inferensi', $data);
        /*'datetime' => date('Y-m-d H:i:s'),*/
    }

    function delete($id_peny_gejala) {
        $this->db->where('id_peny_gejala', $id_peny_gejala);
        $this->db->delete('rule_inferensi'); 
       
    }

    //Update 07122013 SWI
    //untuk Array Dropdown
    function get_dropdown_array($value){
        $result = array();
        $array_keys_values = $this->db->query('select id_peny_gejala, '.$value.' from rule_inferensi order by id_peny_gejala asc');
        $result[0]="-- Pilih Urutan id_peny_gejala --";
        foreach ($array_keys_values->result() as $row)
        {
            $result[$row->id_peny_gejala]= $row->$value;
        }
        return $result;
    }

    //Update 30122014 SWI
    //untuk Array Dropdown dari database yang lain
    function get_drop_array($db,$key,$value){
        $result = array();
        $array_keys_values = $this->db->query('select '.$key.','.$value.' from '.$db.' order by '.$key.' asc');
        $result[0]="-- Pilih ".$value." --";
        foreach ($array_keys_values->result() as $row)
        {
            $result[$row->$key]= $row->$value;
        }
        return $result;
    }
    
}
?>
