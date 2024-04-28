<?php
namespace App\Filters;

use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;

class LoginFilter implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null)
    {

        if (!session('user') && !url_is('login')) {
            return redirect()->to(base_url('login'));
        
        } else if (session('user') && url_is('login')) {

            // ESTE SWITCH SERA MODIFICADO PARA REDIRECCIONAR SEGÚN EL ROL
            switch (session('user')['user']) {
                case 'admin':
                    return redirect()->to(base_url('tickets'));
                
                default:
                    return redirect()->to(base_url('error/404'));
            }

        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }

}