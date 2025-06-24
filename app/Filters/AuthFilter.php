<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an auth filter
     * fails, it should typically redirect the user to a
     * login page, or similar.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // 1. Cek apakah pengguna sudah login
        if (! $session->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        // 2. Cek role pengguna
        $userRole = $session->get('role'); // Asumsi 'role' disimpan di session
        
        // $arguments akan berisi role yang diizinkan untuk route ini (misal: ['admin', 'kepala-desa'])
        if (is_array($arguments) && ! empty($arguments)) {
            if (! in_array($userRole, $arguments)) {
                // Pengguna tidak memiliki role yang diizinkan
                return redirect()->to(base_url('unauthorized'))->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            }
        }
        // Jika tidak ada argumen (misal, hanya perlu login, role apa saja boleh), maka lewati
        // Atau jika argumen adalah role tunggal dan cocok
    }

    /**
     * We aren't concerned with after filters here.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}