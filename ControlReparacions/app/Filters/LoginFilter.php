<?php
namespace App\Filters;

use \CodeIgniter\Filters\FilterInterface;
use \CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\HTTP\ResponseInterface;

class LoginFilter implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session('user')) {
            return redirect()->to(base_url('login'));
        } else if(url_is('login')){
            return redirect()->to(base_url('tickets'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }

}