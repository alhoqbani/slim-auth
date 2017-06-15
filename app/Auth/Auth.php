<?php

namespace App\Auth;

use App\Models\User;

class Auth
{
    
    public function attempt($email, $password)
    {
        if ( ! $user = User::where('email', $email)->first()) {
            return false;
        }
        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            
            return true;
        }
        
        return false;
    }
}