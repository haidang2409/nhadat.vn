<?php
class RecruitmentsController extends AppController
{
    public $components = array('Library');
    ////////////////////////////////
    ////////////////////////////////
    //User
    ////////////////////////////////
    ////////////////////////////////
    function index()
    {
        $this->layout = 'default2';
        $recruitments = $this->Recruitment->find('all', array(
            'order' => array('Recruitment.id' => 'DESC'),
        ));
        $this->set(array(
            'recruitments' => $recruitments,
            'title' => 'Thông tin tuyển dụng'
        ));
    }
    function view()
    {
        $this->layout = 'default2';
        $link = isset($this->params['link'])? $this->params['link']: '';
        $this->Recruitment->recursive = -1;
        $recruitments = $this->Recruitment->findByRecruitmentlink($link);
        if($recruitments)
        {
            $this->set(
                array(
                    'recruitments' => $recruitments,
                    'title' => $recruitments['Recruitment']['title'],
                    'head_description' => $recruitments['Recruitment']['title'],
                )
            );
        }
        else
        {
            $this->redirect('/tuyen-dung');
        }
    }
    ////////////////////////////////
    ////////////////////////////////
    //Admin
    ////////////////////////////////
    ////////////////////////////////
    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $recruitments = $this->Recruitment->find('all', array(
            'order' => array('Recruitment.id' => 'DESC'),
        ));
        $this->set(array(
            'recruitments' => $recruitments,
            'title' => 'Tin tuyển dụng'
        ));
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array('title' => 'Thêm tin tuyển dụng'));
        //
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Recruitment->set('staff_id', $this->Session->read('Admin.id'));
            $this->Recruitment->set('recruitmentlink', $this->Library->make_link($this->request->data['Recruitment']['title']));
            if($this->Recruitment->save($this->request->data))
            {
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/recruitments');
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
        $this->Recruitment->recursive = -1;
        $recruitments = $this->Recruitment->findById($id);
        if($recruitments)
        {
            $this->set(array(
                'recruitments' => $recruitments,
                'title' => 'Sửa tin tuyển dụng'
            ));
        }
        else
        {
            $this->Session->setFlash('Not found', 'flashError');
            $this->redirect('/admin/recruitments');
        }
        //
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Recruitment->set('staff_id', $this->Session->read('Admin.id'));
            if($this->Recruitment->save($this->request->data))
            {
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/recruitments');
            }
        }
    }
    function admin_delete()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            $id = $this->request->data['recruitment_id'];
            if($this->Recruitment->delete($id))
            {
                $this->Session->setFlash('Đã xóa', 'flashSuccess');
            }
        }
        else
        {
            $this->Session->setFlash('Lỗi', 'flashError');
        }
    }
    function admin_view($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/recruitments');
        }
        $this->Recruitment->recursive = -1;
        $recruitments = $this->Recruitment->findById($id);
        if($recruitments)
        {
            $this->set(array(
                'recruitments' => $recruitments,
                'title' => 'Chi tiết tin tuyển dụng'
            ));
        }
        else
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashError');
            $this->redirect('/admin/recruitments');
        }
    }
}