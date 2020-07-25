<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload_success extends CI_Controller
{
	public function __construct()
    {
      parent::__construct();
    }

	public function index()
	{
    redirect('account_settings', 'refresh');
  }

}
