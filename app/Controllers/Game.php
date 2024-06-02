<?php

namespace App\Controllers;

use App\Models\GameModel;


class Game extends BaseController
{

    public function index()
    {
        
        helper('form');
        $model = new GameModel();
        $data = [
            'title' => 'Game',
            'content' => 'v_game',
            'getData' => $model->getAllData(),
        ];

        return view('layout/template', $data);
    }

    public function submit()
    {
        helper('form');
        $id = $this->request->getPost('id');
        $model = new GameModel();
    
        $file = $this->request->getFile('file');

        // Define the allowed file extensions
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Get the file extension
            $fileExtension = $file->getExtension();
        
            // Check if the file extension is in the allowed list
            if (in_array($fileExtension, $allowedExtensions)) {
                $file_gambar = $file->getRandomName();
                $file->move(ROOTPATH . 'public/assets/uploads/img/', $file_gambar);
        
                // Set the filename to the data array
                $data['file'] = $file_gambar;
            } else {
                // Invalid file type
                echo 'Invalid file type. Only PNG, JPG, and JPEG are allowed.';
            }
        }
        
    
        $data = array(
            'id_game' => $this->request->getPost('id_game'),
            'name_game' => $this->request->getPost('name_game'),
            'top_up' => $this->request->getPost('top_up'),
            'status' => $this->request->getPost('status'),
            'file' => $file_gambar,
        );
    
        if ($id == "") {
            // Operasi INSERT
            $result = $model->insertData($data);
        } else {
            // Operasi UPDATE
            $result = $model->updateData($id, $data);
        }
    
        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil disimpan.');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal disimpan.');
        }
    
        return redirect()->to('Game');
    }
    
   

public function edit()
{
    $id = $this->request->uri->getSegment(3);
    $model = new GameModel();
    $get = $model->getDataById($id);

    $data['id'] = $id;
        $data['id_game'] = $id;
        $data['name_game'] = $get->name_game;
        $data['top_up'] = $get->top_up;
        $data['status'] = $get->status;
       
    return $this->response->setJSON($data);
}

public function update()
{
    helper("form");
    $id_game = $this->request->getPost('id_game');
    $name_game = $this->request->getPost('name_game');
    $status = $this->request->getPost('status');
    $top_up = $this->request->getPost('top_up');
    $pilihan = $this->request->getPost('pilihan');

    // // Check if a new image is uploaded
    // $newFile = $this->request->getFile('file');
    
    // if ($newFile && $newFile->isValid() && !$newFile->hasMoved()) {
    //     // Define the allowed file extensions
    //     $allowedExtensions = ['png', 'jpg', 'jpeg'];

    //     // Get the file extension
    //     $fileExtension = $newFile->getExtension();

    //     // Check if the file extension is in the allowed list
    //     if (in_array($fileExtension, $allowedExtensions)) {
    //         $file_gambar = $newFile->getRandomName();
    //         $newFile->move(ROOTPATH . 'public/assets/uploads/img/', $file_gambar);

    //         // Set the new filename to the data array
    //         $data['file'] = $file_gambar;
    //     } else {
    //         // Invalid file type
    //         echo 'Invalid file type. Only PNG, JPG, and JPEG are allowed.';
    //     }
    // }

    $data = array(
        'name_game' => $name_game,
        'status' => $status,
        'top_up' => $top_up,
        // 'file' => $file_gambar,
    );

    $model = new GameModel();
    $result = $model->updateData($id_game, $data);

    if ($result) {
        // Pesan keberhasilan
        session()->setFlashdata('success', 'Data berhasil diperbarui.');
        return redirect()->to('Game');
    } else {
        // Pesan kesalahan
        session()->setFlashdata('error', 'Data gagal diperbarui.');
        return redirect()->to('Game/edit/' . $id_game);
    }
}


    public function delete($id)
    {
        $id = $this->request->uri->getSegment(3);
        $model = new GameModel();
        $result = $model->deleteData($id);

        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil dihapus.');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal dihapus.');
        }

        return redirect()->to('Game');
    }

    
}
