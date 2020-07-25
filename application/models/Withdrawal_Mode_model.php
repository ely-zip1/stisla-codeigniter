<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdrawal_Mode_model extends CI_Model {

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

  public function add($data){
      $this->db->insert('td_withdrawal_mode',$data);
  }

  public function get_all(){
    $query = $this->db->get('td_withdrawal_mode');
    return $query->result();
  }

  public function get_by_id($id){
    $this->db->where('id',$id);
    $query = $this->db->get('td_withdrawal_mode',1);
    return $query->row();
  }

  public function get_per_member($member_id){
    $this->db->where('member_id',$member_id);
    $query = $this->db->get('td_withdrawal_mode');
    return $query->row();
  }

  public function update_bitcoin($member_id, $bitcoin){
    $this->db->set('bitcoin', $bitcoin);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }

  public function update_ethereum($member_id, $ethereum){
    $this->db->set('ethereum', $ethereum);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }

  public function update_abra($member_id, $abra){
    $this->db->set('abra', $abra);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }

  public function update_paypal($member_id, $paypal){
    $this->db->set('paypal', $paypal);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }

  public function update_neteller($member_id, $neteller){
    $this->db->set('neteller', $neteller);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }

  public function update_advcash($member_id, $advcash){
    $this->db->set('advcash', $advcash);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }
}
