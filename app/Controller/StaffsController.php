<?php
App::uses('AuthComponent', 'Controller/Component');

class StaffsController extends AppController
{
    var $name = 'Staffs';
    public $helpers = array('Lib', 'Html', 'Form', 'Session');
    public $components = array('Session', 'Library');
    public $paginate = array(
        'limit' => 10,
        'conditions' => array(),
        'order' => array('Staff.id' => 'desc')
    );
    /////////////////////////////////
    /////////////////////////////////
    //Admin
    /////////////////////////////////
    /////////////////////////////////
    function admin_home()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array(
            'title' => 'Trang chủ'
        ));
        //Member
        ClassRegistry::init('Member')->recursive = -1;
        $members = ClassRegistry::init('Member')->find('all', array(
            'fields' => array(
                'Member.id',
                'Member.fullname',
                'Member.image',
                'Member.lastlogin'
            ),
            'order' => array('Member.lastlogin' => 'DESC'),
            'limit' => 12
        ));
        //Comment on post
        ClassRegistry::init('Commentpost')->recursive = -1;
        $comment_posts = ClassRegistry::init('Commentpost')->find('all', array(
            'joins' => array(
                array(
                    'table' => 'posts',
                    'alias' => 'Post',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Post.id = Commentpost.post_id'
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Member.id = Commentpost.member_id'
                )
            ),
            'fields' => array(
                'Member.id',
                'Member.fullname',
                'Member.image',
                'Post.id',
                'Post.title',
                'Post.postlink',
                'Commentpost.comment',
                'Commentpost.created',
                'Commentpost.id',
            ),
            'order' => array('Commentpost.id' => 'DESC'),
            'limit' => 10
        ));
        //Product
        ClassRegistry::init('Product')->recursive = -1;
        $product_new = ClassRegistry::init('Product')->find('all', array(
            'joins' => array(
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.member_id = Member.id'
                )
            ),
            'fields' => array(
                'Member.id',
                'Member.fullname',
                'Member.image',
                'Product.id',
                'Product.title',
                'Product.price',
                'Product.price2',
                'Product.acreage',
                'Product.acreage2',
                'Product.created'
            ),
            'order' => array('Product.id' => 'DESC'),
            'limit' => 10
        ));
        //Order

        //Counter product
        ClassRegistry::init('Product')->recursive = -1;
        $count_product = ClassRegistry::init('Product')->find('count');
        //Counter order
        ClassRegistry::init('Order')->recursive = -1;
        $count_order = ClassRegistry::init('Order')->find('count');
        ClassRegistry::init('Order')->recursive = -1;
        $counter_order_approval = ClassRegistry::init('Order')->find('count', array('conditions' => array('status' => 1)));
        ClassRegistry::init('Order')->recursive = -1;
        $counter_order_not_approval = ClassRegistry::init('Order')->find('count', array('conditions' => array('status' => 0)));
        $counter_product = array(
            'all' => $count_product,

        );
        $counter_order = array(
            'all' => $count_order,
            'approval' => $counter_order_approval,
            'not_approval' => $counter_order_not_approval
        );

        //Count member
        ClassRegistry::init('Member')->recursive = -1;
        $count_member = ClassRegistry::init('Member')->find('count');
        $counter_member = array(
            'all' => $count_member
        );
        //Set
        $this->set(array(
            'counter_member' => $counter_member,
            'counter_order' => $counter_order,
            'counter_product' => $counter_product,
            'product_news' => $product_new,
            'members' => $members,
            'comment_posts' => $comment_posts
        ));

    }
    function admin_login()
    {
        $this->layout = 'ajax';
        if($this->Session->check('Admin'))
        {
            $this->redirect('/admin/home');
        }
        $lock_login = false;
        $client_ip = $this->request->clientIp();
        debug($client_ip);
        //Kiểm tra Ip
        ClassRegistry::init('Ip')->recursive = -1;
        $ips = ClassRegistry::init('Ip')->find('first', array(
            'conditions' => array(
                'ip' => $client_ip
            )
        ));

        if($ips && $ips['Ip']['error_times'] >= 3)
        {
            $lock_login = true;
            $this->Session->setFlash('Bạn đăng nhập sai quá 3 lần, vui lòng thử lại sau 5 phút');
        }
        else
        {
            if($this->request->is('post') || $this->request->is('put'))
            {
//                debug('post');
                if($this->request->data['email'] == ''|| $this->request->data['password'] == '')
                {
                    $this->Session->setFlash('Nhập tên đăng nhập hoặc mật khẩu', 'flashError');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                $email = $this->request->data['email'];
                $password = AuthComponent::password($this->request->data['password']);
                $this->Staff->recursive = -1;
                $staffs = $this->Staff->find('first', array(
                    'conditions' => array(
                        'email' => $email,
                        'password' => $password,
                    )
                ));
                if($staffs)
                {
                    if($staffs['Staff']['status'] == 0)
                    {
                        $this->Session->setFlash('Tài khoản đã bị khóa, vui lòng liên hệ với ban quản trị', 'flashWarning');
                        $this->redirect('/admin/login');
                    }
                    else
                    {
                        $this->Session->write('Admin.fullname', $staffs['Staff']['fullname']);
                        $this->Session->write('Admin.email', $staffs['Staff']['email']);
                        $this->Session->write('Admin.id', $staffs['Staff']['id']);
                        $this->Session->write('Admin.rold', $staffs['Staff']['role']);
                        $this->Session->write('Admin.image', $staffs['Staff']['image']);
                        $this->redirect('/admin/home');
                    }
                }
                else
                {
                    ClassRegistry::init('Ip')->recursive = -1;
                    $ips = ClassRegistry::init('Ip')->find('first', array(
                        'conditions' => array(
                            'ip' => $client_ip
                        )
                    ));
                    if($ips)
                    {
                        ClassRegistry::init('Ip')->query("UPDATE ips SET error_times = error_times + 1 WHERE ip = '$client_ip'");
                    }
                    else
                    {
                        $data_error_ip = array(
                            'ip' => $client_ip,
                            'error_times' => 1,
                        );
                        ClassRegistry::init('Ip')->save($data_error_ip);
                    }
                    //
                    $this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không đúng');

                    ClassRegistry::init('Ip')->recursive = -1;
                    $ips = ClassRegistry::init('Ip')->find('first', array(
                        'conditions' => array(
                            'ip' => $client_ip
                        )
                    ));

                    if($ips && $ips['Ip']['error_times'] >= 3)
                    {
                        $lock_login = true;
                        $this->Session->setFlash('Bạn đăng nhập sai quá 3 lần, vui lòng thử lại sau 300\'');
                    }

//                $this->redirect('/admin');
                }
            }
        }

        //
        $this->set(array(
            'lock_login' => $lock_login
        ));
        //

    }
    function admin_logout()
    {
        $this->Session->delete('Admin');
        $this->redirect('/admin/login');
    }
    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $staffs = null;
        $this->Staff->recursive = -1;
        $staffs = $this->Staff->find('all', array(
            'joins' => array(
                array(
                    'table' => 'wards',
                    'alias' => 'Ward',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => 'Staff.ward_id = Ward.id'
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => 'Ward.district_id = District.id'
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => 'District.province_id = Province.id'
                )
            ),
            'fields' => array('Staff.*', 'Province.provincename', 'District.districtname', 'Ward.wardname')
        ));
        $this->set(
            array(
                'staffs' => $staffs,
                'title' => 'Nhân viên'
            )
        );
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Set province
        $provinces = null;
        $this->Staff->Ward->District->Province->recursive = -1;
        $province = $this->Staff->Ward->District->Province->find('all', array(
            'order' => array('provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //District
        $districts = null;
        if(isset($this->request->data['Staff']['province']))
        {
            $this->Staff->Ward->District->recursive = -1;
            $district = $this->Staff->Ward->District->find('all', array(
                'conditions' => array('province_id' => $this->request->data['Staff']['province'])
            ));
            foreach ($district as $item)
            {
                $districts[$item['District']['id']] = $item['District']['districtname'];
            }
        }
        //Ward
        $wards = null;
        if(isset($this->request->data['Staff']['district']))
        {
            $this->Staff->Ward->recursive = -1;
            $ward = $this->Staff->Ward->find('all', array(
                'conditions' => array('district_id' => $this->request->data['Staff']['district'])
            ));
            foreach ($ward as $item)
            {
                $wards[$item['Ward']['id']] = $item['Ward']['wardname'];
            }
        }
        //set
        $this->set(array(
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
            'title' => 'Thêm nhân viên'
        ));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Staff->set('status', 1);
            $this->Staff->set('image', 'default_user.jpg');
            if($this->request->data['Staff']['birth'] != '')
            {
                $this->Staff->set('birthday', implode('-', array_reverse(explode('/', $this->request->data['Staff']['birth']))));
            }
            if($this->Staff->save($this->request->data))
            {
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/staffs');
            }
        }
    }
    function admin_edit($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Set staff
        $staffs = null;
        $this->Staff->recursive = -1;
        $staffs = $this->Staff->find('first', array(
            'joins' => array(
                array(
                    'table' => 'wards',
                    'alias' => 'Ward',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => 'Staff.ward_id = Ward.id'
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => 'Ward.district_id = District.id'
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => 'District.province_id = Province.id'
                )
            ),
            'fields' => array('Staff.*', 'Province.id', 'District.id', 'Ward.id'),
            'conditions' => array(
                'Staff.id' => $id
            )
        ));
        if(!$staffs)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/staffs');
        }
        //Set province
        $provinces = null;
        $this->Staff->Ward->District->Province->recursive = -1;
        $province = $this->Staff->Ward->District->Province->find('all', array(
            'order' => array('provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //District
        $districts = null;
        $this->Staff->Ward->District->recursive = -1;
        $district = $this->Staff->Ward->District->find('all', array(
            'conditions' => array('province_id' => $staffs['Province']['id'])
        ));
        foreach ($district as $item)
        {
            $districts[$item['District']['id']] = $item['District']['districtname'];
        }
        //Ward
        $wards = null;
        $this->Staff->Ward->recursive = -1;
        $ward = $this->Staff->Ward->find('all', array(
            'conditions' => array('district_id' => $staffs['District']['id'])
        ));
        foreach ($ward as $item)
        {
            $wards[$item['Ward']['id']] = $item['Ward']['wardname'];
        }
        //set
        $this->set(array(
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
            'staffs' => $staffs,
            'title' => 'Sửa thông tin nhân viên',
        ));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Staff->set('status', 1);
            $this->Staff->set('image', 'default_user.jpg');
            if($this->request->data['Staff']['birth'] != '')
            {
                $this->Staff->set('birthday', implode('-', array_reverse(explode('/', $this->request->data['Staff']['birth']))));
            }
            if($this->Staff->save($this->request->data))
            {
                $this->Session->setFlash('Đã sửa', 'flashSuccess');
                $this->redirect('/admin/staffs');
            }
        }
    }
    function admin_enable()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            if($this->request->is('post') || $this->request->is('put'))
            {
                $staff_id = $this->request->data['staff_id'];
                $data_update = array(
                    'id' => $staff_id,
                    'status' => 1
                );
                if($this->Staff->save($data_update))
                {
                    $this->Session->setFlash('Đã mở khóa tài khoản', 'flashSuccess');
                }
                else
                {
                    $this->Session->setFlash('Lỗi', 'flashError');
                }
            }
        }
    }
    function admin_disable()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            if($this->request->is('post') || $this->request->is('put'))
            {
                $staff_id = $this->request->data['staff_id'];
                $data_update = array(
                    'id' => $staff_id,
                    'status' => 0
                );
                if($this->Staff->save($data_update))
                {
                    $this->Session->setFlash('Đã khóa tài khoản', 'flashSuccess');
                }
                else
                {
                    $this->Session->setFlash('Lỗi', 'flashError');
                }
            }
        }
    }
    function admin_view()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array('title' => 'Thông tin nhân viên'));
    }
    function admin_my_profile()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
    }


    //Menu min
    function admin_set_status_menu()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            if($this->request->is('post'))
            {
                $status = $this->request->data['status'];
                if($status == 'true')
                {
                    $this->Session->write('min-menu', 'true');
                    echo 'hide';
                }
                else
                {
                    $this->Session->write('min-menu', 'false');
                    echo 'show';
                }
            }
        }
    }
}