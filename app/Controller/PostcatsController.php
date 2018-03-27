<?php
class PostcatsController extends AppController
{

    ////////////////////////
    ////////////////////////
    //Admin
    ////////////////////////
    ////////////////////////
    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $postcats = null;
        $this->Postcat->recursive = -1;
        $postcats = $this->Postcat->find('all');
        $this->set(array(
            'postcats' => $postcats,
            'title' => 'Chuyên mục bài viết'
        ));

    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array('title' => 'Thêm chuyên mục bài viết'));
        //post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Postcat->save($this->request->data))
            {
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/postcats');
            }
            else
            {
                $this->Session->setFlash('Lỗi', 'flashError');
            }
        }
    }
    function admin_edit($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //
        $this->Postcat->recursive = -1;
        $postcats = $this->Postcat->findById($id);
        if($postcats)
        {
            $this->set(array(
                'postcats' => $postcats,
                'title' => 'Sửa chuyên mục bài viết'
            ));
        }
        else
        {
            $this->Session->setFlash('Not found', 'flashError');
            $this->redirect('/admin/postcats');
        }
        //post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Postcat->save($this->request->data))
            {
                $this->Session->setFlash('Đã sửa', 'flashSuccess');
                $this->redirect('/admin/postcats');
            }
            else
            {
                $this->Session->setFlash('Lỗi', 'flashError');
            }
        }
    }
    function admin_delete()
    {
        if($this->Session->check('Admin'))
        {
            $this->autoRender = false;
            $id = $this->request->data['postcat_id'];
            $this->Postcat->Post->recursive = -1;
            $count = $this->Postcat->Post->find('count', array(
                'conditions' => array('Post.post_category_id' => $id)
            ));
            if($count == 0)
            {
                if($this->Postcat->delete($id))
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