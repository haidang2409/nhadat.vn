<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $helpers = array('Lib', 'Html', 'Form', 'Session');
    public $components = array('Session', 'Cookie');
    //////////////////////
    //Path products
    public $path_product = '../webroot/uploads/products';
    public $path_product_thumb = '../webroot/uploads/products/thumb';
    public $path_post = '../webroot/uploads/posts';
    public $path_member_avatar = '../webroot/img/members';
    public $path_project = '../webroot/uploads/projects';
    public $path_project_vip = '../webroot/uploads/projects/vip';
    public $hours_re_up = 24;//thời gian toi thieu de reup
    ///Common
    public $phone = '0901 032 320';
    public $email = 'cskh@dream.edu.vn';
    //
    function beforeFilter()
    {
//        header('X-Powered-By: SAMORINE');
        //header('Server: NHADAT');
        $this->_setLanguage();
        if(isset($this->params['prefix']) && $this->params['prefix'] == 'admin')
        {
            if($this->Session->check('Admin'))
            {
                $this->layout = 'admin_default';
            }
        }

        if(!isset($this->params['prefix']))
        {
            //Set data for menu and search
            //Post
            ClassRegistry::init('Post')->recursive = -1;
            $posts_menu = ClassRegistry::init('Post')->find('all', array(
                'order' => array('id' => 'desc'),
                'limit' => 6,
                'conditions' => ('Post.status = 1')
            ));
            //Project
            ClassRegistry::init('Project')->recursive = -1;
            $project = ClassRegistry::init('Project')->find('all', array(
                'fields' => array('*'),
                'joins' => array(
                    array(
                        'table' => 'project_categories',
                        'alias' => 'Projectcat',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Project.project_category_id = Projectcat.id'
                    )
                ),
                'order' => array('Project.id' => 'desc'),
                'conditions' => array('Project.vipproject' => 1, 'Project.status' => 1),
                'limit' => '8, 0'
            ));
            //Menu cat and group
            $categories = ClassRegistry::init('Group')->find('all', array(
                'order' => array('Group.sort' => 'asc'),
                'conditions' => array('Group.sort >=' => 0),
            ));
            //Direction
            $directions = null;
            ClassRegistry::init('Direction')->recursive = -1;
            $direction = ClassRegistry::init('Direction')->find('all');
            foreach ($direction as $item)
            {
                $directions[$item['Direction']['id']] = $item['Direction']['directionname'];
            }
            //Province
            $provices = null;
            ClassRegistry::init('Province')->recursive = -1;
            $provice = ClassRegistry::init('Province')->find('all', array(
                'order' => array('Province.provincename')
            ));
            foreach ($provice as $item)
            {
                $provices[$item['Province']['provincelink']] = $item['Province']['provincename'];
            }
            //Advertise
            $adv = ClassRegistry::init('Advertise')->find('all', array(
//                'conditions' => array('id' => 5)
            ));
            //Product new
            $date = getdate();
            $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
            ClassRegistry::init('Product')->recursive = -1;
            $product_new = ClassRegistry::init('Product')->find('all', array(
                'limit' => '5',
                'fields' => array('*'),
                'joins' => array(
                    array(
                        'table' => 'wards',
                        'alias' => 'Ward',
                        'type' => 'LEFT',
                        'foreignKey' => false,
                        'conditions' => array('Product.ward_id = Ward.id')
                    ),
                    array(
                        'table' => 'categoriesproducts',
                        'alias' => 'Category',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Category.id = Product.categoryproduct_id')
                    ),
                    array(
                        'table' => 'groupsproducts',
                        'alias' => 'Group',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Group.id = Category.groupproduct_id')
                    ),
                    array(
                        'table' => 'members',
                        'alias' => 'Member',
                        'type' => 'LEFT',
                        'foreignKey' => false,
                        'conditions' => array('Product.member_id = Member.id')
                    ),
                    array(
                        'table' => 'districts',
                        'alias' => 'District',
                        'type' => 'LEFT',
                        'foreignKey' => false,
                        'conditions' => array('District.id = Ward.district_id')
                    ),
                    array(
                        'table' => 'provinces',
                        'alias' => 'Province',
                        'type' => 'LEFT',
                        'foreignKey' => false,
                        'conditions' => array('Province.id = District.province_id')
                    ),
                    array(
                        'table' => 'packets',
                        'alias' => 'Packet',
                        'type' => 'INNER',
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
                    'Product.status = 1',
                    'Product.paid = 1',
                    'Product.deleted = 0',
                    'Product.expiry >= "' . $cur_date . '"',
                ),
                'order' => array('Packet.sort' => 'asc', 'Product.date_paid' => 'desc')
            ));
            //Set
            $option_category = array();
            if($categories)
            {
                foreach ($categories as $item)
                {
                    $option_category[$item['Group']['grouplink'] . '-g' . $item['Group']['id']] = '+ ' . $item['Group']['groupname'];
                    foreach ($item['Category'] as $item_cat)
                    {
                        $option_category[$item_cat['categorylink'] . '-c' . $item_cat['id']] = '     - ' . $item_cat['categoryname'];
                    }
                }
            }
            $this->set(array(
                'type' => 'ban-',
                'categories_menu' => $categories,
                'option_category' => $option_category,
                'projects_menu' => $project,
                'direction_menu' => $directions,
                'province_menu' => $provices,
                'posts_menu' => $posts_menu,
                'advertise' => $adv,
                'product_new' => $product_new,
            ));
        }


    }
//Đa ngôn ngữ
    function _setLanguage()
    {
        //Nếu có cookie
        if ($this->Cookie->read('lang') && !$this->Session->check('Config.language')) {
            $this->Session->write('Config.language', $this->Cookie->read('lang'));
        }
        elseif(isset($this->params['url']['language']) && ($this->params['url']['language'] != $this->Session->read('Config.language'))) {
            $this->Session->write('Config.language', $this->params['url']['language']);
            $this->Cookie->write('lang', $this->params['url']['language'], false, '60 minutes');
        }
//        elseif(isset($this->params->params["named"]['language']) && ($this->params->params["named"]['language'] != $this->Session->read('Config.language'))) {
//            $this->Session->write('Config.language', $this->params->params["named"]['language']);
//            $this->Cookie->write('lang', $this->params->params["named"]['language'], false, '1 minutes');
//        }
    }

}
