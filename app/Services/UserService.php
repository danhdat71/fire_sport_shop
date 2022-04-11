<?php

namespace App\Services;

use App\Models\User;
use App\Models\RememberToken;
use App\Constants\AppConstant;
use App\Constants\TokenConstant;
use App\Constants\ImageConstant;
use App\Jobs\InviteAdminEmailJob;
use App\Traits\HelpTraits;
use Carbon\Carbon;
use Str;
use Hash;

class UserService
{
    use HelpTraits;

    /**
     * Global variable
     * **/
    protected $user;
    protected $rememberToken;

    /**
     * Constructor
     * **/
    public function __construct(User $user, RememberToken $rememberToken)
    {
        $this->user = $user;
        $this->rememberToken = $rememberToken;
    }

    /**
     * Invite new admin
     * 
     * @param $request
     * @return boolean
     * **/
    public function inviteAdmin($request)
    {
        $token = Str::random(TokenConstant::ADMIN_TOKEN_LENGTH);
        $email = $request['email'];
        $url = config('app.url') . "/sign-in-token/$token";
        InviteAdminEmailJob::dispatch($email, $url);
        $this->rememberToken->updateOrCreate(
            ['email' => $email],
            [
                'email' => $email,
                'token' => $token,
                'email_at' => Carbon::now()->toDateTimeString()
            ]
        );
        return true;
    }

    /**
     * Check exist admin token for registry
     * 
     * @param $token
     * @return boolean
     * **/
    public function isToken($token)
    {
        $exist = $this->rememberToken->where('token', $token)->exists();
        return $exist ? true : false;
    }

    /**
     * Check token is expired
     * 
     * @param $token
     * @return boolean
     * **/
    public function expiredToken($token)
    {
        $createdAt = $this->rememberToken->where('token', $token)->first()->email_at;
        $createdAt = Carbon::createFromFormat('Y-m-d H:i:s', $createdAt)
            ->addHours(TokenConstant::ADMIN_TOKEN_TIME)->timestamp;
        $now = Carbon::now()->timestamp;
        
        return ($now > $createdAt) ? false : true;     
    }

    /**
     * Create admin
     * @param $image, $request
     * **/
    public function createAdmin($file, $request)
    {
        //Storage image
        $path = $this->savePublicImage(
            $file,
            "users",
            ImageConstant::USER,
            100,
            false, # is genegrate thumb image
            true # is genegrate blur thumb image
        );

        //Insert record
        $request['avatar'] = $path['big_image'];
        $request['password'] = Hash::make($request['password']);
        $this->user->create($request);

        return true;
    }

    /**
     * List users
     * 
     * @param $request
     * @return $data
     * **/
    public function listUser($request)
    {
        $keyword = (isset($requestData['keyword'])) ? $requestData['keyword'] : null;
        $orderBy = (isset($requestData['order_by'])) ? explode("|", $requestData['order_by']) : [];
        $role = (isset($request['role'])) ? $request['role'] : null;

        $list = $this->user
            ->when(isset($keyword), function($q) use($keyword){
                $q->where('name', 'like', "%".$keyword."%");
            })
            ->when(isset($role), function($q) use($role){
                $q->where('role', $role);
            })
            ->when(count($orderBy) > 0, function($q) use($orderBy){
                $q->orderBy($orderBy[0], $orderBy[1]);
            })
            ->withCount('products', 'blogs')
            ->orderBy('role', 'asc')
            ->paginate(AppConstant::PAGINATE);

        return [
            'list' => $list,
            'keyword' => $keyword,
            'role' => $role,
            'order_by' => $requestData['order_by'] ?? null
        ];
    }
}