<?php

namespace App\Controllers;

use App\Models\User;
use Core\Base\Controller\BaseController;
use Core\Http\Response;
use Core\Services\DBManager;
use Core\Services\ENVManager;

/**
 * User Controller
 */
class UserController extends BaseController
{
    /**
     * Index Page
     *
     * @return Response
     */
    public function index(): Response
    {
        return new Response(200, 'OK');
    }

    /**
     * User Create
     *  
     * @return Response
     */
    public function create(): Response
    {
        $dbManager = new DBManager(new ENVManager());
        $pdo = $dbManager->getPDO();
        $user = new User($pdo);
        if ($user->createUser($_GET['username'], $_GET['email'], $_GET['password'])) {
            return $this->view('RegisterSuccess.view.php', ['username' => $user->username]);
        } else {
            return new Response(500, 'Internal Server Error');
        }
    }

    /**
     * User Show
     *
     * @param int $id
     * @return Response
     */
    public function show($id): Response
    {
        $dbManager = new DBManager(new ENVManager());
        $pdo = $dbManager->getPDO();
        $user = new User($pdo);
        $user = $user->getUserById($id);
        if (!$user) {
            return new Response(404, 'User Not Found');
        } else {
            return new Response(200, 'User:' . $user['username']);
        }
    }
}
