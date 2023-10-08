<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
 
class Dashboard extends Controller
{
    public function index()
    {
        $session = session();
        $data['session'] = $session;
        echo view('dashboard', $data);
    }
}