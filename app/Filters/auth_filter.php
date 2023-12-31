<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class auth_filter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->is_login) {
            session()->setFlashdata('error', '<strong>Maaf !</strong> Silahkan login lebih dulu.');
            return redirect()->to('auth');
        }
        // Do something here
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
