<?php
class DistrictsController extends AppController
{
    public $components = array('RequestHandler', 'Paginator', 'Library');
    public $helpers = array('Js' => array('Jquery'), 'Paginator', 'Html');

    /////////
    //Update link
    function updatelink()
    {
        $this->redirect('/');
        $this->District->recursive = -1;
        $districts = $this->District->find('all', array(
            'fields' => array('*'),
            'joins' => array(
               array(
                   'table' => 'provinces',
                   'alias' => 'Province',
                   'type' => 'INNER',
                   'foreignKey' => false,
                   'conditions' => array('Province.id = District.province_id')
               )
            ),
        ));
        foreach ($districts as $item)
        {
            if($item['District']['location'] != '')
            {
                $location = str_replace('N', '', $item['District']['location']);
                $location = str_replace(',', '', $location);
                $location = str_replace('E', '', $location);
                $arr = explode(' ', $location);
                $longitude = $arr[3] + (($arr[4] * 60) + $arr[5])/3600;
                $latitude = $arr[0] + (($arr[1] * 60) + $arr[2])/3600;
                $data_update = array(
//                    'District.id' => $item['District']['id'],
                    'District.longitude' => $longitude,
                    'District.latitude' => $latitude
//                'districtlink' => $this->Library->make_link($item['District']['districttype'] . '-' . $item['District']['districtname'] . '-' . $item['Province']['provincename']) . '-d' . $item['District']['id']
                );
                $this->District->updateAll($data_update, array('District.id' => $item['District']['id']));

            }
        }
    }
    /////////

    public function get_district($province_id = null)
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            $province_id = $this->request->data['province_id'];
            $options = '<option value=""> -- Quận huyện -- </option>';
            $this->District->recursive = -1;
            $distric_data = $this->District->find('all', array(
                'fields' => array('District.id', 'District.districtname', 'District.districttype'),
                'conditions' => array('District.province_id' => $province_id),
                'order' => array('District.districtname' => 'ASC')
            ));
            foreach ($distric_data as $item)
            {
                $options = $options . '<option value="' . $item['District']['id'] .'">' . $item['District']['districttype'] . ' ' . $item['District']['districtname'] . '</option>';
            }
            echo $options;
        }
    }
    public function get_district_link($province_id = null)
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            $province_link = $this->request->data['province_id'];
            $arr = explode('-', $province_link);
            $province_id = $arr[count($arr) - 1];
            $province_id = substr($province_id, 1);
            $options = '<option value=""> -- Quận huyện -- </option>';
            $this->District->recursive = -1;
            $distric_data = $this->District->find('all', array(
                'fields' => array('District.id', 'District.districtname', 'District.districttype', 'District.districtlink'),
                'conditions' => array('District.province_id' => $province_id),
                'order' => array('District.districtname' => 'ASC')
            ));
            foreach ($distric_data as $item)
            {
                $options = $options . '<option value="' . $item['District']['districtlink'] .'">' . $item['District']['districttype'] . ' ' . $item['District']['districtname'] . '</option>';
            }
            echo $options;
        }
    }
    public function get_location($district_id = null)
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            $district_id = $this->request->data['district_id'];
            $district = $this->District->find('first', array(
                'fields' => array('District.longitude', 'District.latitude'),
                'conditions' => array('District.id' => $district_id)
            ));
            if($district)
            {
                $data = array(
                    'longitude' => $district['District']['longitude'],
                    'latitude' => $district['District']['latitude'],
                );
                echo json_encode($data);
            }
        }
    }
    ///////////////////////////////////
    ///////////////////////////////////
    //Admin
    ///////////////////////////////////
    ///////////////////////////////////
    function admin_index()
    {
        //Search
        $url = $this->params['url'];
        $province_search_id = isset($url['province'])? $url['province']: 0;
        $condition_province = ($province_search_id > 0)? 'Province.id = ' . $province_search_id: '';
        $district_search_type = isset($url['type'])? $url['type']: 0;
        $condition_type = ($district_search_type != '')? 'District.districttype = "' . $district_search_type . '"': '';
        $district_search_name = isset($url['name'])? $url['name']: 0;
        $condition_name = ($district_search_name != '')? 'District.districtname LIKE "%' . $district_search_name . '%"': '';
        //End Search
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->District->recursive = -1;
        $this->paginate = array(
            'joins' => array(
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
                $condition_province,
                $condition_type,
                $condition_name
            )
        );
        try
        {
            //Provinces search
            $provinces = null;
            $province = $this->District->Province->find('all', array(
                'order' => array('provincename' => 'asc')
            ));
            if($province)
            {
                foreach ($province as $item)
                {
                    $provinces[$item['Province']['id']] = $item['Province']['provincename'];
                }
            }
            $district = $this->paginate('District');
            $this->set(array('provinces' => $provinces));
            if($district)
            {
                $this->set(
                    array(
                        'districts' => $district,
                        'title' => 'Danh sách quận huyện'
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
        $this->District->Province->recursive = -1;
        $province = $this->District->Province->find('all', array('order' => array('provincename' => 'asc')));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        $this->set(array(
            'provinces' => $provinces,
            'title' => 'Thêm quận huyện'

        ));
        //
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->District->save($this->request->data))
            {
                //Update link
                $data_update = array(
                    'id' => $this->District->id,
                    'districtlink' => $this->Library->make_link($this->request->data['District']['districtname'] . '-' . $this->District->id)
                );
                $this->District->save($data_update);
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/districts');
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
        $this->District->recursive = -1;
        $districts = $this->District->find('first', array(
            'conditions' => array('District.id' => $id)
        ));
        if(!$districts)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/districts');
        }
        $this->set(array('districts' => $districts));
        //
        $provinces = null;
        $this->District->Province->recursive = -1;
        $province = $this->District->Province->find('all', array('order' => array('provincename' => 'asc')));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        $this->set(array(
            'provinces' => $provinces,
            'title' => 'Sửa quận huyện'

        ));
        //
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->District->save($this->request->data))
            {
                //Update link
                $this->Session->setFlash('Đã sửa', 'flashSuccess');
                if(isset($this->request->data['redirect_url']) && $this->request->data['redirect_url'] != '')
                {
                    $this->redirect($this->request->data['redirect_url']);
                }
                else
                {
                    $this->redirect('/admin/districts');
                }
            }
        }
    }
    function admin_delete()
    {
        if($this->Session->check('Admin'))
        {
            $this->autoRender = false;
            $id = $this->request->data['district_id'];
            $delete = true;
            $this->District->Project->recursive = -1;
            $count_project = $this->District->Project->find("count", array("conditions" => array("district_id" => $id)));
            $this->District->Ward->recursive = -1;
            $count_ward = $this->District->Ward->find("count", array("conditions" => array("district_id" => $id)));
            if ($count_project > 0 || $count_ward > 0)
            {
                $delete = false;
            }

            if($delete == true)
            {
                if($this->District->delete($id))
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