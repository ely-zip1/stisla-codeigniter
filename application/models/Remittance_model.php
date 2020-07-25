<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Remittance_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Remittance_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function index()
  {
    // 
  }

  // ------------------------------------------------------------------------

  public function add($data){
    $this->db->insert('td_remittance',$data);
  }

  public function update($data){
    
    $this->db->set('first_name', $data['first_name']);
    $this->db->set('middle_name', $data['middle_name']);
    $this->db->set('last_name', $data['last_name']);
    $this->db->set('address', $data['address']);
    $this->db->set('phone_number', $data['phone_number']);
    $this->db->set('remittance_center', $data['remittance_center']);
    $this->db->where('member_id', $data['member_id']);
    $this->db->update('td_remittance');
  }

  public function get_per_member_id($member_id){
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_remittance', 1);

    return $query->row();
  }

  public function has_account($member_id){
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_remittance', 1);

    if($query->row() != null){
      return true;
    }else{
      return false;
    }
  }
}

/* End of file Remittance_model.php */
/* Location: ./application/models/Remittance_model.php */