<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;
class Siswa extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('siswa_model');
    }

    public function index_get()
    {
        $siswa = $this->siswa_model->get();

        if (!is_null($siswa)) {
            $this->response(array('response' => $siswa), 200);
        } else {
            $this->response(array('error' => 'Data tidak di temukan'), 404);
        }
    }

    public function find_get($id_siswa)
    {
        if (!$id_siswa) {
            $this->response(null, 400);
        }
        $nama = $this->siswa_model->get($id_siswa);

        if (!is_null($nama)) {
            $this->response(array('response' => $nama), 200);
        } else {
            $this->response(array('error' => 'Data yang di cari tidak ada'), 404);
        }
    }

    public function index_post()
    {
        if (!$this->post('city')) {
            $this->response(null, 400);
        }

        $id = $this->cities_model->save($this->post('city'));

        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'gagal insert data'), 400);
        }
    }

    public function index_put()
    {
        if (!$this->put('city')) {
            $this->response(null, 400);
        }

        $update = $this->cities_model->update($this->put('city'));

        if (!is_null($update)) {
            $this->response(array('response' => 'data succes di update'), 200);
        } else {
            $this->response(array('error', 'gagal update data'), 400);
        }
    }

    public function index_delete($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }

        $delete = $this->cities_model->delete($id);

        if (!is_null($delete)) {
            $this->response(array('response' => 'data sudah terhapus'), 200);
        } else {
            $this->response(array('error', 'gagal terhapus'), 400);
        }
    }
}