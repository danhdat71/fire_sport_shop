<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\UserService;
use App\Http\Requests\InviteAdminRequest;
use App\Http\Requests\AdminSignInRequest;

class AuthAdminsController extends Controller
{
    /**
     * Global variable
     * **/
    protected $userService = null;

    /**
     * Constructor
     * **/
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Create new admin
     * 
     * @param $request
     * @return Http Response
     * **/
    public function inviteAdmin(InviteAdminRequest $request)
    {
        $request = $request->only('email');
        return $this->userService->inviteAdmin($request);
    }

    /**
     * Return view signin with token
     * 
     * @param $token
     * @return messages
     * **/
    public function signInToken($token)
    {
        return (
            $this->userService->isToken($token) AND 
            $this->userService->expiredToken($token)
        )
            ? view('admin/sign_up')
            : abort(Response::HTTP_NOT_FOUND);
    }

    /**
     * Form submit sign in with token
     * 
     * @param $request
     * @return view
     * **/
    public function submitSignInToken(Request $request)//AdminSignInRequest $request
    {
        $image = $request->file('image');
        $request = $request->only('name', 'address', 'birthday', 'gender', 'password');
        
        return $this->userService->createAdmin($image, $request);
    }
}
