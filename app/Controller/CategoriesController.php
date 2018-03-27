<?php

class CategoriesController extends AppController
{
    public $components = array('RequestHandler', 'Paginator');
    public $helpers = array('Js' => array('Jquery'), 'Paginator', 'Html');
    public function get_category($groupproduct = null)
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            $groupproduct_id = $this->request->data['groupproduct_id'];
            $options = '<option value=""> -- Chọn phân loại -- </option>';
            $this->Category->recursive = -1;
            $category_data = $this->Category->find('all', array(
                'fields' => array('Category.id', 'Category.categoryname'),
                'conditions' => array('Category.groupproduct_id' => $groupproduct_id),
            ));
            foreach ($category_data as $item)
            {
                $options = $options . '<option value="' . $item['Category']['id'] .'">' . $item['Category']['categoryname'] . '</option>';
            }
            echo $options;
        }
    }


    ////////////////////////////////////
    ////////////////////////////////////
    ////Admin
    ///////////////////////////////////
    ///////////////////////////////////

    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //
        //Set group
        $groups = null;
        $this->Category->Group->recursive = -1;
        $group = $this->Category->Group->find('all');
        foreach ($group as $item) {
            $groups[$item['Group']['id']] = $item['Group']['groupname'];
        }
        $this->set(array('groups' => $groups));
        //Search
        $condition_group = '';
        if(isset($this->params['url']['group']))
        {
            $condition_group = 'Group.id = ' . $this->params['url']['group'];
        }
        $this->Category->recursive = -1;
        $this->paginate = array(
            'joins' => array(
                array(
                    'table' => 'groupsproducts',
                    'alias' => 'Group',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Category.groupproduct_id = Group.id'
                )
            ),
            'paramType' => 'querystring',
            'fields' => array('*'),
            'limit' => '10',
            'order' => array(
                'id' => 'ASC'
            ),
            'conditions' => array(
                $condition_group
            )
        );
        try
        {
            $categories = $this->paginate('Category');
            if($categories)
            {
                $this->set(
                    array(
                        'categories' => $categories
                    )
                );
            }
        }
        catch (NotFoundException $exception)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
        }
        $this->set(array(
            'title' => 'Chuyên mục tin đăng'
        ));
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Set group
        $groups = null;
        $this->Category->Group->recursive = -1;
        $group = $this->Category->Group->find('all');
        foreach ($group as $item)
        {
            $groups[$item['Group']['id']] = $item['Group']['groupname'];
        }
        //
        $this->set(array(
            'groups' => $groups,
            'title' => 'Thêm loại bất động sản'
        ));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Category->save($this->request->data))
            {
                $this->Session->setFlash('Thêm thành công', 'flashSuccess');
                $this->redirect('/admin/categories');
            }
        }
    }
    function admin_edit($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Category
        $this->Category->recursive = -1;
        $categories = $this->Category->findById($id);
        if(!$categories)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/categories');
        }
//        if()
        //Set group
        $groups = null;
        $this->Category->Group->recursive = -1;
        $group = $this->Category->Group->find('all');
        foreach ($group as $item)
        {
            $groups[$item['Group']['id']] = $item['Group']['groupname'];
        }
        //
        $this->set(array(
            'categories' => $categories,
            'groups' => $groups,
            'title' => 'Sửa loại bất động sản'
        ));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Category->save($this->request->data))
            {
                $this->Session->setFlash('Sửa thành công', 'flashSuccess');
                $this->redirect('/admin/categories');
            }
            else
            {
                $this->Session->setFlash('Lỗi thêm', 'flashError');
            }
        }
    }
    function admin_delete()
    {
        if($this->Session->check('Admin'))
        {
            $this->autoRender = false;
            $id = $this->request->data['category_id'];
            $this->Category->Product->recursive = -1;
            $count = $this->Category->Product->find("count", array("conditions" => array("categoryproduct_id" => $id)));
            if ($count == 0)
            {
                if($this->Category->delete($id))
                {
                    $this->Session->setFlash('Đã xóa', 'flashSuccess');
                }
            }
            else
            {
                $this->Session->setFlash('Không thể xóa', 'flashError');
            }
        }
        else
        {
            $this->Session->setFlash('Lỗi', 'flashError');
        }
    }
}