<?php

namespace App\Auth;

use App\Models\User;

class Auth
{
    
    public function user()
    {
        if ($this->check()) {
            return User::find($_SESSION['user']);
        }
        
        return new User();
        
    }
    
    public function signIn(User $user)
    {
        $_SESSION['user'] = $user->id;
    }
    
    public
    function check()
    {
        return ! ! isset($_SESSION['user']);
    }
    
    public
    function attempt(
        $email,
        $password
    ) {
        if ( ! $user = User::where('email', $email)->first()) {
            return false;
        }
        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            
            return true;
        }
        
        return false;
    }
    
    public function logout()
    {
        unset($_SESSION['user']);
    }
}