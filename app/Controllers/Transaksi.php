<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\GameModel;

class Transaksi extends BaseController
{

    public function index()
    {
        helper('form');
        $model = new TransaksiModel();
        $data = [
            'title' => 'Transaction',
            'content' => 'v_transaksi',
            'getData' => $model->getAllDataWithRelation(),
        ];

        return view('layout/template', $data);
    }

    public function topupadd($id_game)
    {
        helper('form');
        $model = new GameModel();
        $data = [
            'title' => 'Top UP',
            'content' => 'gamepages/topup_add',
            'gameDetails' => $model->getDataById($id_game),
        ];

        return view('gamepages/template', $data);
    }

    public function submit()
    {
        helper('form');
        $id = $this->request->getPost('id_transaksi');
        $model = new TransaksiModel();

        
        $tanggal = date('Y-m-d');

        $data = array(
            'id_transaksi' => $id,
            'id_game' => $this->request->getPost('id_game'),
            'server_game' => $this->request->getPost('server_game'),
            'customer' => $this->request->getPost('customer'),
            'metode' => $this->request->getPost('metode'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tanggal' => $tanggal,
        );

          $result = $model->insertData($data);

        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil disimpan.');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal disimpan.');
        }

        return redirect()->to('Main/topup');
    }

    public function delete($id)
    {
        $id = $this->request->uri->getSegment(3);
        $model = new TransaksiModel();
        $result = $model->deleteData($id);

        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil dihapus.');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal dihapus.');
        }

        return redirect()->to('Transaksi');
    }
}
