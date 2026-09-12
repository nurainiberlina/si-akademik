<?php

namespace App\Controllers;

class AuthController
{
    public function loginForm()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = $_SESSION['flash_error'] ?? null;
        unset($_SESSION['flash_error']);

        $message = $_SESSION['flash_message'] ?? null;
        unset($_SESSION['flash_message']);


        if ($error) {
            echo "<p style='color:red;'>$error</p>";
        }
        if ($message) {
            echo "<p style='color:red;'>$message</p>";
        }

        echo '<form method="POST" action="/si-akademik/public/login">
                <label>Username</label> <input type="text" name="username" placeholder="Username"><br>
                <label>Password</label> <input type="password" name="password" placeholder="Password"><br>
                <button type="submit">Login</button>
              </form>';
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === 'admin' && $password === '1234') {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_name'] = 'Admin';
            $_SESSION['flash_message'] = 'Selamat datang di dashboard, Admin';

            header('Location: /si-akademik/public/mahasiswa');
            exit;
        } else {
            $_SESSION['flash_error'] = 'Username atau password salah';
            header('Location: /si-akademik/public/login');
            exit;
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();

        session_start();
        $_SESSION['flash_message'] = 'Anda telah logout';
        header('Location: /si-akademik/public/login');
        exit;
    }

    public function dashboard()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header('Location: /si-akademik/public/login');
            exit;
        }

        $message = $_SESSION['flash_message'] ?? null;
        unset($_SESSION['flash_message']);


        if ($message) {
            echo "<p style='color:green; font-weight:bold;'>$message</p>";
        }
        echo "<p>Halo, " . $_SESSION['user_name'] . "!</p>";
        echo '<a href="/si-akademik/public/logout">Logout</a>';
    }
}