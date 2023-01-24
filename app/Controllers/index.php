<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;// Add this line
class News extends BaseController
{
    public function index()
    {
        include 'db_connection.php';
        $conn = OpenCon();
        echo "Connected Successfully";
        CloseCon($conn);
    }
}