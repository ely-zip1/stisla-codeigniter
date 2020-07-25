<?php

class Upload extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array(
      'form',
      'url'
    ));

    $this->load->model('Members');

  }

  public function index()
  {
    $this->load->view('pages/upload_form', array(
      'error' => ' '
    ));
  }

  public function do_upload()
  {
    $data                    = array(
      'title' => 'Account Settings'
    );
    $config['upload_path']   = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']      = 100;
    $config['max_width']     = 1024;
    $config['max_height']    = 768;
    $config['file_name']     = $this->session->username;
    $config['overwrite']     = true;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('userfile')) {
      $error = array(
        'error' => $this->upload->display_errors()
      );

      $this->session->set_flashdata($error);

      // $this->load->view('pages/upload_form', $error);
      redirect('account_settings', 'refresh');

      //
      // $this->load->view('templates/header', $data);
      // $this->load->view('pages/account_settings', $data);
      // $this->load->view('templates/footer');
    } else {
      // $data['upload_data'] = array('upload_data' => $this->upload->data());
      $data['upload_data'] = $this->upload->data();

      $image_data = array();
      $image_data['image_name'] = $this->upload->data('orig_name');

      if($this->upload->data('image_width') > $this->upload->data('image_height')){
        $image_data['image_orientation'] = 'landscape';
        $this->session->set_userdata('image_orientation','landscape');
      }
      else if($this->upload->data('image_width') < $this->upload->data('image_height')){
        $image_data['image_orientation'] = 'portrait';
        $this->session->set_userdata('image_orientation','portrait');
      }
      else{
        $image_data['image_orientation'] = 'square';
        $this->session->set_userdata('image_orientation','square');
      }

      $member = $this->Members->get_member($this->session->username);
      $this->Members->update_member($image_data, $member->id);

      $this->session->set_userdata('image_name',$this->upload->data('orig_name'));

      $this->load->view('templates/header', $data);
      $this->load->view('pages/upload_success', $data);
      $this->load->view('templates/footer');
      //
      // $this->load->view('templates/header', $data);
      // $this->load->view('pages/account_settings', $data);
      // $this->load->view('templates/footer');

    }
  }
}
?>
