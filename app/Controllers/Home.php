<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function make_view($page)
    {
        $data['title'] = ucfirst($page); // Capitalize the first letter
        return view('templates/header', $data)
        . view('Pages/homepage')
        . view('templates/footer');
    }
    public function index()
    {
        return $this->make_view('homepage');
    }
}
