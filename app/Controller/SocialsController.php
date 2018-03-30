<?php
class SocialsController extends AppController
{
    var $components = array('Session');

    function logout() {                                 //7
        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }

    //Google
    public function login_with_google()
    {
        if($this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        $this->autoRender = false;
        require_once '../Config/google_login.php';
        $client = new Google_Client();
        $client->setScopes(array('https://www.googleapis.com/auth/plus.login','https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me'));
        $client->setApprovalPrompt('auto');
        $url = $client->createAuthUrl();
        $this->redirect($url);
    }

    //This function will handle Oauth Api response
    public function google_login_success()
    {
        if($this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        session_name('CAKEPHP');
        session_start();
//        $this->autoRender = false;
        require_once '../Config/google_login.php';
        $client = new Google_Client();
        $client->setScopes(array('https://www.googleapis.com/auth/plus.login','https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me'));
        $client->setApprovalPrompt('auto');
        $plus       = new Google_PlusService($client);
        $oauth2     = new Google_Oauth2Service($client);
        if(isset($_GET['code'])) {
            $client->authenticate(); // Authenticate
            $_SESSION['access_token'] = $client->getAccessToken(); // get the access token here
        }

        if(isset($_SESSION['access_token'])) {
            $client->setAccessToken($_SESSION['access_token']);
        }

        if ($client->getAccessToken()) {
            $_SESSION['access_token'] = $client->getAccessToken();
            $user         = $oauth2->userinfo->get();
            if($user)//User tra ve tu google
            {
                //Kiểm tra user nếu có cho đăng nhập
                ClassRegistry::init('Member')->recursive = -1;
                $members = ClassRegistry::init('Member')->find('first', array(
                    'conditions' => array(
                        'Member.email' => $user['email']
                    )
                ));
                if($members)
                {
                    if($members['Member']['status'] == 0)
                    {
                        $this->Session->setFlash('Tài khoản của bạn đã bị khóa, vui lòng liên hệ với quản trị website', 'flashWarning');
//                    $this->redirect('/members/login');
                    }
                    else
                    {

                        $this->Session->write('Member.fullname', $members['Member']['fullname']);
                        $this->Session->write('Member.email', $members['Member']['email']);
                        $this->Session->write('Member.id', $members['Member']['id']);
                        $this->Session->write('Member.image', $members['Member']['image']);
                        $this->Session->write('Member.phonenumber', $members['Member']['phonenumber']);
                        $this->Session->write('Member.address', $members['Member']['address']);
                        $date = getdate();
                        $lastlogin = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
                        $data_update = array(
                            'google_id' => $user['id'],
                            'id' => $members['Member']['id'],
                            'lastlogin' => $lastlogin
                        );
                        ClassRegistry::init('Member')->save($data_update);
                        $this->redirect('/');
                    }
                }
                else////Nếu không có thêm user và cho đăng nhập
                {
                    $date = new DateTime();
                    $timestamp = $date->getTimestamp();
                    $ext = pathinfo($user['picture'], PATHINFO_EXTENSION);
                    $file = 'user_' . $user['id'] . '-' . $timestamp . '.' . $ext;
                    try
                    {
                        copy($user['picture'], $this->path_member_avatar . '/' . $file);
                    }
                    catch (Exception $exception)
                    {

                    }
                    $members = array(
                        'google_id' => $user['id'],
                        'email' => $user['email'],
                        'fullname' => $user['name'],
                        'status' => 1,
                        'username' => 'user_' . $user['id'],
                        'image' => $file
                    );
                    if(ClassRegistry::init('Member')->save($members))
                    {
                        $member_id = ClassRegistry::init('Member')->id;
                        $profile = array(
                            'member_id' => $member_id,
                            'activedemail' => 1,
                            'primaryaccount' => 0
                        );
                        if(ClassRegistry::init('Profile')->save($profile))
                        {
                            $this->Session->write('Member.fullname', $user['name']);
                            $this->Session->write('Member.email', $user['email']);
                            $this->Session->write('Member.id', $member_id);
                            $this->Session->write('Member.image', $file);
                            $this->Session->write('Member.phonenumber', '');
                            $this->Session->write('Member.address', '');
                            $date = getdate();
                            $lastlogin = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
                            $data_update = array(
                                'id' => $member_id,
                                'lastlogin' => $lastlogin
                            );
                            ClassRegistry::init('Member')->save($data_update);
                            $this->redirect('/');
                        }
                        else
                        {
                            $this->Session->setFlash('Lỗi', 'flashError');
                        }
                    }
                    else
                    {
                        $this->Session->setFlash('Lỗi', 'flashError');
                    }
                }
            }
        }

    }
    //Facebook

    public function facebook_login_success()
    {
        if($this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        session_name('CAKEPHP');
        @@session_start();
//
        $app_id = "177466519511280";
        $app_secret = "2a13971b11ad0885d0590b4ef688497b";
        $redirect_uri = urlencode("http://nhadatphong.com/socials/facebook_login_success");

// Get code value
        $code = $_GET['code'];

// Get access token info
        $facebook_access_token_uri = "https://graph.facebook.com/v2.8/oauth/access_token?client_id=$app_id&redirect_uri=$redirect_uri&client_secret=$app_secret&code=$code";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $facebook_access_token_uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
// Get access token
        $aResponse = new stdClass();
        $aResponse = json_decode($response);
        $access_token = $aResponse->access_token;

// Get user infomation
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/me?fields=email,birthday,location,locale,age_range,currency,first_name,last_name,name_format,gender&access_token=$access_token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        $user = json_decode($response);
        if(!isset($user->error))//User tra ve tu facebook
        {
            //Kiểm tra user nếu có cho đăng nhập
            ClassRegistry::init('Member')->recursive = -1;
            $members = ClassRegistry::init('Member')->find('first', array(
                'conditions' => array(
                    'OR' => array(
                        'Member.email' => $user->email,
                        'Member.facebook_id' => $user->id//Phòng trường hợp đăng nhập fb lúc đầu mà chưa lấy được email
                    )
                )
            ));
            if($members)
            {
                if($members['Member']['status'] == 0)
                {
                    $this->Session->setFlash('Tài khoản của bạn đã bị khóa, vui lòng liên hệ với quản trị website', 'flashWarning');
                    $this->redirect('/members/login');
                }
                else
                {
                    $this->Session->write('Member.fullname', $members['Member']['fullname']);
                    $this->Session->write('Member.email', $members['Member']['email']);
                    $this->Session->write('Member.id', $members['Member']['id']);
                    $this->Session->write('Member.image', $members['Member']['image']);
                    $this->Session->write('Member.phonenumber', $members['Member']['phonenumber']);
                    $this->Session->write('Member.address', $members['Member']['address']);
                    $date = getdate();
                    $lastlogin = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
                    $data_update = array(
                        'facebook_id' => $user->id,
                        'id' => $members['Member']['id'],
                        'lastlogin' => $lastlogin
                    );
                    ClassRegistry::init('Member')->save($data_update);
                    $this->redirect('/');
                }
            }
            else////Nếu không có thêm user và cho đăng nhập
            {
                $date = new DateTime();
                $timestamp = $date->getTimestamp();
//                $picture = "http://graph.facebook.com/" . $user->id . "/picture?type=large";
//                $ext = pathinfo($picture, PATHINFO_EXTENSION);
//                $file = 'user_fb' . $user->id . '-' . $timestamp . '.' . $ext;
//                try
//                {
//                    copy($picture, $this->path_member_avatar . '/' . $file);
//                }
//                catch (Exception $exception)
//                {
//
//                }
                $file = 'default_user.jpg';
                $members = array(
                    'facebook_id' => $user->id,
                    'email' => $user->email,
                    'fullname' => $user->first_name . ' ' . $user->last_name,
                    'status' => 1,
                    'username' => 'user_fb' . $user->id,
                    'image' => $file
                );
                if(ClassRegistry::init('Member')->save($members))
                {
                    $member_id = ClassRegistry::init('Member')->id;
                    $profile = array(
                        'member_id' => $member_id,
                        'activedemail' => 1,
                        'primaryaccount' => 0
                    );
                    if(ClassRegistry::init('Profile')->save($profile))
                    {
                        $this->Session->write('Member.fullname', $user->first_name . ' ' . $user->last_name);
                        $this->Session->write('Member.email', $user->email);
                        $this->Session->write('Member.id', $member_id);
                        $this->Session->write('Member.image', $file);
                        $this->Session->write('Member.phonenumber', '');
                        $this->Session->write('Member.address', '');
                        $date = getdate();
                        $lastlogin = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
                        $data_update = array(
                            'id' => $member_id,
                            'lastlogin' => $lastlogin
                        );
                        ClassRegistry::init('Member')->save($data_update);
                        $this->redirect('/');
                    }
                    else
                    {
                        $this->Session->setFlash('Lỗi', 'flashError');
                    }
                }
                else
                {
                    $this->Session->setFlash('Lỗi', 'flashError');
                }
            }
        }
        else
        {
            $this->Session->setFlash('Lỗi đăng nhập');
        }

    }


}