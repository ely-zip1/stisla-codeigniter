<?php

    class Members extends CI_Model{

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function get_member($username){

            $this->db->where('username', $username);
            $query = $this->db->get('td_members',1);

            return $query->row();
        }

        public function get_root(){

            $this->db->where('account_type_id', '3');
            $query = $this->db->get('td_members',1);

            return $query->row();
        }

        public function get_members_offset_limit($offset,$limit){
            $query = $this->db->get('td_members',$offset,$limit);

            return $query->result();
        }

        public function count_members(){

            $this->db->where('account_type_id', '2');
            $this->db->from('td_members');
            $total = $this->db->count_all();

            return $total;
        }

        public function get_member_by_id($id){

            $this->db->where('id', $id);
            $query = $this->db->get('td_members');

            return $query->row();
        }

        public function get_member_by_referral_id($referral_id){

            $this->db->where('referral_code_id', $referral_id);
            $query = $this->db->get('td_members');

            return $query->row();
        }

        public function is_exist($id){

            $this->db->where('id', $id);
            $query = $this->db->get('td_members');
            $member = $query->row();

            if(isset($member)){
                if(strlen($member->full_name) > 0){
                    return true;
                }else{
                    return false;
                }
            }
        }

        public function verify_member($user,$pass){

            $this->db->where('username', $user);
            $query = $this->db->get('td_members');
            $mpassword = $query->row();

            if(isset($mpassword)){
                if (password_verify($pass, $mpassword->password)) {
                    return true;
                } else {
                    return false;
                }
            }else{
                return false;
            }
        }

        public function add_member($member_data){

            $this->db->insert('td_members',$member_data);
        }

        public function has_duplicate_email($email){
            $this->db->where('email_address', $email);
            $query = $this->db->get('td_members',1);

            if(isset($query->row()->email_address)){
                if(strlen($query->row()->email_address) > 0){
                    return true;
                }else{
                    return false;
                }
            }
        }

        public function has_duplicate_username($username){
            $this->db->where('username', $username);
            $query = $this->db->get('td_members',1);

            if(isset($query->row()->username)){
                if(strlen($query->row()->username) > 0){
                    return true;
                }else{
                    return false;
                }
            }
        }

        public function update_password($email, $password){

            $options = [
                'cost' => 11
              ];

            $encrypted_password = password_hash($password, PASSWORD_BCRYPT, $options);

            $this->db->set('password', $encrypted_password);
            $this->db->where('email_address', $email);
            $this->db->update('td_members');
        }

        public function update_member($data, $member_id){
          $this->db->where('id', $member_id);
          $this->db->update('td_members', $data);
        }

        public function update_verification_code($verification_code, $member_id){
          $this->db->set('verification_code', $verification_code);
          $this->db->where('id', $member_id);
          $this->db->update('td_members');
        }

        public function verified($code){
          $this->db->set('verified', 1);
          $this->db->where('verification_code', $code);
          $this->db->update('td_members');
        }

        public function is_valid_v_code($verification_code){
          $this->db->where('verification_code',$verification_code);
          $query = $this->db->get('td_members',1);

          if($query->row() != null){
            return true;
          }else{
            return false;
          }
        }
    }


?>
