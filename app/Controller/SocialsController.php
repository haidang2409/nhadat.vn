<?php
class SocialsController extends AppController
{
    var $components = array('Session');
    function test()
    {
        $user = array(
            'id' => '118368304429595797635',
            'email' => 'haidangdhct24@gmail.com',
            'verified_email' => 1,
            'name' => 'Hai Dang Nguyen',
            'picture' => 'https://lh3.googleusercontent.com/-MrPrt7y0YF4/AAAAAAAAAAI/AAAAAAAAITY/_ryRnVugUeA/photo.jpg',
            'gender' => 'male'
        );
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
            $file = 'default_user.jpg';
        }
        debug($file);
    }

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
    public function google_login_success_temp()
    {
//        $this->autoRender = false;
        $user = array(
            'id' => 'AB',
            'email' => 'haidangdhct24@gmail.com',
            'verified_email' => 1,
            'name' => 'Hai Dang Nguyen',
            'picture' => 'https://lh3.googleusercontent.com/-MrPrt7y0YF4/AAAAAAAAAAI/AAAAAAAAITY/_ryRnVugUeA/photo.jpg',
            'gender' => 'male'
        );
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
            //Nếu không có thêm user và cho đăng nhập
            else
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
    public function google_login_success()
    {
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

//                        $this->Session->write('Member.fullname', $members['Member']['fullname']);
//                        $this->Session->write('Member.email', $members['Member']['email']);
//                        $this->Session->write('Member.id', $members['Member']['id']);
//                        $this->Session->write('Member.image', $members['Member']['image']);
//                        $this->Session->write('Member.phonenumber', $members['Member']['phonenumber']);
//                        $this->Session->write('Member.address', $members['Member']['address']);
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



}