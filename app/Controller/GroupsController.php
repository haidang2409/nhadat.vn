<?php
class GroupsController extends AppController
{
    public $components = array('RequestHandler', 'Paginator');
    public $helpers = array('Js' => array('Jquery'), 'Paginator', 'Html');
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
        $this->Group->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'fields' => array('*'),
            'limit' => '10',
            'order' => array(
                'sort' => 'ASC'
            ),
        );
        try
        {
            $groupproducts = $this->paginate('Group');
            if($groupproducts)
            {
                $this->set(
                    array(
                        'groupproducts' => $groupproducts
                    )
                );
            }
        }
        catch (NotFoundException $exception)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
        }
        $this->set(array('title' => 'Nhóm bất động sản'));
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array('title' => 'Thêm nhóm bất động sản'));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Group->save($this->request->data))
            {
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/groups');
            }
        }
    }
    function admin_edit($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Post
        $groups = $this->Group->findById($id);
        if(!$groups)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/groups');
        }
        $this->set(array(
            'groups' => $groups,
            'title' => 'Sửa nhóm bất động sản'
        ));
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Group->save($this->request->data))
            {
                $this->Session->setFlash('Đã sửa', 'flashSuccess');
                $this->redirect('/admin/groups');
            }
        }
    }
    function admin_delete()
    {
        if($this->Session->check('Admin'))
        {
            $this->autoRender = false;
            $id = $this->request->data['group_id'];
            $count = $this->Group->Category->find("count", array("conditions" => array("groupproduct_id" => $id)));
            if ($count == 0)
            {
                if($this->Group->delete($id))
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