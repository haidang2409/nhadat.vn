<?php
class ProjectcatsController extends AppController
{
    ///////////////////////////////////
    ///////////////////////////////////
    //Admin
    ///////////////////////////////////
    ///////////////////////////////////
    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $projectcats = null;
        $this->Projectcat->recursive = -1;
        $projectcats = $this->Projectcat->find('all');
        $this->set(array(
            'projectcats' => $projectcats,
            'title' => 'Nhóm dự án'
        ));
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array('title' => 'Thêm nhóm dự án'));
        //post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Projectcat->save($this->request->data))
            {
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/projectcats');
            }
        }
    }
    function admin_edit($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //set
        $this->Projectcat->recursive = -1;
        $projectcats = $this->Projectcat->findById($id);
        if($projectcats)
        {
            $this->set(array(
                'projectcats' => $projectcats,
                'title' => 'Sửa nhóm dự án'
            ));
        }
        else
        {
            $this->Session->setFlash('Not found', 'flashError');
            $this->redirect('/admin/projectcats');
        }
        //post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Projectcat->save($this->request->data))
            {
                $this->Session->setFlash('Đã sửa', 'flashSuccess');
                $this->redirect('/admin/projectcats');
            }
        }
    }
    function admin_delete()
    {
        if($this->Session->check('Admin'))
        {
            $this->autoRender = false;
            $id = $this->request->data['projectcat_id'];
            $this->Projectcat->Project->recursive = -1;
            $count = $this->Projectcat->Project->find('count', array(
                'conditions' => array(
                    'project_category_id' => $id
                )
            ));
            if($count == 0)
            {
                if($this->Projectcat->delete($id))
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