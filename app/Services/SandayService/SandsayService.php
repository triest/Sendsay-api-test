<?php

namespace App\Services\SandayService;

use App\Models\Pet\Pet;
use App\Services\HttpRequestClass;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SandsayService extends HttpRequestClass
{

    public $login = '';

   // public $sublogin = '';

    public $password = '';

    /**
     * @param string $login
     */
    public function __construct()
    {
        $this->login = config('subscribe.sendsay.login');

      //  $this->sublogin = config('subscribe.sendsay.sublogin');

        $this->password = config('subscribe.sendsay.password');

        $this->url = config('subscribe.sendsay.api_url');

        parent::__construct();
    }


    public function setMember($email,$id = null,$ip = null){

        $url = config('subscribe.sendsay.api_url').config('subscribe.sendsay.account');

        $data = [
            'action' => 'member.set',
            "addr_type"=> "email",
            'email' => $email,
            'newbie.confirm' => 1,
            'session' => $this->login(),
            'source' => $ip ?:"127.0.0.1"
        ];

        $response = $this->post($url, $data);

        if(!isset($response['member']['id'])){
            throw new \Exception('Error add member');
        }

        $pet = Pet::query()->where('id',$id)->first();

        if($pet){
            $pet->sendsay_id = intval($response['member']['id']);
            $pet->save();
        }

        return true;
    }


    /**
     * @throws \Exception
     */
    public function login()
    {

        $session = Cache::get('sansay_session');

        if($session){
            return $session;
        }

        $data = [
            'action' => 'login',
            'login' => $this->login,
            'passwd' => $this->password
        ];

        $url = config('subscribe.sendsay.api_url').config('subscribe.sendsay.account');

        $response = $this->post($url, $data);

        if(!isset($response['session'])){
            throw new \Exception('Login exception');
        }

        $session = $response['session'];

        Cache::set('sansay_session',$session,5);

        return $session;
    }


}
