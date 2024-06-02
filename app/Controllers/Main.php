<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\UserModel;

class Main extends BaseController
{
    public function index()
    {
        // $session = session();
        // if ($session->get('customer') == null) {
        //     return redirect()->to(base_url("User/loginman"));
        // }
        $data = [
            'title' => 'Home',
            'content' => 'gamepages/home',
        ];
        return view('gamepages/template', $data);
    }
    public function landingpage()
    {
        $data = [
            'title' => 'Landing Page',
            'content' => 'gamepages/landingpage',
        ];
        return view('gamepages/template', $data);
    }
    public function browse()
    {
        $data = [
            'title' => 'Browse',
            'content' => 'gamepages/browse',
        ];
        return view('gamepages/template', $data);
    }
    public function contact()
    {
        helper('form');
        $data = [
            'title' => 'Contact',
            'content' => 'gamepages/contact',
        ];
        return view('gamepages/template', $data);
    }
    public function topup()
    {
        $session = session();
        if ($session->get('customer') == null) {
            return redirect()->to(base_url("User/loginman"));
        }
        helper('form');
        $model = new GameModel();
        $data = [
            'title' => 'Top Up',
            'content' => 'gamepages/topup',
            'getData' => $model->getAllData(),
        ];

        return view('gamepages/template', $data);
    }
    public function verif()
    {
        $data = [
            'title' => 'Payment',
            'content' => 'gamepages/verpay',
        ];
        return view('gamepages/template', $data);
    }
}
