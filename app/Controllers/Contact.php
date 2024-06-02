<?php

namespace App\Controllers;

use App\Models\ContactModel;


class Contact extends BaseController
{

    public function index()
    {

        helper('form');
        $model = new ContactModel();
        $data = [
            'title' => 'Message',
            'content' => 'v_contact',
            'getData' => $model->getAllData(),
        ];

        return view('layout/template', $data);
    }

    public function submit()
    {
        helper('form');
        $id = $this->request->getPost('id_message');
        $model = new ContactModel();

        $data = array(
            'id_message' => $id,
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
        );

        $result = $model->insertData($data);

        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil disimpan.');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal disimpan.');
        }

        return redirect()->to('Main/contact');
    }

    // public function edit()
    // {
    //     $id = $this->request->uri->getSegment(3);
    //     $model = new ContactModel();
    //     $get = $model->getDataById($id);

    //     $data['id'] = $id;
    //     $data['name'] = $get->name;
    //     $data['email'] = $get->email;
    //     $data['subject'] = $get->subject;
    //     $data['message'] = $get->message;

    //     return $this->response->setJSON($data);
    // }
    // public function update()
    // {
    //     helper("form");
    //     $id_message = $this->request->getPost('id_message');
    //     $name = $this->request->getPost('name');
    //     $email = $this->request->getPost('email');
    //     $subject = $this->request->getPost('subject');
    //     $message = $this->request->getPost('message');

    //     $data = array(
    //         'name' => $name,
    //         'email' => $email,
    //         'subject' => $subject,
    //         'message' => $message,
    //     );

    //     $model = new ContactModel();
    //     $result = $model->updateData($id_message, $data);

    //     if ($result) {
    //         // Pesan keberhasilan
    //         session()->setFlashdata('success', 'Data berhasil diperbarui.');
    //         return redirect()->to('Contact');
    //     } else {
    //         // Pesan kesalahan
    //         session()->setFlashdata('error', 'Data gagal diperbarui.');
    //         return redirect()->to('Contact/edit/' . $id_message);
    //     }
    // }



    public function delete($id)
    {
        $id = $this->request->uri->getSegment(3);
        $model = new ContactModel();
        $result = $model->deleteData($id);

        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil dihapus.');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal dihapus.');
        }

        return redirect()->to('Contact');
    }
}
