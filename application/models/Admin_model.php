<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function user()
    {
        $query = "SELECT * FROM `user` JOIN `user_rule` ON `user`.`rule_id`=`user_rule`.`id`";
        return $this->db->query($query)->result_array();
    }
}
