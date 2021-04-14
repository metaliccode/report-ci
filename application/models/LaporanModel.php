<?php

class LaporanModel extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('tb_peserta')->result_array();
    }

    public function getAllbyid($id = 1)
    {
        $q = "SELECT duration_start, duration_end FROM tb_peserta WHERE
            id='$id' LIMIT 1";
        return $this->db->query($q)->result_array();
        // return $this->db->query($q)->num_rows();
    }

    public function getAlldate()
    {
        return $this->db->get('tb_durasi')->result_array();
    }
}
