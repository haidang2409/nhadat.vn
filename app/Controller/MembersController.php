<?php
App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
App::uses('CakeEmail', 'Network/Email');
class MembersController extends AppController
{
    public $components = array('Mailtemplate', 'Library');
    var $name = 'Members';
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    //User
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////


    public function testmail()
    {
        $Email = new CakeEmail('smtp');
        $Email->to('haidangdhct24@gmail.com');
        $Email->subject('Hello world');
        $Email->emailFormat('html');
        $Email->message();
        $body = $this->Mailtemplate->email_order('Nguyen Hai Dang', 'Cho thuê mặc bằng kinh doanh trung tâm thương mại Cái Khế, Ninh Kiều', 'Top list 2', '2017-09-29 00:00:00');
        $Email->send($body);
        echo $body;

    }
    public function register()
    {
        if($this->Session->check('Member'))
        {
            $this->redirect('/');
            exit();
        }
        $this->set(array('title' => 'Đăng ký thành viên'));
        if($this->request->is('post'))
        {
            $this->Member->set($this->request->data);
            if($this->Member->validates())
            {
                $api_url     = 'https://www.google.com/recaptcha/api/siteverify';
                $site_key    = '6LddJT0UAAAAAKOerTZU0-BxFRwdaLgdm4zz4ozE';
                $secret_key  = '6LddJT0UAAAAALypoQj0YBIQmylq2IuFonIQcr6y';
                $site_key_post  = $this->request->data['g-recaptcha-response'];
                if (!empty($_SERVER['HTTP_CLIENT_IP']))
                {
                    $remoteip = $_SERVER['HTTP_CLIENT_IP'];
                }
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                {
                    $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }
                else
                {
                    $remoteip = $_SERVER['REMOTE_ADDR'];
                }

                //tạo link kết nối
                $api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
                //lấy kết quả trả về từ google
                $response = file_get_contents($api_url);
                //dữ liệu trả về dạng json
                $response = json_decode($response);
                if(!isset($response->success))
                {
                    $this->Session->setFlash('Vui lòng nhập captcha', 'flashWarning');
                }
                if($response->success == true)
                {
                    $this->Member->create();
                    $this->Member->set('status', 1);
                    $this->Member->set('image', 'default_user.jpg');
                    if ($this->Member->save($this->request->data))
                    {
                        $fullname = $this->request->data['Member']['fullname'];
                        $username = $this->request->data['Member']['username'];
                        $email = $this->request->data['Member']['email'];
                        $member_id = $this->Member->id;
                        $code_active = md5(md5($username));
                        //Send mail
                        $Email = new CakeEmail('smtp');
                        $Email->to($email);
                        $Email->subject('Kích hoạt tài khoản');
                        $Email->emailFormat('html');
                        $Email->message();
                        $body = $this->Mailtemplate->email_register($fullname, $email, $member_id, $code_active);
                        //
                        $this->Member->Profile->create();
                        $this->Member->Profile->set('linkactiveemail', $code_active);
                        $this->Member->Profile->set('member_id', $member_id);
                        $this->Member->Profile->set('primaryaccount', 1000000);
                        $this->Member->Profile->set('activedemail', 0);
                        $this->Member->Profile->set('activenumberphone', 0);
                        $this->Member->Profile->save();
                        //Send email
                        try
                        {
                            $Email->send($body);
                        }
                        catch (Exception $exception)
                        {

                        }
                        //
                        $this->Session->setFlash('Đăng ký tài khoản thành công', 'flashSuccess');
                        $this->redirect('/members/login');
                    }
                    else
                    {
                        $this->Session->setFlash('Vui lòng kiểm tra lại dữ liệu của bạn', 'flashWarning');
                        return $this->Member->validationErrors;
                    }
                }
                else
                {
                    $this->Session->setFlash('Vui lòng nhập captcha', 'flashWarning');
                }
            }
            else
            {
                $this->Session->setFlash('Vui lòng kiểm tra lại dữ liệu của bạn', 'flashWarning');
            }

        }

    }
    public function active_email()
    {
        $url = $this->params['url'];
        $member_id = isset($url['u_id'])? $url['u_id']: '';
        $email = isset($url['email'])? $url['email']: '';
        $code_active = $url['code_active'];
        $this->Member->Profile->recursive = -1;
        $profile_member = $this->Member->Profile->find('first', array(
            'joins' => array(
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Profile.member_id = Member.id'
                )
            ),
            'conditions' => array(
                'Profile.member_id' => $member_id,
                'Member.email' => $email
            )
        ));
        if($profile_member)
        {
            if($profile_member['Profile']['activedemail'] == 1)
            {
                $this->Session->setFlash('Email của bạn đã xác thực rồi', 'flashSuccess');
            }
            else
            {
                if($profile_member['Profile']['linkactiveemail'] == $code_active)
                {
                    $data_update = array(
                        'activedemail' => 1,
                        'linkactiveemail' => null,
                    );
                    $this->Member->Profile->updateAll(
                        $data_update,
                        array('Profile.member_id' => $member_id)
                    );
                    $this->Session->setFlash('Email của bạn đã được xác thực', 'flashSuccess');
                }
                else
                {
                    $this->Session->setFlash('Mã kích hoạt không đúng', 'flashWarning');
                }
            }

        }
        else
        {
            $this->Session->setFlash('Thông tin thành viên không đúng', 'flashWarning');
        }
    }
    public function forget_password()
    {
        //
        if($this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        $this->set(array('title' => 'Quên mật khẩu'));
        //
        if($this->request->is('post') || $this->request->is('put'))
        {
            $email = isset($this->request->data['email'])? $this->request->data['email']: '';
            $this->Member->recursive = -1;
            $member = $this->Member->findByEmail($email);
            if(!$member)
            {
                $this->Session->setFlash('Không tìm thấy email', 'flashWarning');
            }
            else
            {
                $code_change = md5(md5($email . mt_rand()));
                $this->Member->Profile->recursive = -1;
                if($this->Member->Profile->updateAll(array('codechangepass' => "'$code_change'"), array('member_id' => $member['Member']['id'])))
                {
                    //Send mail
                    $Email = new CakeEmail('smtp');
                    $Email->to($email);
                    $Email->subject('Yêu cầu đặt lại mật khẩu');
                    $Email->emailFormat('html');
                    $Email->message();
                    $body = $this->Mailtemplate->email_forget_password($member['Member']['fullname'], $email, $code_change);
                    try
                    {
                        $Email->send($body);
                    }
                    catch (Exception $exception)
                    {

                    }
                    $this->Session->setFlash('Chúng tôi vừa gửi một email đặt lại mật khẩu cho bạn, vui lòng kiểm tra lại email. Nếu không nhìn thấy trong inbox vui lòng kiểm tra trong hộp thư spam', 'flashSuccess');
                    $this->redirect('/members/forget_password');
                }
            }
        }
    }
    public function reset_password()
    {
        $code = isset($this->params['url']['code'])? $this->params['url']['code']: '';
        $email = isset($this->params['url']['email'])? $this->params['url']['email']: '';
        //
        $this->Member->recursive = -1;
        $member = $this->Member->find('first', array(
            'joins' => array(
                array(
                    'table' => 'profiles',
                    'alias' => 'Profile',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Member.id = Profile.member_id'
                ),
            ),
            'conditions' => array(
                'Member.email' => $email,
                'Profile.codechangepass' => $code
            )
        ));
        if(!$member)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/members/forget_password');
        }
        else
        {
            //
            $this->set(array('title' => 'Đặt lại mật khẩu'));
        }
        if($this->request->is('post') || $this->request->is('put'))
        {
            $password = $this->request->data['password_new'];
            $re_password = $this->request->data['re_password_new'];
            if(trim($password) == '')
            {
                $this->Session->setFlash('Vui lòng nhập mật khẩu', 'flashWarning');
            }
            else
            {
                if(trim($re_password) == '')
                {
                    $this->Session->setFlash('Vui lòng nhập lại mật khẩu', 'flashWarning');
                }
                else
                {
                    if(strlen($password) < 8)
                    {
                        $this->Session->setFlash('Mật khẩu từ 8 ký tự', 'flashWarning');
                    }
                    else
                    {
                        if($password != $re_password)
                        {
                            $this->Session->setFlash('Mật khẩu không khớp nhau', 'flashWarning');
                        }
                        else
                        {
                            $pass_new = AuthComponent::password($re_password);
                            $data_update_member = array(
                                'Member.id' => $member['Member']['id'],
                                'Member.email' => $email
                            );
                            if($this->Member->updateAll(array('password' => "'$pass_new'"), array($data_update_member)))
                            {
                                $this->Member->Profile->updateAll(array('codechangepass' => null), array('member_id' => $member['Member']['id']));
                                $this->Session->setFlash('Mật khẩu đã được thay đổi', 'flashSuccess');
                            }
                        }
                    }
                }
            }
        }
    }
    public function login()
    {
        if($this->Session->check('Member'))
        {
            $this->redirect('/');
            exit();
        }
        $this->set(array('title' => 'Đăng nhập'));
        if($this->request->is('post'))
        {
            $username = $this->request->data['username'];
            $password = $this->request->data['password'];
            $passwordnew = AuthComponent::password($password);
            $url_redirect = $this->request->data['url_redirect'];
            $this->Member->recursive = -1;
            $members = $this->Member->find('first', array(
                'conditions' => array(
//                    'Member.username' => $username,
                    'OR' => array(
                        'Member.username' => $username,
                        'Member.phonenumber' => $username,
                        'Member.email' => $username
                    ),
                    'Member.password' => $passwordnew,
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
                        'id' => $members['Member']['id'],
                        'lastlogin' => $lastlogin
                    );
                    $this->Member->save($data_update);
                    if($url_redirect)
                    {
                        $this->redirect($url_redirect);
                    }
                    else
                    {
                        $this->redirect('/');
                    }
                }
            }
            else
            {
                $this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không đúng','flashError');
                $this->redirect('/members/login');
            }
        }
    }
    public function logout()
    {
        $this->Session->delete('Member');
        $this->redirect('/');
    }
    public function profile()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
            exit();
        }
        $id = $this->Session->read('Member.id');
        $this->Member->recursive = -1;
        $member = $this->Member->find('first', array(
            'joins' => array(
                array(
                    'table' => 'wards',
                    'alias' => 'Ward',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Ward.id = Member.ward_id'),
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Ward.district_id'),
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id'),
                ),
                array(
                    'table' => 'profiles',
                    'alias' => 'Profile',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Member.id = Profile.member_id'),
                ),
            ),
            'conditions' => array('Member.id' => $id),
            'fields' => array('*')
        ));
        if($member)
        {
            $this->set(array('members' => $member, 'title' => 'Thông tin tài khoản'));
        }
        else
        {
            $this->Session->delete('Member');
            $this->redirect('/');
        }
    }
    public function profile_update($id = null)
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        else
        {
            $provinces = null;
            $districts = null;
            $district_id = null;
            $wards = null;
            $province_id = null;
            //Member
            $id = $this->Session->read('Member.id');
            $this->Member->recursive = -1;
            $member = $this->Member->findById($id);

            $ward_id = $member['Member']['ward_id'];
            $this->Member->Ward->recursive = -1;
            $dis = $this->Member->Ward->findById($ward_id);
            if($dis)
            {
                $district_id = $dis['Ward']['district_id'];
            }

            //Ward
            $this->Member->Ward->recursive = -1;
            $ward = $this->Member->Ward->find('all', array(
                'conditions' => array('Ward.district_id' => $district_id),
                'fields' => array('Ward.id', 'Ward.wardname'),
                'order' => array('Ward.wardname' => 'ASC')
            ));
            foreach ($ward as $item){
                $wards[$item['Ward']['id']] = $item['Ward']['wardname'];
            }
            //District
            $this->Member->Ward->District->recursive = -1;
            $pro = $this->Member->Ward->District->findById($district_id);
            if($pro)
            {
                $province_id = $pro['District']['province_id'];
            }
            $this->Member->Ward->District->recursive = -1;
            $district = $this->Member->Ward->District->find('all', array(
                'conditions' => array('District.province_id' => $province_id),
                'fields' => array('District.id', 'District.districtname'),
                'order' => array('District.districtname' => 'ASC')
            ));
            foreach ($district as $item){
                $districts[$item['District']['id']] = $item['District']['districtname'];
            }
            //Province
            $this->Member->Ward->District->Province->recursive = -1;
            $province = $this->Member->Ward->District->Province->find('all', array(
                'fields' => array('Province.id', 'Province.provincename'),
                'order' => array('Province.provincename' => 'ASC')
            ));
            foreach ($province as $item){
                $provinces[$item['Province']['id']] = $item['Province']['provincename'];
            }

            $this->set(array(
                'member' => $member,
                'province' => $provinces,
                'district' => $districts,
                'ward' => $wards,
                'province_id' => $province_id,
                'district_id' => $district_id,
                'title' => 'Cập nhật thông tin tài khoản'
            ));
        }

        if($this->request->is('post') || $this->request->is('put'))
        {
            debug($this->request->data);
            $this->Member->id = $id;
            $this->Member->set('birthday', $this->Library->convert_date_dd_mm_yyyy_to_yyyy_mm_dd($this->request->data['Member']['birth']));
            if($this->Member->save($this->request->data, true, array('fullname', 'gender', 'phonenumber', 'address', 'ward_id', 'birthday')))
            {
                //
                $this->Session->write('Member.fullname', $this->request->data['Member']['fullname']);
                //
                $this->Session->setFlash('Cập nhật thông tin thành công', 'flashSuccess');
                $this->redirect('/members/profile');
            }
            else
            {
                $this->Session->setFlash('Không thể cập nhật thông tin', 'flashWarning');
            }
        }
    }
    public function change_password()
    {
        if($this->Session->check('Member'))
        {
            $this->set(array(
                'title' => 'Đổi mật khẩu'
            ));
            if($this->request->is('post'))
            {
                $data_update = array(
                    'password_old' => $this->request->data['Member']['password_old'],
                    'password_new' => $this->request->data['Member']['password_new'],
                    're_password_new' => $this->request->data['Member']['re_password_new'],
                    'id' => $this->Session->read('Member.id'),
                    'password' => $this->request->data['Member']['re_password_new']
                );
                if($this->Member->save($data_update, array('id', 'password')))
                {
                    $this->Session->setFlash('Mật khẩu đã được thay đổi', 'flashSuccess');
                    $this->redirect('/members/profile');
                }
            }
        }
        else
        {
            $this->redirect('/');
        }
    }
    public function change_avatar()
    {
        if($this->Session->check('Member'))
        {
            $this->set(array(
                'title' => 'Thay đổi ảnh đại diện'
            ));
            if($this->request->is('post'))
            {
                $image = $this->request->data['Member']['avatar'];
                if($image['name'] == '')
                {
                    $this->Session->setFlash('Vui lòng chọn hình ảnh', 'flashWarning');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                if($image['type'] != 'image/png' && $image['type'] != 'image/jpg' && $image['type'] != 'image/jpeg')
                {
                    $this->Session->setFlash('Vui lòng chọn hình ảnh', 'flashWarning');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                if($image['size'] > 500000)
                {
                    $this->Session->setFlash('Vui lòng chọn hình ảnh nhỏ hơn 500Kb', 'flashWarning');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                $id = $this->Session->read('Member.id');
                $this->Member->recursive = -1;
                $members = $this->Member->findById($id);
                if($members)
                {
                    $date = new DateTime();
                    $timestamp = $date->getTimestamp();
                    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                    $file = $members['Member']['username'] . '-' . $timestamp . '.' . $ext;
                    $image_old = $members['Member']['image'];
                    if(move_uploaded_file($image['tmp_name'], $this->path_member_avatar . '/' . $file))
                    {
                        if($image_old != 'default_user.jpg')
                        {
                            try
                            {
                                unlink(WWW_ROOT  . '/img/members/' . $image_old);
                            }
                            catch (Exception $e)
                            {

                            }
                        }
                        $data_update = array(
                            'id' => $id,
                            'image' => $file
                        );
                        if($this->Member->save($data_update))
                        {
                            $this->Session->write('Member.image', $file);
                            $this->Session->setFlash('Hình ảnh đã được thay đổi', 'flashSuccess');
                            $this->redirect('/members/profile');
                        }
                    }
                }
            }
        }
        else
        {
            $this->redirect('/');
        }
    }
    public function mypost()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        $member_id = $this->Session->read('Member.id');
        $url = $this->params['url'];
        //Dieu kien tim kiem
        //Transaction type
        $transactiontype_search = isset($url['transactiontype'])? $url['transactiontype']: '';
        $condition_transactiontype = ($transactiontype_search != '')? 'Transactiontype.id = ' . $transactiontype_search: '';
        //Tỉnh thành
        $province_search_id = isset($url['province'])? $url['province']: 0;
        $condition_province = ($province_search_id > 0)? 'Province.id = ' . $province_search_id: '';
        //Quan huyen
        $district_search_id = isset($url['district'])? $url['district']: 0;
        $condition_district = ($district_search_id > 0)? 'District.id = ' . $district_search_id: '';
        //Xa phuong
        $ward_search_id = isset($url['ward'])? $url['ward']: 0;
        $condition_ward = ($ward_search_id > 0)? 'Ward.id = ' . $ward_search_id: '';
        //Group
        $group_search = isset($url['group'])? $url['group']: '';
        $condition_group = ($group_search != '')? 'GroupProduct.id = ' . $group_search: '';
        //category
        $category_search = isset($url['category'])? $url['category']: '';
        $condition_category = ($category_search != '')? 'CategoryProduct.id = ' . $category_search: '';
        $filter = isset($url['product_filter'])? $url['product_filter']: '';
        $condition_filter = '';
        if($filter == 'expired')
        {
            $condition_filter = 'Product.expiry < "' . $cur_date . '" AND Product.expiry > "0000-00-00 00:00:00"';
            $condition_filter = $condition_filter . ' AND Product.status = 1 AND Product.paid = 1';
        }
        if($filter == 'visible')
        {
            $condition_filter = 'Product.expiry >= "' . $cur_date . '" AND Product.status = 1 AND Product.paid = 1';
        }
        if($filter == 'draft')
        {
            $condition_filter = 'Product.status = 0 AND Product.paid = 0';
        }
        //Packet
        $packet_search = isset($url['packet'])? $url['packet']: '';
        $condition_packet = ($packet_search != '')? 'Packet.id = ' . $packet_search: '';
        //End dieu kien tim kiem
        //Ngay het han
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        ///
        $this->Member->Product->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => 10,
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'transactiontypes',
                    'alias' => 'Transactiontype',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.transactiontype_id = Transactiontype.id'
                ),
                array(
                    'table' => 'wards',
                    'alias' => 'Ward',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.ward_id = Ward.id')
                ),
                array(
                    'table' => 'categoriesproducts',
                    'alias' => 'CategoryProduct',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('CategoryProduct.id = Product.categoryproduct_id')
                ),
                array(
                    'table' => 'groupsproducts',
                    'alias' => 'GroupProduct',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('GroupProduct.id = CategoryProduct.groupproduct_id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Ward.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
                array(
                    'table' => 'directions',
                    'alias' => 'Direction',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Direction.id = Product.direction_id')
                )
            ),
            'conditions' => array(
                //Dieu kien mac dinh
                'Product.member_id = ' . $member_id,
                'Product.deleted = 0',
                $condition_filter,
                $condition_transactiontype,
                $condition_group,
                $condition_category,
                $condition_province,
                $condition_district,
                $condition_ward,
                $condition_packet,
            ),
            'order' => array('Product.id' => 'desc')
        );
        $product = $this->paginate('Product');
        //
        $this->set(array(
            'products' => $product,
            'head_description' => 'Tin đăng của tôi',
            'title' => 'Tin đăng của tôi',
        ));
        //Tim kiem
        //Set transactiontype
        $transactiontypes = null;
        $this->Member->Product->Transactiontype->recrusive = -1;
        $transactiontype = $this->Member->Product->Transactiontype->find('all');
        foreach ($transactiontype as $item)
        {
            $transactiontypes[$item['Transactiontype']['id']] = $item['Transactiontype']['nametype'];
        }
        //Set Group
        $groups = null;
        $this->Member->Product->Category->Group->recursive = -1;
        $group = $this->Member->Product->Category->Group->find('all');
        foreach ($group as $item)
        {
            $groups[$item['Group']['id']] = $item['Group']['groupname'];
        }
        //Categories
        $categories = null;
        $this->Member->Product->Category->recursive = -1;
        $category = $this->Member->Product->Category->find('all', array(
            'conditions' => array('groupproduct_id' => $group_search)
        ));
        foreach ($category as $item)
        {
            $categories[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //Province
        $provinces = null;
        $this->Member->Product->Ward->District->Province->recursive = -1;
        $province = $this->Member->Product->Ward->District->Province->find('all', array(
            'fields' => array('Province.id', 'Province.provincename'),
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item){
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //District
        $districts = null;
        $this->Member->Product->Ward->District->recursive = -1;
        $district = $this->Member->Product->Ward->District->find('all', array(
            'conditions' => array(
                'province_id' => $province_search_id
            )
        ));
        foreach ($district as $item)
        {
            $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
        }
        //Ward
        $wards = null;
        $this->Member->Product->Ward->recursive = -1;
        $ward = $this->Member->Product->Ward->find('all', array(
            'conditions' => array(
                'district_id' => $district_search_id
            )
        ));
        foreach ($ward as $item)
        {
            $wards[$item['Ward']['id']] = $item['Ward']['wardtype'] . ' ' . $item['Ward']['wardname'];
        }
        //Packet
        $this->Member->Product->Packet->recursive = -1;
        $packets = null;
        $packet = $this->Member->Product->Packet->find('all');
        foreach ($packet as $item)
        {
            $packets[$item['Packet']['id']] = $item['Packet']['packetname'];
        }
        $this->set(array(
            'transactiontypes' => $transactiontypes,
            'groups' => $groups,
            'categories' => $categories,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
            'packets' => $packets
        ));
    }
    public function delete_mypost()
    {
        $this->autoRender = false;
        if($this->Session->check('Member'))
        {
            $member_id = $this->Session->read('Member.id');
            $product_id = $this->request->data['product_id'];
            $data_update = array(
                'id' => $product_id,
                'member_id' => $member_id,
                'deleted' => 1,
                'status' => 0,
                'paid' => 0,
                'expiry' => '0000-00-00'
            );
            //Kiểm tra nếu là tin nháp thì xóa
            //Tức là chưa có hóa đơn cho mã product tương ứng
            //Kiểm tra hoa đơn
            ClassRegistry::init('Order')->recursive = -1;
            $count_order = ClassRegistry::init('Order')->find('count', array(
                'conditions' => array('product_id' => $product_id)
            ));
            if($count_order > 0)
            {
                if($this->Member->Product->save($data_update))
                {
                    $this->Session->setFlash('Đã xóa', 'flashSuccess');
                }
                else
                {
                    $this->Session->setFlash('Lỗi', 'flashWarning');
                }
            }
            //Neu khong co hoa don
            else
            {
                //Xóa hinh ảnh
                $this->Member->Product->recursive = -1;
                $product = $this->Member->Product->findById($product_id);
                //
                if($product)
                {
                    //Xóa hinh ảnh field [Product][image]
                    if(file_exists($this->path_product . '/' . $product['Product']['image']))
                    {
                        unlink($this->path_product . '/' . $product['Product']['image']);
                    }
                    if(file_exists($this->path_product_thumb . '/' . $product['Product']['image']))
                    {
                        unlink($this->path_product_thumb . '/' . $product['Product']['image']);
                    }
                    //Xóa hình ảnh trong bảng imageproduct
                    ClassRegistry::init('Image')->recursive = -1;
                    $image_product = ClassRegistry::init('Image')->find('all', array(
                        'conditions' => array('product_id' => $product_id)
                    ));
                    foreach ($image_product as $item)
                    {
                        if(file_exists($this->path_product . '/' . $item['Image']['imagedir'] . '/' . $item['Image']['imagelink']))
                        {
                            unlink($this->path_product . '/' . $item['Image']['imagedir'] . '/' . $item['Image']['imagelink']);
                        }
                        if(file_exists($this->path_product_thumb . '/'  . $item['Image']['imagedir'] . '/' . $item['Image']['imagelink']))
                        {
                            unlink($this->path_product_thumb . '/'  . $item['Image']['imagedir'] . '/' . $item['Image']['imagelink']);
                        }
                    }
                    //Xoa các record hinh anh
                    ClassRegistry::init('Image')->deleteAll(array('product_id' => $product_id));
//                    //Xóa utility
                    ClassRegistry::init('Utility')->deleteAll(array('product_id' => $product_id));
//                    //Xoa invironment
                    ClassRegistry::init('Environment')->deleteAll(array('product_id' => $product_id));
                }
                //
                if($this->Member->Product->delete($product_id))
                {
                    $this->Session->setFlash('Đã xóa', 'flashSuccess');
                }
                else
                {
                    $this->Session->setFlash('Lỗi', 'flashWarning');
                }
            }
            //Nếu là tin đang hiển thị hoặc hết hạn hiển thị thì update delete = 1
            //Để còn dữ liệu thống kê hóa đơn
        }
    }
    public function re_up_mypost()
    {
        $this->autoRender = false;
        if($this->Session->check('Member'))
        {
            $member_id = $this->Session->read('Member.id');
            $product_id = $this->request->data['product_id'];
            $date = getdate();
            $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
            $cur_time = $date['hours'] . '-' . $date['minutes'] . '-' . $date['seconds'];
            $this->Member->recursive = -1;
            $product = $this->Member->Product->find('first', array(
                'fields' => array('Product.id', 'Product.date_re_up', 'Product.re_up'),
                'conditions' => array(
                    'Product.id' => $product_id,
                    'Product.member_id' => $member_id,
                    'Product.re_up > ' => 0,
                    'Product.status' => 1,
                    'Product.paid' => 1,
                    'Product.deleted' => 0,
                    'Product.expiry >= ' => $cur_date
                )
            ));
            if($product)
            {
                $last_reup = $product['Product']['date_re_up'];
                $date = getdate();
                $cur_datetime = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . '-' . $date['minutes'] . '-' . $date['seconds'];
                $time_ago = strtotime($last_reup);
                $cur_time=time();
                $time_elapsed = $cur_time - $time_ago;
                $hours = round($time_elapsed / 3600);
                if($hours >= $this->hours_re_up)
                {
                    $data_update = array(
                        'id' => $product_id,
                        're_up' => $product['Product']['re_up'] - 1,
                        'date_re_up' => $cur_datetime,
                        'date_paid' => $cur_datetime,
                    );
                    if($this->Member->Product->save($data_update))
                    {
                        $this->Session->setFlash('Tin đã được re-up', 'flashSuccess');
                    }
                    else
                    {
                        $this->Session->setFlash('Lỗi', 'flashWarning');
                    }
                }
                else
                {
                    $this->Session->setFlash('Bạn không được re-up tin khi chưa đủ 24 giờ', 'flashWarning');
                }

            }
            else
            {
                $this->Session->setFlash('Lỗi', 'flashWarning');
            }
        }
    }
    //

    function mobicard()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/members/login/');
        }
        if($this->request->is('post'))
        {
            //Member
            //
            $member_id = $this->Session->read('Member.id');
            $this->Member->recursive = -1;
            $member = $this->Member->findById($member_id);
            $this->Member->Profile->recursive = -1;
            $profile = $this->Member->Profile->find('first', array(
                'conditions' => array('member_id' => $member_id)
            ));
            define('CORE_API_HTTP_USR', 'merchant_19002');
            define('CORE_API_HTTP_PWD', '19002mQ2L8ifR11axUuCN9PMqJrlAHFS04o');
            $bk = 'https://www.baokim.vn/the-cao/restFul/send';
            $seri = isset($_POST['txtseri']) ? $_POST['txtseri'] : '';
            $sopin = isset($_POST['txtpin']) ? $_POST['txtpin'] : '';
            //Loai the cao (VINA, MOBI, VIETEL, VTC, GATE)
            $mang = isset($_POST['chonmang']) ? $_POST['chonmang'] : '';

            if($mang=='MOBI'){
                $ten = "Mobifone";
            }
            else if($mang=='VIETEL'){
                $ten = "Viettel";
            }
            else if($mang=='GATE'){
                $ten = "Gate";
            }
            else if($mang=='VTC'){
                $ten = "VTC";
            }
            else $ten ="Vinaphone";
            //Check data
            if($mang == '' || $seri == '' || $sopin == '')
            {
                $this->Session->write('error_mobicard', 'Nhập đầy đủ thông tin');
                $this->redirect('/deposit/mobicard/');
            }

            //
            //Mã MerchantID dang kí trên Bảo Kim
            $merchant_id = '19002';
            //Api username
            $api_username = 'macintoshvn';
            //Api Pwd d
            $api_password = 'macintoshvn235dgsdg';
            //Mã TransactionId
            $transaction_id = time();
            //mat khau di kem ma website dang kí trên Bảo Kim
            $secure_code = '1e6cb0e1c37b25cf';

            $arrayPost = array(
                'merchant_id'=>$merchant_id,
                'api_username'=>$api_username,
                'api_password'=>$api_password,
                'transaction_id'=>$transaction_id,
                'card_id'=>$mang,
                'pin_field'=>$sopin,
                'seri_field'=>$seri,
                'algo_mode'=>'hmac'
            );
            ksort($arrayPost);
            $data_sign = hash_hmac('SHA1',implode('',$arrayPost), $secure_code);
            $arrayPost['data_sign'] = $data_sign;
            $curl = curl_init($bk);
            curl_setopt_array($curl, array(
                CURLOPT_POST=>true,
                CURLOPT_HEADER=>false,
                CURLINFO_HEADER_OUT=>true,
                CURLOPT_TIMEOUT=>30,
                CURLOPT_RETURNTRANSFER=>true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPAUTH=>CURLAUTH_DIGEST|CURLAUTH_BASIC,
                CURLOPT_USERPWD=>CORE_API_HTTP_USR.':'.CORE_API_HTTP_PWD,
                CURLOPT_POSTFIELDS=>http_build_query($arrayPost)
            ));
            $data = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $result = json_decode($data,true);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $time = time();
            if($status==200){
                $amount = $result['amount'];
                switch($amount) {
                    case 10000: $xu = 10000; break;
                    case 20000: $xu = 20000; break;
                    case 30000: $xu = 30000; break;
                    case 50000: $xu= 50000; break;
                    case 100000: $xu = 100000; break;
                    case 200000: $xu = 200000; break;
                    case 300000: $xu = 300000; break;
                    case 500000: $xu = 500000; break;
                    case 1000000: $xu = 1000000; break;
                }
                //Add history recharge
                //Update primary account
                $this->Member->Profile->query('UPDATE profiles SET primaryaccount = primaryaccount + ' . $xu * 0.8 . ' WHERE member_id = ' . $member_id);
                //
                $data_add = array(
                    'member_id' => $member_id,
                    'price' => $xu,
                    'cardcode' => $sopin,
                    'seri' => $seri,
                    'type' => $mang
                );
                $this->Member->Recharge->save($data_add);
                // Xu ly thong tin tai day
                $file = "carddung.log";
                $fh = fopen($file,'a') or die("cant open file");
                fwrite($fh,"Tai khoan: ". $member['Member']['username'] . '/' . $member['Member']['fullname'] .'/' . $member['Member']['email'] .", Loai the: ".$ten.", Menh gia: ".$amount.", Thoi gian: ".$time);
                fwrite($fh,"\r\n");
                fclose($fh);
                $this->Session->write('success_mobicard', "Bạn đã thanh toán thành công thẻ '.$ten.' mệnh giá '.$amount.'");
                $this->redirect('/deposit/mobicard/');
            }
            else
            {
                $error = $result['errorMessage'];
                $file = "cardsai.log";
                $fh = fopen($file,'a') or die("cant open file");
                fwrite($fh,"Tai khoan: ". $member['Member']['username'] . '/' . $member['Member']['fullname'] .'/' . $member['Member']['email'] .", Ma the: ".$sopin.", Seri: ".$seri.", Noi dung loi: ".$error.", Thoi gian: ".$time);
                fwrite($fh,"\r\n");
                fclose($fh);
                $this->Session->write('error_mobicard', "Thông tin thẻ cào không hợp lệ. " . $error);
                $this->redirect('/deposit/mobicard/');
            }
        }
        else
        {
            $this->redirect('/deposit/mobicard/');
        }
    }
    function atm_success()
    {
        if($this->Session->check('Member'))
        {
            $member_id = $this->Session->read('Member.id');
            $query_string = $this->params['url'];
//            date_default_timezone_set('Asia/Ho_Chi_Minh');
//            $date = new DateTime('@' . $query_string['created_on']);
//            unset($query_string['checksum']);
//            $data_sign = hash_hmac('SHA1', implode('', $query_string), 'ae543c080ad91c23');
            //Kiem tra du lieu
            //
            $this->Member->Atm->set('member_id', $member_id);
            if($this->Member->Atm->save($query_string))
            {
                $this->Member->Profile->query('UPDATE profiles SET primaryaccount = primaryaccount + ' . $query_string['net_amount'] . ' WHERE member_id = ' . $member_id);
                $this->Session->write('atm_success', 'Bạn đã nạp thành công ' . number_format($query_string['total_amount']) . ' vào tài khoản.');
                $this->redirect('/deposit/atm/');
            }
            else
            {
                $this->redirect('/deposit/atm/');
            }
        }
        else
        {
            $this->redirect('/members/login/');
        }
        //
        $this->redirect('/deposit/atm/');
    }
    function history_recharge()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        $recharge = null;
        $member_id = $this->Session->read('Member.id');
        $this->Member->Recharge->recursive = -1;
        $recharge = $this->Member->Recharge->find('all', array(
            'conditions' => array('member_id' => $member_id),
            'order' => array('Recharge.id' => 'DESC')
        ));
        $atms = null;
        $this->Member->Atm->recursive = -1;
        $atms = $this->Member->Atm->find('all', array(
            'conditions' => array('member_id' => $member_id),
            'order' => array('id' => 'DESC')
        ));
        $this->set(array(
            'atms' => $atms,
            'recharges' => $recharge,
            'title' => 'Lịch sử nạp tiền'
        ));
    }


    function account_info()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        $members = null;
        $member_id = $this->Session->read('Member.id');
        $this->Member->Profile->recursive = -1;
        $members = $this->Member->Profile->find('first', array(
            'conditions' => array('Profile.member_id' => $member_id)
        ));
        $this->set(array(
            'members' => $members,
            'title' => 'Thông tin tài khoản'
        ));
    }
    function orders()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        $orders = null;
        $member_id = $this->Session->read('Member.id');
        $this->Member->Product->Order->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => '10',
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.id = Order.product_id'
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
            ),
            'conditions' => array(
                'Product.member_id = ' . $member_id,
            ),
        );
        $orders = $this->paginate($this->Member->Product->Order);
        $this->set(array(
            'orders' => $orders,
            'title' => 'Hóa đơn'
        ));
    }
    function post_saved()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        $member_id = $this->Session->read('Member.id');
        $this->Member->Memberproduct->recursive = -1;
        $product_saved = null;
        $product_saved = $this->Member->Memberproduct->find('all', array(
//            'fields' => array('Product.id', 'Product.title', 'Product.productlink', 'Product.price', 'Product.price2', 'Product.acreage', 'Product.acreage2', 'Product.image'),
            'fields' => array('Product.*'),
            'joins' => array(
                array(
                    'table' => 'products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Memberproduct.product_id = Product.id'
                )
            ),
            'order' => array('Memberproduct.id' => 'DESC'),
            'conditions' => array('Memberproduct.member_id' => $member_id)
        ));
        $this->set(array(
            'title' => 'Danh sách tin bất động sản đã lưu',
            'product_saved' => $product_saved
        ));
    }
    function delete_postsaved()
    {
        $this->autoRender = false;
        if($this->Session->check('Member'))
        {
            $product_id = $this->request->data['product_id'];
            $member_id = $this->Session->read('Member.id');
            if($this->Member->Memberproduct->deleteAll(array('product_id' => $product_id, 'member_id' => $member_id)))
            {
                $this->Session->setFlash('Đã xóa', 'flashSuccess');
            }
        }
    }
    function check_username()
    {
        if($this->Session->check('Member'))
        {
            $this->autoRender = false;
            if($this->request->is('post') || $this->request->is('put'))
            {
                $username = $this->request->data['username'];
                $this->Member->recursive = -1;
                $member = $this->Member->find('first', array(
                    'fields' => array(
                        'Member.email',
                        'Member.username',
                        'Member.fullname'
                    ),
                    'conditions' => array(
                        'OR' => array(
                            'Member.username' => $username,
                            'Member.email' => $username
                        )
                    )
                ));
                if($member)
                {
                    $data = array(
                        'email' => $member['Member']['email'],
                        'username' => $member['Member']['username'],
                        'fullname' => $member['Member']['fullname']
                    );
                    echo json_encode($data);
                }
                else
                {
                    echo 'fail';
                }
            }
        }
    }
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    //Admin
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    public function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Search
        $url = $this->params['url'];
        //name
        $name = isset($url['name'])? $url['name']: '';
        $condition_email = '';
        $condition_username = '';
        if($name != '')
        {
            $condition_email = 'Member.email = "' . $name . '"';
            $condition_username = 'Member.username = "' . $name . '"';
        }


        $this->Member->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => 10   ,
            'joins' => array(
                array(
                    'table' => 'wards',
                    'alias' => 'Ward',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Ward.id = Member.ward_id'),
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Ward.district_id'),
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id'),
                ),
                array(
                    'table' => 'profiles',
                    'alias' => 'Profile',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Member.id = Profile.member_id'),
                ),
            ),
            'fields' =>'*',
            'order' => array('Member.id' => 'desc'),
            'conditions' => array(
                'OR' => array(
                    $condition_email,
                    $condition_username
                )
            )
        );
        $members = $this->paginate('Member');
        $this->set(array(
            'members' => $members,
            'title' => 'Danh sách thành viên',
        ));
    }
    public function admin_view_detail($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->Member->recursive = -1;
        $members = $this->Member->find('first', array(
            'joins' => array(
                array(
                    'table' => 'profiles',
                    'alias' => 'Profile',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Member.id = Profile.member_id')
                ),
                array(
                    'table' => 'wards',
                    'alias' => 'Ward',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Member.ward_id = Ward.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Ward.district_id = District.id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.province_id = Province.id')
                )
            ),
            'fields' => array('*'),
            'conditions' => array(
                'Member.id' => $id
            ),
        ));
        if(!$members)
        {
            $this->redirect('/admin/members');
        }
        //Lịch sử nạp tiền
        $recharge = null;
        $this->Member->Recharge->recursive = -1;
        $recharge = $this->Member->Recharge->find('all', array(
            'conditions' => array('member_id' => $id),
            'order' => array('Recharge.id' => 'DESC')
        ));
        //Tin đã đăng
        $this->Member->Product->recursive = -1;
        $sum_product = 0;
        $sum_product = $this->Member->Product->find('count', array(
            'conditions' => array('member_id' => $id)
        ));
        $this->set(array(
            'title' => 'Thông tin thành viên',
            'members' => $members,
            'recharges' => $recharge,
            'sum_product' => $sum_product
        ));
    }
    public function admin_recharge()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array(
            'title' => 'Nạp tiền tài khoản thành viên',
        ));
        if($this->request->is('post') || $this->request->is('put'))
        {
            $user = $this->request->data['Recharge']['email'];
            $price = $this->request->data['Recharge']['price'];
            $this->Member->recursive = -1;
            $members = $this->Member->find('first', array(
                'conditions' => array(
                    'OR' => array(
                        array('Member.email' => $user),
                        array('Member.username' => $user)
                    ),
                ),
                'joins' => array(
                    array(
                        'table' => 'profiles',
                        'alias' => 'Profile',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Member.id = Profile.member_id'
                    )
                ),
                'fields' => array('Member.id', 'Profile.id', 'Profile.member_id', 'Profile.primaryaccount')
            ));
            if(!$members)
            {
                $this->Session->setFlash('Email hoặc tên đăng nhập của thành viên không tồn tại', 'flashWarning');
            }
            else
            {
                if($price < 50000)
                {
                    $this->Session->setFlash('Vui lòng nhập số tiền tối thiểu 50.000', 'flashWarning');
                }
                else
                {
                    $this->Member->Recharge->recursive = -1;
                    $this->Member->Recharge->set('member_id', $members['Member']['id']);
                    if($this->Member->Recharge->save($this->request->data))
                    {
                        $this->Member->Profile->recursive = -1;
                        $this->Member->Profile->updateAll(
                            array('primaryaccount' => $members['Profile']['primaryaccount'] + $price),
                            array(
                                'Profile.member_id' => $members['Member']['id'],
                                'Profile.id' => $members['Profile']['id']
                            )
                        );
                        $this->Session->setFlash('Giao dịch thành công', 'flashSuccess');
                        $this->redirect('/admin/members/history_recharges');
                    }
                    else
                    {
                        $this->Session->setFlash('Lỗi hệ thống', 'flashError');
                    }
                }
            }
        }
    }
    public function admin_transfer()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array(
            'title' => 'Chuyển tiền',
        ));
        if($this->request->is('post') || $this->request->is('put'))
        {

        }
    }
    function admin_history_transfers()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $transfer = null;
        $this->Member->Transfer->recursive = -1;
        $transfer = $this->Member->Transfer->find('all', array(
            'joins' => array(
                array(
                    'table' => 'members',
                    'alias' => 'Member_receiver',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Transfer.memberreceive = Member_receiver.id'
                    )
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member_sender',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Transfer.member_id = Member_sender.id'
                )
            ),
            'fields' => array('Transfer.id', 'Transfer.member_id', 'Transfer.amount', 'Transfer.memberreceive', 'Transfer.created', 'Member_receiver.fullname', 'Member_sender.fullname', 'Member_receiver.id', 'Member_sender.id'),
            'conditions' => array(),
            'order' => array('Transfer.id' => 'DESC')
        ));
        $this->set(array(
            'transfers' => $transfer,
            'title' => 'Lịch sử chuyển tiền'
        ));
    }
    function admin_history_recharges()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $recharge = null;
        $this->Member->Recharge->recursive = -1;
        $recharge = $this->Member->Recharge->find('all', array(
            'joins' => array(
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Recharge.member_id = Member.id'
                )
            ),
            'fields' => array('*'),
            'order' => array('Recharge.id' => 'DESC')
        ));
        $this->set(array(
            'recharges' => $recharge,
            'title' => 'Lịch sử nạp tiền'
        ));
    }
    function admin_disactive()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            $member_id = $this->request->data['member_id'];
            $this->Member->recursive = -1;
            if($this->Member->updateAll(array('Member.status' => 0), array('Member.id' => $member_id)))
            {
                $this->Session->setFlash('Đã khóa tài khoản', 'flashSuccess');
            }
            else
            {
                $this->Session->setFlash('Lỗi', 'flashError');
            }
        }
    }
    function admin_active()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            $member_id = $this->request->data['member_id'];
            $this->Member->recursive = -1;
            if($this->Member->updateAll(array('Member.status' => 1), array('Member.id' => $member_id)))
            {
                $this->Session->setFlash('Đã mở khóa tài khoản', 'flashSuccess');
            }
            else
            {
                $this->Session->setFlash('Lỗi', 'flashError');
            }
        }
    }
    function admin_accounts()
    {

    }
    public function admin_post_product($member_id = 0)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Member
        $this->Member->recursive = -1;
        $members = $this->Member->findById($member_id);
        if(!$members)
        {
            $this->redirect('/admin/products');
        }
        //Product
        $this->Member->Product->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => '10',
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'transactiontypes',
                    'alias' => 'Transactiontype',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.transactiontype_id = Transactiontype.id'
                ),
                array(
                    'table' => 'wards',
                    'alias' => 'Ward',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.ward_id = Ward.id')
                ),
                array(
                    'table' => 'categoriesproducts',
                    'alias' => 'CategoryProduct',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('CategoryProduct.id = Product.categoryproduct_id')
                ),
                array(
                    'table' => 'groupsproducts',
                    'alias' => 'Group',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Group.id = CategoryProduct.groupproduct_id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Ward.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
                array(
                    'table' => 'directions',
                    'alias' => 'Direction',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Direction.id = Product.direction_id')
                )
            ),
            'conditions' => array(
                'Member.id' => $member_id
                //Dieu kien mac dinh
            ),
            'order' => array('Product.id' => 'DESC')
        );
        try
        {
            $product = $this->paginate('Product');
        }
        catch (NotFoundException $e)
        {
            $product = null;
        }
        $this->set(array(
            'members' => $members,
            'products' => $product,
            'title' => 'Tin đăng của thành viên',
        ));
    }
}