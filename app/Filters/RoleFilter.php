<?
// app/Filters/RoleFilter.php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if the user is logged in
        if (!session()->get('username')) {
            // User is not logged in, redirect to login page
            return redirect()->to(base_url('Loginadmin'));
        }

        // Check if the user has the required role
        $requiredRole = $arguments['role'] ?? null;

        if ($requiredRole && session()->get('role') !== $requiredRole) {
            // User does not have the required role, redirect to unauthorized page or login page
            return redirect()->to(base_url('Loginadmin'));
        }

        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing after
    }
}

?>