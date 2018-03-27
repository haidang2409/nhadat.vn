<?php
class ProjectsController extends AppController
{
    public $components = array('Library');
    ///////////////////////////
    ///////////////////////////
    //User
    ///////////////////////////
    ///////////////////////////
    function index()
    {
        //Project
        $this->Project->recursive = -1;
        //Project
        $projects = $this->Project->find('all', array(
            'joins' => array(
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Project.district_id = District.id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.province_id = Province.id')
                ),
                array(
                    'table' => 'project_categories',
                    'alias' => 'Projectcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Project.project_category_id = Projectcat.id'
                )
            ),
            'fields' => array('*'),
            'conditions' => array('Project.vipproject' => 1, 'Project.status' => 1),
            'order' => array('Project.id' => 'desc'),
            'limit' => 9
        ));
        //Project new
        $this->Project->recursive = -1;
        $projects_new = $this->Project->find('all', array(
            'joins' => array(
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Project.district_id = District.id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.province_id = Province.id')
                ),
                array(
                    'table' => 'project_categories',
                    'alias' => 'Projectcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Project.project_category_id = Projectcat.id'
                )
            ),
            'fields' => array('*'),
            'conditions' => array('Project.vipproject' => 0, 'Project.status' => 1),
            'order' => array('Project.id' => 'desc'),
            'limit' => 10
        ));
        //Cat_project
        $this->Project->Projectcat->recursive = -1;
        $project_cats = $this->Project->Projectcat->find('all');

        $this->Project->District->Province->recursive = -1;
        $provinces_link = null;
        $province = $this->Project->District->Province->find('all', array(
            'order' => array('provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces_link[$item['Province']['provincelink']] = $item['Province']['provincename'];
        }
        $this->set(array(
            'provinces_link' => $provinces_link,
            'project_cats' => $project_cats,
            'projects' => $projects,
            'projects_new' => $projects_new,
            'title' => 'Dự án bất động sản',
        ));
    }
    function index_vip()
    {
        //Project
        $this->Project->recursive = -1;
        $projects = $this->Project->find('all', array(
            'joins' => array(
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Project.district_id = District.id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.province_id = Province.id')
                ),
                array(
                    'table' => 'project_categories',
                    'alias' => 'Projectcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Project.project_category_id = Projectcat.id'
                )
            ),
            'fields' => array('*'),
            'conditions' => array('Project.vipproject' => 1, 'Project.status' => 1),
            'order' => array('Project.id' => 'desc'),
            'limit' => 10
        ));
        //Cat_project
        $this->Project->Projectcat->recursive = -1;
        $project_cats = $this->Project->Projectcat->find('all');
        //Advertise
        $adv = ClassRegistry::init('Advertise')->find('all', array(
            //'conditions' => array('id' => 5)
        ));
        $this->set(array(
            'projects' => $projects,
            'title' => 'Dự án nổi bật',
            'advertise' => $adv,
        ));
    }
    function index_project()
    {
        $projectcat_search = isset($this->params['projectcat'])? $this->params['projectcat']: '';
        $projectcat_id_search = isset($this->params['projectcat_id'])? $this->params['projectcat_id']: '';

        $provinceid_search = isset($this->params['provinceid'])? $this->params['provinceid']: '';
        $districtid_search = isset($this->params['districtid'])? $this->params['districtid']: '';
        //Category
        $conditions_category = '';
        if($projectcat_search !== '' && $projectcat_id_search != '')
        {
            $conditions_category = 'Projectcat.project_category_link = "' . $projectcat_search . '" AND Projectcat.id = ' . $projectcat_id_search;
        }
        //Tim kiem province
        //
        $conditions_province_search = $provinceid_search != ''? 'Province.id = ' . substr($provinceid_search, 1): '';
        //District
        $conditions_district_search = $districtid_search != ''? 'District.id = ' . substr($districtid_search, 1): '';
        //
        //Project
        $projects = null;
        $this->Project->recursive = -1;
        $this->paginate = array(
            'joins' => array(
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Project.district_id = District.id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.province_id = Province.id')
                ),
                array(
                    'table' => 'project_categories',
                    'alias' => 'Projectcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Project.project_category_id = Projectcat.id'
                )
            ),
            'fields' => array('*'),
            'conditions' => array(
                'Project.vipproject = 0',
                'Project.status = 1',
                $conditions_category,
                $conditions_province_search,
                $conditions_district_search,
            ),
            'order' => array('Project.id' => 'desc'),
            'limit' => 10,
            'paramType' => 'querystring'
        );
        //Project
        try
        {
            $projects = $this->paginate('Project');
        }
        catch (NotFoundException $exception)
        {
            $this->Session->setFlash(__('Không có kết quả tìm kiếm theo yêu cầu'), 'flashError');
        }
        //Cat_project
        $this->Project->Projectcat->recursive = -1;
        $project_cats = $this->Project->Projectcat->find('all');
        //Advertise
        //Set breakcrmb
        $title = 'Dự án bất động sản';
        $this->Project->Projectcat->recursive = -1;
        if($projectcat_id_search != '')
        {
            $breakcrumb_category = $this->Project->Projectcat->find('first', array(
                'conditions' => array('Projectcat.id = ' . $projectcat_id_search, 'Projectcat.project_category_link = "' . $projectcat_search . '"')
            ));
            if($breakcrumb_category)
            {
                $this->set(array(
                    'breakcrumb_category' => $breakcrumb_category
                ));
                $title = $breakcrumb_category['Projectcat']['project_category_name'];
            }
        }
        //End breakcrumb
        //Set province for a tag search
        $provinces = null;
        $districts = null;
        //Nếu có province thì duyệt quan huyen cua 1 tinh, ul
        //Hoac co district thi duyet cac district co cung tinh thanh
        $id_province_or_district = '';
        //Breakcrumb
        //Set breadcrumb province
        if($provinceid_search != '')
        {
            $breakcrumb_province = $this->Project->query('SELECT * FROM provinces  AS Province WHERE id = ' . substr($provinceid_search, 1));
            if($breakcrumb_province)
            {
                $title = $title . ' tại ' . $breakcrumb_province[0]['Province']['provincename'];
                $this->set(array('breadcrumb_province' => $breakcrumb_province));
            }
        }
        //Set breadcrumb province
        if($districtid_search != '')
        {
            $breakcrumb_district = $this->Project->query('SELECT * FROM provinces  AS Province, districts AS District WHERE Province.id = District.province_id AND District.id = ' . substr($districtid_search, 1));
            if($breakcrumb_district)
            {
                $title = $title . ' tại ' . $breakcrumb_district[0]['District']['districtname'] . ' ' . $breakcrumb_district[0]['Province']['provincename'];
                $this->set(array('breadcrumb_district' => $breakcrumb_district));
            }
        }
        //Set ul
        if($provinceid_search != '')
        {
            $id_province_or_district = substr($provinceid_search, 1);
        }
        if($districtid_search != '')
        {
            $temp = $this->Project->query('SELECT province_id FROM districts WHERE id = ' . substr($districtid_search, 1));
            if($temp)
            {
                $id_province_or_district = $temp[0]['districts']['province_id'];
            }
        }
        if($provinceid_search != '' || $districtid_search !='')
        {
            $this->Project->District->Province->recursive = -1;
            $districts = $this->Project->District->Province->find('all', array(
                'fields' => array('Province.provincename', 'District.id', 'District.districtname', 'District.districtlink', 'COUNT(`District`.`id`) AS `sum`'),
                'joins' => array(
                    array(
                        'table' => 'districts',
                        'alias' => 'District',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Province.id = District.province_id'
                    ),
                    array(
                        'table' => 'projects',
                        'alias' => 'Project',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'District.id = Project.district_id'
                    ),
                    array(
                        'table' => 'project_categories',
                        'alias' => 'Projectcat',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Project.project_category_id = Projectcat.id')
                    )
                ),
                'conditions' => array(
                    'Project.vipproject = 0',
                    'District.province_id = ' . $id_province_or_district,
                    ($projectcat_id_search != '')? 'Projectcat.id = ' . $projectcat_id_search: '',
                    ($projectcat_search != '')? 'Projectcat.project_category_link = "' . $projectcat_search . '"': '',
                ),
                'group' => array('Province.provincename', 'District.id', 'District.districtname', 'District.districtlink'),
                'order' => array('sum' => 'DESC')
            ));
        }
        //Nguoc lai tra ve danh sach all tinh
        else
        {
            $this->Project->District->Province->recursive = -1;
            $provinces = $this->Project->District->Province->find('all', array(
                'fields' => array('Province.id', 'Province.provincename', 'provincelink', 'COUNT(`Province`.`id`) AS `sum`'),
                'joins' => array(
                    array(
                        'table' => 'districts',
                        'alias' => 'District',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Province.id = District.province_id'
                    ),
                    array(
                        'table' => 'projects',
                        'alias' => 'Project',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'District.id = Project.district_id'
                    ),
                    array(
                        'table' => 'project_categories',
                        'alias' => 'Projectcat',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Project.project_category_id = Projectcat.id')
                    )
                ),
                'conditions' => array(
                    'Project.vipproject = 0',
                    ($projectcat_id_search != '')? 'Projectcat.id = ' . $projectcat_id_search: '',
                    ($projectcat_search != '')? 'Projectcat.project_category_link = "' . $projectcat_search . '"': '',
                ),
                'group' => array('Province.id', 'Province.provincename', 'Province.provincelink'),
                'order' => array('sum' => 'DESC')
            ));
        }
        $this->set(array(
            'districts' => $districts,
            'provinces' => $provinces,
            'project_cats' => $project_cats,
            'projects_new' => $projects,
            'title' => $title,
        ));
    }
    //View
    function view_vip($projectcat, $projectcat_id, $projectlink, $id)
    {
        //Project
        $this->layout = 'default_project_detail';
        $this->Project->recursive = -1;
        //Project
        $projects = $this->Project->find('first', array(
            'joins' => array(
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Project.district_id = District.id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.province_id = Province.id')
                ),
                array(
                    'table' => 'project_categories',
                    'alias' => 'Projectcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Project.project_category_id = Projectcat.id'
                )
            ),
            'fields' => array('*'),
            'conditions' => array(
                'Project.vipproject' => 1,
                'Project.status' => 1,
                'projectlink' => $projectlink,
                'Project.id' => $id,
                'Projectcat.id' => $projectcat_id,
                'Projectcat.project_category_link' => $projectcat
            ),
        ));
        if($projects)
        {
            $this->set(array(
                'projects' => $projects,
                'title' => $projects['Project']['title'],
                'head_description' => $projects['Project']['summary'],
            ));
        }
    }
    function view_project($projectcat, $projectcat_id, $projectlink, $id)
    {
        //Project
        $this->layout = 'default_project';
        $this->Project->recursive = -1;
        //Project
        $projects = $this->Project->find('first', array(
            'joins' => array(
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Project.district_id = District.id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.province_id = Province.id')
                ),
                array(
                    'table' => 'project_categories',
                    'alias' => 'Projectcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Project.project_category_id = Projectcat.id'
                )
            ),
            'fields' => array('*'),
            'conditions' => array(
                'Project.vipproject' => 0,
                'Project.status' => 1,
                'projectlink' => $projectlink,
                'Project.id' => $id,
                'Projectcat.id' => $projectcat_id,
                'Projectcat.project_category_link' => $projectcat
            ),
        ));
        if($projects)
        {
            $this->set(array(
                'projects' => $projects,
                'title' => $projects['Project']['title'],
                'head_description' => $projects['Project']['summary'],
            ));

        }
    }
    //Ajax
    //Only not vip
    function get_count_project()
    {
        $this->autoRender = false;
        $data = $this->Project->query('select project_category_id, count(projects.id) as count_project from projects, project_categories WHERE projects.project_category_id = project_categories.id AND vipproject = 0 AND status = 1 group by project_category_id');
        $results = array();
        $i = 0;
        foreach ($data as $item)
        {
            $results[$i] = array(
                'cat' => $item['projects']['project_category_id'],
                'count' => $item[0]['count_project']
            );
            $i = $i + 1;
        }
        echo json_encode($results);
    }
    function get_count_project_vip()
    {
        $this->autoRender = false;
        $data = $this->Project->query('select count(projects.id) as count_project from projects WHERE  vipproject = 1 AND status = 1');
        $results = array();
        $i = 0;
        foreach ($data as $item)
        {
            $results[$i] = array(
                'cat' => 'vip',
                'count' => $item[0]['count_project']
            );
            $i = $i + 1;
        }
        echo json_encode($results);
    }
    //Vip + not vip
    ///////////////////////////
    ///////////////////////////
    //Admin
    ///////////////////////////
    ///////////////////////////
    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array(
            'title' => 'Dự án'
        ));
        $this->Project->recursive = -1;
        $this->paginate = array(
            'joins' => array(
                array(
                    'table' => 'project_categories',
                    'alias' => 'Projectcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Project.project_category_id = Projectcat.id'
                )
            ),
            'paramType' => 'querystring',
            'limit' => 10,
            'fields' => array('*'),
            'order' => array('Project.id' => 'DESC')
        );
        $projects = null;
        try
        {
            $projects = $this->paginate('Project');
        }
        catch (Exception $exception)
        {

        }
        $this->set(array('projects' => $projects));
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Set
        $projectcats = null;
        $this->Project->Projectcat->recursive = -1;
        $projectcat = $this->Project->Projectcat->find('all');
        foreach ($projectcat as $item)
        {
            $projectcats[$item['Projectcat']['id']] = $item['Projectcat']['project_category_name'];
        }
        //

        //Provinces
        $provinces = null;
        $this->Project->District->Province->recursive = -1;
        $province = $this->Project->District->Province->find('all', array(
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        $districts = null;
        if(isset($this->request->data['Project']['province']) && $this->request->data['Project']['province'] != '')
        {
            $this->Project->District->recursive = -1;
            $district = $this->Project->District->find('all', array(
                'conditions' => array('District.province_id' => $this->request->data['Project']['province'])
            ));
            foreach ($district as $item)
            {
                $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
            }
        }
        $this->set(array(
            'districts' => $districts,
            'provinces' => $provinces,
            'projectcats' => $projectcats,
            'title' => 'Thêm dự án'
        ));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Project->set($this->request->data);
            if($this->Project->validates())
            {
                $images = $this->request->data['Project']['image2'];
                if($images['name'] != '' && $images['error'] == 0 && ($images['type'] == 'image/jpeg' || $images['type'] == 'image/png'))
                {
                    if($images['size'] > 1000000)
                    {
                        $this->Session->setFlash('Vui lòng chọn hình ảnh dưới 1Mb', 'flashWarning');
                    }
                    else
                    {
                        $ext = pathinfo($images['name'], PATHINFO_EXTENSION);
                        $link = $this->Library->make_link($this->request->data['Project']['title']);
                        $file = $link . '.' . $ext;
                        $path = $this->path_project;
                        if(isset($this->request->data['Project']['vipproject']) && $this->request->data['Project']['vipproject'] == 1)
                        {
                            $path = $this->path_project_vip;
                        }
                        $path = $path . '/' . $link;
                        if(!file_exists($path))
                        {
                            mkdir($path, 0777);
                        }
                        $vip = '';
                        if(isset($this->request->data['Project']['vipproject']) && $this->request->data['Project']['vipproject'] == 1)
                        {
                            $vip = 'vip';
                        }
                        move_uploaded_file($images['tmp_name'], $path.'/'.$file);
                        $this->Project->set('projectlink', $link);
                        $this->Project->set('image', $vip.'/'.$link.'/'.$file);
                        if($this->Project->save($this->request->data))
                        {
                            $this->Session->setFlash('Đã thêm', 'flashSuccess');
                            $this->redirect('/admin/projects');
                        }
                    }
                }
                else
                {
                    $this->Session->setFlash('Vui lòng chọn hình ảnh', 'flashWarning');
                }
            }
            else
            {
                $this->Session->setFlash('Vui lòng nhập đầy đủ thông tin', 'flashWarning');
            }
        }
    }
    function admin_edit($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->Project->recursive = -1;
        $projects = $this->Project->find('first', array(
            'joins' => array(
                array(
                    'table' => 'project_categories',
                    'alias' => 'Projectcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Project.project_category_id = Projectcat.id'
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Project.district_id = District.id'
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'conditions' => 'District.province_id = Province.id'
                )
            ),
            'fields' => array('*'),
            'conditions' => array('Project.id' => $id)
        ));
        if(!$projects)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/projects');
        }
        //Set
        $projectcats = null;
        $this->Project->Projectcat->recursive = -1;
        $projectcat = $this->Project->Projectcat->find('all');
        foreach ($projectcat as $item)
        {
            $projectcats[$item['Projectcat']['id']] = $item['Projectcat']['project_category_name'];
        }
        //
        //Provinces
        $provinces = null;
        $this->Project->District->Province->recursive = -1;
        $province = $this->Project->District->Province->find('all', array(
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        $districts = null;
        $this->Project->District->recursive = -1;
        $district = $this->Project->District->find('all', array(
            'conditions' => array('District.province_id' => $projects['Province']['id'])
        ));
        foreach ($district as $item)
        {
            $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
        }
        $this->set(array(
            'projects' => $projects,
            'districts' => $districts,
            'provinces' => $provinces,
            'projectcats' => $projectcats,
            'title' => 'Sửa dự án'
        ));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Project->set($this->request->data);
            if($this->Project->validates())
            {
                $images = $this->request->data['Project']['image2'];
                if($images['name'] != '')
                {
                    if($images['type'] != 'image/png' && $images['type'] != 'image/jpeg')
                    {
                        $this->Session->setFlash('Vui lòng chọn hình ảnh', 'flashWarning');
                        $this->redirect($_SERVER['REQUEST_URI']);
                    }
                    elseif ($images['size'] > 1000000)
                    {
                        $this->Session->setFlash('Vui lòng chọn hình ảnh < 1Mb', 'flashWarning');
                        $this->redirect($_SERVER['REQUEST_URI']);
                    }
                }
                //upload images
                $link = $this->Library->make_link($this->request->data['Project']['title']);
                $ext = pathinfo($images['name'], PATHINFO_EXTENSION);
                if(isset($this->request->data['Project']['vipproject']) && $this->request->data['Project']['vipproject'] == 1)
                {

                }
                $file = $link.'.'.time().$ext;
                if($images['name'] != '')
                {
                    move_uploaded_file($images['tmp_name'], $this->path_project.'/'.$file);
                    $this->Project->set('image', $file);
                    if(file_exists($this->path_project.DS.$this->request->data['Project']['image_old']) && $this->request->data['Project']['image_old'] != '')
                    {
                        unlink($this->path_project.DS.$this->request->data['Project']['image_old']);
                    }
                }
                else
                {
                    $this->Project->set('image', $this->request->data['Project']['image_old']);
                }
                $this->Project->set('projectlink', $link);
                if($this->Project->save($this->request->data))
                {
                    $this->Session->setFlash('Đã cập nhật', 'flashSuccess');
                    $this->redirect('/admin/projects');
                }
            }
            else
            {
                $this->Session->setFlash('Vui lòng nhập đầy đủ thông tin', 'flashWarning');
            }
        }
    }
    function admin_view($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->Project->recursive = -1;
        $projects = $this->Project->find('first', array(
            'joins' => array(
                array(
                    'table' => 'project_categories',
                    'alias' => 'Projectcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Project.project_category_id = Projectcat.id'
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Project.district_id = District.id'
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'conditions' => 'District.province_id = Province.id'
                )
            ),
            'fields' => array('*'),
            'conditions' => array('Project.id' => $id)
        ));
        if(!$projects)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/projects');
        }
        else
        {
            $this->set(array(
                'projects' => $projects,
                'title' => 'Thông tin dự án'
            ));
        }
    }
    function admin_show_project()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            if($this->request->is('post'))
            {
                $project_id = $this->request->data['project_id'];
                $this->Project->unbindModel(
                    array('belongsTo' => array('District', 'Projectcat'))
                );
                if($this->Project->updateAll(array('Project.status' => 1), array('Project.id' => $project_id)))
                {
                    $this->Session->setFlash('Đã cập nhật', 'flashSuccess');
                }
            }
        }
    }
    function admin_hide_project()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            if($this->request->is('post'))
            {
                $project_id = $this->request->data['project_id'];
                $this->Project->unbindModel(
                    array('belongsTo' => array('District', 'Projectcat'))
                );
                if($this->Project->updateAll(array('Project.status' => 0), array('Project.id' => $project_id)))
                {
                    $this->Session->setFlash('Đã cập nhật', 'flashSuccess');
                }
            }
        }
    }
}