<?php
class WardsController extends AppController
{
    public $components = array('RequestHandler', 'Paginator', 'Library');
    public $helpers = array('Js' => array('Jquery'), 'Paginator', 'Html');

    //Update link
    function updatelink()
    {
        $this->redirect('/');
        $this->Ward->recursive = -1;
        $wards = $this->Ward->find('all', array(
//            'fields' => array('*'),
//            'joins' => array(
//                array(
//                    'table' => 'districts',
//                    'alias' => 'District',
//                    'type' => 'INNER',
//                    'foreignKey' => false,
//                    'conditions' => 'Ward.district_id = District.id'
//                ),
//                array(
//                    'table' => 'provinces',
//                    'alias' => 'Province',
//                    'type' => 'INNER',
//                    'foreignKey' => false,
//                    'conditions' => array('Province.id = District.province_id')
//                )
//            ),
            'conditions' => array('Ward.location != ""', 'Ward.longitude = 0')
        ));
        foreach ($wards as $item)
        {
            $location = str_replace('N', '', $item['Ward']['location']);
            $location = str_replace(',', '', $location);
            $location = str_replace('E', '', $location);
            $arr = explode(' ', $location);
            $longitude = $arr[3] + (($arr[4] * 60) + $arr[5])/3600;
            $latitude = $arr[0] + (($arr[1] * 60) + $arr[2])/3600;

            $data_update = array(
//                'id' => $item['Ward']['id'],
//                'wardlink' => $this->Library->make_link($item['Ward']['wardtype'] . '-' . $item['Ward']['wardname'] . '-' . $item['District']['districttype'] . '-' . $item['District']['districtname'] . '-' . $item['Province']['provincename']) . '-w' . $item['Ward']['id']
                'Ward.longitude' => $longitude,
                'Ward.latitude' => $latitude
            );
            $this->Ward->updateAll($data_update, array('Ward.id' => $item['Ward']['id']));
        }
    }
    /////////


    public function get_ward($district_id = null)
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            $district_id = $this->request->data['district_id'];
            $options = '<option value=""> -- Phường xã -- </option>';
            $this->Ward->recursive = -1;
            $ward_data = $this->Ward->find('all', array(
                'fields' => array('Ward.id', 'Ward.wardname', 'Ward.wardtype'),
                'conditions' => array('Ward.district_id' => $district_id),
                'order' => array('Ward.wardname' => 'ASC')
            ));
            foreach ($ward_data as $item)
            {
                $options = $options . '<option value="' . $item['Ward']['id'] .'">' . $item['Ward']['wardtype'] . ' ' . $item['Ward']['wardname'] . '</option>';
            }
            echo $options;
        }
    }
    public function get_ward_link($district_id = null)
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            $district_link = $this->request->data['district_id'];
            $arr = explode('-', $district_link);
            $district_id = $arr[count($arr) - 1];
            $district_id = substr($district_id, 1);
            $options = '<option value=""> -- Phường xã -- </option>';
            $this->Ward->recursive = -1;
            $ward_data = $this->Ward->find('all', array(
                'fields' => array('Ward.id', 'Ward.wardname', 'Ward.wardtype', 'Ward.wardlink'),
                'conditions' => array('Ward.district_id' => $district_id),
                'order' => array('Ward.wardname' => 'ASC')
            ));
            foreach ($ward_data as $item)
            {
                $options = $options . '<option value="' . $item['Ward']['wardlink'] .'">' . $item['Ward']['wardtype'] . ' ' . $item['Ward']['wardname'] . '</option>';
            }
            echo $options;
        }
    }
    public function get_location($ward_id = null)
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            $ward_id = $this->request->data['ward_id'];
            $ward = $this->Ward->find('first', array(
                'fields' => array('Ward.longitude', 'Ward.latitude'),
                'conditions' => array('Ward.id' => $ward_id)
            ));
            if($ward)
            {
                $data = array(
                    'longitude' => $ward['Ward']['longitude'],
                    'latitude' => $ward['Ward']['latitude'],
                );
                echo json_encode($data);
            }
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
        //Set
        //Province
        $provinces = null;
        $this->Ward->District->Province->recursive = -1;
        $province = $this->Ward->District->Province->find('all', array(
            'order' => array('provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        $districts = null;
        $this->set(array('provinces' => $provinces));
        if(isset($this->params['url']['province']) && $this->params['url']['province'] != '')
        {
            $this->Ward->District->recursive = -1;
            $district = $this->Ward->District->find('all', array(
                'conditions' => array('province_id' => $this->params['url']['province']),
                'order' => array('districtname' => 'ASC')
            )) ;
            foreach ($district as $item)
            {
                $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
            }
        }
        $this->set(array('districts' => $districts));
        //
        //Search
        $district_search = isset($this->params['url']['district'])? $this->params['url']['district']: '';
        $province_search = isset($this->params['url']['province'])? $this->params['url']['province']: '';
        $name = isset($this->params['url']['name'])? $this->params['url']['name']: '';
        $condition_district = '';
        $condition_name = '';
        $condition_province = '';
        if($district_search != '')
        {
            $condition_district = 'District.id = ' . $district_search;
        }
        if($province_search != '')
        {
            $condition_province = 'Province.id = ' . $province_search;
        }
        if($name != '')
        {
            $condition_name = 'Ward.wardname LIKE "%' . $name . '%"';
        }
        //

        $this->Ward->recursive = -1;
        $this->paginate = array(
            'joins' => array(
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Ward.district_id = District.id'
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'District.province_id = Province.id'
                )
            ),
            'paramType' => 'querystring',
            'fields' => array('*'),
            'limit' => '10',
            'conditions' => array(
                $condition_district,
                $condition_province,
                $condition_name
            )
        );
        try
        {
            $wards = $this->paginate('Ward');
            if($wards)
            {
                $this->set(
                    array(
                        'wards' => $wards,
                        'title' => 'Danh sách xã phường'
                    )
                );
            }
        }
        catch (NotFoundException $exception)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
        }
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //
        $provinces = null;
        $this->Ward->District->Province->recursive = -1;
        $province = $this->Ward->District->Province->find('all', array('order' => array('provincename' => 'asc')));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //isset province
        $districts = null;
        if(isset($this->request->data['Ward']['province']))
        {
            $province_id = $this->request->data['Ward']['province'];
            $this->Ward->District->recursive = -1;
            $district = $this->Ward->District->find('all', array(
                'conditions' => array(
                    'province_id' => $province_id
                ),
                'order' => array('districtname' => 'asc')
            ));
            if($district)
            {
                foreach ($district as $item)
                {
                    $districts[$item['District']['id']] = $item['District']['districtname'];
                }
            }
        }
        $this->set(array(
            'districts' => $districts,
            'provinces' => $provinces,
            'title' => 'Thêm phường xã'

        ));
        //
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Ward->save($this->request->data))
            {
                //Update link
                $data_update = array(
                    'id' => $this->Ward->id,
                    'wardlink' => $this->Library->make_link($this->request->data['Ward']['wardname'] . '-' . $this->Ward->id)
                );
                $this->Ward->save($data_update);
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/wards');
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
        $this->Ward->recursive = -1;
        $wards = $this->Ward->find('first', array(
            'joins' => array(
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Ward.district_id = District.id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.province_id = Province.id')
                )
            ),
            'fields' => array('*'),
            'conditions' => array('Ward.id' => $id)
        ));
        if(!$wards)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/wards');
        }
        //get district of province
        //
        $provinces = null;
        $this->Ward->District->Province->recursive = -1;
        $province = $this->Ward->District->Province->find('all', array('order' => array('provincename' => 'asc')));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //isset province
        $districts = null;
        $province_id = $wards['Province']['id'];
        if(isset($this->request->data['Ward']['province']))
        {
            $province_id = $this->request->data['Ward']['province'];
        }
        $this->Ward->District->recursive = -1;
        $district = $this->Ward->District->find('all', array(
            'conditions' => array(
                'province_id' => $province_id
            ),
            'order' => array('districtname' => 'asc')
        ));
        if($district)
        {
            foreach ($district as $item)
            {
                $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
            }
        }
        //
        $this->set(array(
            'districts' => $districts,
            'provinces' => $provinces,
            'title' => 'Sửa phường xã',
            'wards' => $wards
        ));
        //
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Ward->save($this->request->data))
            {
                //Update link
//                $data_update = array(
//                    'id' => $this->Ward->id,
//                    'wardlink' => $this->Library->make_link($this->request->data['Ward']['wardname'] . '-' . $this->Ward->id)
//                );
//                $this->Ward->save($data_update);
                $this->Session->setFlash('Đã sửa', 'flashSuccess');
                if(isset($this->request->data['redirect_url']) && $this->request->data['redirect_url'] != '')
                {
                    $this->redirect($this->request->data['redirect_url']);
                }
                else
                {
                    $this->redirect('/admin/wards');
                }
            }
        }
    }
    function admin_delete()
    {
        if($this->Session->check('Admin'))
        {
            $this->autoRender = false;
            $id = $this->request->data['ward_id'];
            $delete = true;
            $this->Ward->Product->recursive = -1;
            $count_product = $this->Ward->Product->find("count", array("conditions" => array("ward_id" => $id)));
            $this->Ward->Staff->recursive = -1;
            $count_staff = $this->Ward->Staff->find("count", array("conditions" => array("ward_id" => $id)));
            if ($count_product > 0 || $count_staff > 0)
            {
                $delete = false;
            }

            if($delete == true)
            {
                if($this->Ward->delete($id))
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

    //Action
    function admin_move_ward()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            if($this->request->is('post'))
            {
                $data = $this->request->data['data'];
                foreach ($data as $item)
                {
                    echo $item;
                }
            }
        }
    }
}