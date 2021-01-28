<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_model extends CI_Model
{

    public function semua_pasien()
    {
        // $query = "SELECT * FROM `data_pasien` JOIN `huruf_b` ON `data_pasien`.`id` = `huruf_b`.`id` ";

        $query = "SELECT * FROM `data_pasien` UNION SELECT * FROM `huruf_b` UNION SELECT * FROM `huruf_c` UNION SELECT * FROM `huruf_d` UNION SELECT * FROM `huruf_e`UNION SELECT * FROM `huruf_f`UNION SELECT * FROM `huruf_g`UNION SELECT * FROM `huruf_h`UNION SELECT * FROM `huruf_i`UNION SELECT * FROM `huruf_j`UNION SELECT * FROM `huruf_k`UNION SELECT * FROM `huruf_l`UNION SELECT * FROM `huruf_m`UNION SELECT * FROM `huruf_n`UNION SELECT * FROM `huruf_o`UNION SELECT * FROM `huruf_p`UNION SELECT * FROM `huruf_r`UNION SELECT * FROM `huruf_s`UNION SELECT * FROM `huruf_t`UNION SELECT * FROM `huruf_u`UNION SELECT * FROM `huruf_v`UNION SELECT * FROM `huruf_w`UNION SELECT * FROM `huruf_y`UNION SELECT * FROM `huruf_z`";

        return  $this->db->query($query)->result_array();
    }

    public function data_terakhir_a()
    {
        $query = "SELECT * FROM `data_pasien`";
        return $this->db->query($query)->result_array();
    }

    public function hapus_riwayat()
    {
        $lama = 30;  //menghapus data riwayat selama 30 hari
        $query = "DELETE FROM `riwayat_pasien` WHERE DATEDIFF(CURDATE(),`tanggal`) >$lama";

        return $this->db->query($query);
    }
}
