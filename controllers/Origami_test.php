<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Origami_test extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        // Dépendances
        $this->load->library('unit_test');
        
        $this->load->add_package_path(APPPATH.'third_party/origami');
        $this->load->model('test_model');
        $this->load->remove_package_path(APPPATH.'third_party/origami');
        
        // Activation du profiler
        $this->output->enable_profiler();
    }

    public function index()
    {
        $this->unit->run($this->test_model->add(), TRUE, "Insert");
        
        $this->unit->run($this->test_model->add_user_address(), TRUE, "Insert + cryptage");
        
        $this->unit->run($this->test_model->add_user_file(), TRUE, "Insert + binaire");
        
        $this->unit->run($this->test_model->get()->get(), 'is_array', "Select");
        
        $this->unit->run($this->test_model->get_user_address()->get(), 'is_array', "Select + relation + cryptage");
        
        $this->unit->run($this->test_model->get_user_file()->get(), 'is_array', "Select + binaire");
        
        $this->unit->run($this->test_model->del(), TRUE, "Delete");
        
        $this->output->set_output($this->unit->report());
    }

}

/* End of file Origami_test.php */
/* Location: ./application/controllers/Origami_test.php */
