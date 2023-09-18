<?php

namespace App\Controllers;

use App\Models\User;
use Core\Base\Controller\BaseController;
use Core\Http\Response;
use Core\Services\AuthServices;
use Core\Services\DBManager;
use Core\Services\ENVManager;

/**
 * Home Controller
 */
class HomeController extends BaseController
{
    /**
     * Home Index
     *
     * @return Response
     */
    public function index(): Response
    {
        $auth = new AuthServices();

        if ($auth->checkLoggedIn()) {
            $user = new User(new DBManager(new ENVManager()));
            $user = $user->getUserById($auth->getUserID());
            return $this->view('Home.view.php', ['name' => $user['username']]);
        } else {
            return $this->view('Guest.view.php', []);
        }
    }

    /**
     * Blog Page
     *
     * @param int $id
     * @param int $language_id
     * @return Response
     */
    public function blogs($id, $language_id): Response
    {
        $response = new Response(200, [$id . ' numaralı blog postunun ' . $language_id . ' dilindeki çevirisi mevcut değil.']);
        $response->setHeader('Content-Type', 'application/json');
        return $response;
    }
}
