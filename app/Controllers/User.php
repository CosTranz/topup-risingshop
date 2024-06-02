<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        helper('form');
        $model = new UserModel();
        $data = [
            'title' => 'User',
            'content' => 'v_user',
            'getData' => $model->getAllData(),
        ];

        return view('layout/template', $data);
    }

    public function loginman($pesan = null)
    {
        $data["pesan"] = $pesan;
        return view('gamepages/loginmain', $data);
    }

    public function cek()
{
    $customer = $this->request->getPost('customer');
    $password = $this->request->getPost('password');

    $userModel = new UserModel();
    $userData = $userModel->find($customer);

    if ($userData == NULL) {
        $data["pesan"] = "Username tidak ditemukan";
        return view('gamepages/loginmain', $data);
    } else {
        // Check if the user is an admin
        if ($userData->customer == 'admin' && $password == $userData->password) {
            $session = session();
            $session->set('customer', $userData->customer);
            // Redirect to admin dashboard
            return redirect()->to(base_url("Dashboard"));
        } elseif ($password == $userData->password) {
            $session = session();
            $session->set('customer', $userData->customer);
            // Redirect to user dashboard
            return redirect()->to(base_url("Main/index"));
        } else {
            $data["pesan"] = "Password Salah";
            return view('gamepages/loginmain', $data);
        }
    }
}


    public function register()
    {
        return view('gamepages/registermain');
    }

    public function registersave()
    {
        $data = [];

        if ($this->request->getMethod() === 'post') {
            $model = new UserModel();

            $userData = [
                'customer' => $this->request->getPost('customer'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'country' => $this->request->getPost('country'),
                'phone_number' => $this->request->getPost('phone_number'),
            ];

            $model->insert($userData);
            return redirect()->to(base_url("User/loginman"));
        }

        return view('gamepages/registermain', $data);
    }

    public function delete($id)
    {
        $id = $this->request->uri->getSegment(3);
        $model = new UserModel();
        $result = $model->deleteData($id);

        if ($result) {
            // Success message
            session()->setFlashdata('success', 'Data berhasil dihapus.');
        } else {
            // Error message
            session()->setFlashdata('error', 'Data gagal dihapus.');
        }

        return redirect()->to('User');
    }

     public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url("Main/landingpage"));
    }

    public function edit()
{
    $id = $this->request->uri->getSegment(3);
    $model = new UserModel();
    $get = $model->getDataById($id);

    $data['id'] = $id;
        $data['customer'] = $id;
        $data['email'] = $get->email;
        $data['password'] = $get->password;
        $data['country'] = $get->country;
        $data['phone_number'] = $get->phone_number;
       
    return $this->response->setJSON($data);
}

public function update()
{
    helper("form");
    $customer = $this->request->getPost('customer');
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    $country = $this->request->getPost('country');
    $phone_number = $this->request->getPost('phone_number');

    $data = array(
        'email' => $email,
        'password' => $password,
        'country' => $country,
        'phone_number' => $phone_number,
    );

    $model = new UserModel();
    $result = $model->updateData($customer, $data);

    if ($result) {
        // Pesan keberhasilan
        session()->setFlashdata('success', 'Data berhasil diperbarui.');
        return redirect()->to('User');
    } else {
        // Pesan kesalahan
        session()->setFlashdata('error', 'Data gagal diperbarui.');
        return redirect()->to('User/edit/' . $customer);
    }
}
}
