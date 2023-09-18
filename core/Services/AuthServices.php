<?php

namespace Core\Services;

/**
 * Auth Services
 */
class AuthServices
{
    /**
     * Check Login
     *
     * @return void
     */
    function checkLoggedIn()
    {
        session_start();
        return isset($_SESSION['user_id']);
    }

    /**
     * Get Auth ID
     *
     * @return void
     */
    function getUserID()
    {
        session_start();
        return $_SESSION['user_id'];
    }
}
