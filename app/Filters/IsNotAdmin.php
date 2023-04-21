<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class IsNotAdmin implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Do something here
    if (empty(session()->get('admin')['isLoggedIn']) || !empty(session()->get('admin')['role'] != 'admin')) {
      return redirect()->to(base_url() . '/admin');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
