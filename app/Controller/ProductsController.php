<?php
class ProductsController extends AppController
{
    public $components = array('RequestHandler', 'Paginator', 'Library');
    public $helpers = array('Js' => array('Jquery'), 'Paginator', 'Html');
//    public
    ////////////////////////////////////////
    ////////////////////////////////////////
    //User
    ////////////////////////////////////////
    ////////////////////////////////////////
    //Apis
    public function api_get_products($serect_key = '')
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $this->response->type('json');
        $result = array();
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        //
        $this->Product->recursive = -1;
        $product_new = $this->Product->find('all', array(
            'limit' => '6',
            'fields' => array(
                'Product.id',
                'Product.title',
                'Product.productlink',
                'Product.price',
                'Product.price2',
                'Product.acreage',
                'Product.acreage2',
                'Product.image',
                'District.districttype',
                'District.districtname',
                'Province.provincename',
            ),
            'joins' => array(
                array(
                    'table' => 'wards',
                    'alias' => 'Ward',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Product.ward_id = Ward.id')
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
            ),
            'conditions' => array(
                'Product.status = 1',
                'Product.paid = 1',
                'Product.deleted = 0',
                'Product.expiry >= "' . $cur_date . '"',
            ),
            'order' => array('Packet.sort' => 'asc', 'Product.date_paid' => 'desc')
        ));
        if($product_new)
        {
            $i = 0;
            foreach ($product_new as $item)
            {
                $image_link = "http://nhadatphong.com/uploads/products/no-image-product.png";
                if($item['Product']['image'] != '' && file_exists($this->path_product_thumb . '/' . $item['Product']['image']))
                {
                    $image_link = "http://nhadatphong.com/uploads/products/thumb/" . $item['Product']['image'];
                }
                $title = htmlentities($item['Product']['title'], ENT_QUOTES, 'UTF-8');
                $address = htmlentities($item['District']['districttype'] . ' ' . $item['District']['districtname'] . ', ' . $item['Province']['provincename'], ENT_QUOTES, 'UTF-8');
                $price = '';
                if($item['Product']['price'] == 0)
                {
                    $price = 'Thỏa thuận';
                }
                else if($item['Product']['price2'] > $item['Product']['price'] && $item['Product']['price2'] > 0)
                {
                    $price = $this->Library->format_price_onlynumber($item['Product']['price']) . ' - ' . $this->Library->format_price($item['Product']['price2']);
                }
                else
                {
                    $price = $this->Library->format_price($item['Product']['price']);
                }
                $acreage = '';
                if ($item['Product']['acreage'] > 0 && $item['Product']['acreage2'] > $item['Product']['acreage'])
                {
                    $acreage = number_format($item['Product']['acreage'], 0, '', '.') . ' - ' . number_format($item['Product']['acreage2'], 0, '', '.');
                }
                else
                {
                    $acreage = number_format($item['Product']['acreage'], 0, '', '.');
                }

                $result[$i] = array(
                    'title' => $title,
                    'productlink' => 'http://nhadatphong.com/' . $item['Product']['productlink'] . '-' . $item['Product']['id'],
                    'address' => $address,
                    'price' => $price,
                    'acreage' => $acreage,
                    'image' => $image_link,

                );
                $i = $i + 1;
            }
            echo json_encode($result);
            $this->response->header('Access-Control-Allow-Origin', '*');
            $this->response->header('Content-type: application/json; charset=utf-8');
            // $this->response->header("Content-length: 96000");
        }
    }

    //Home trang chủ
    public function index()
    {
        //Ngay het han
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        ///
        $this->Product->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => '10',
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'transactiontypes',
                    'alias' => 'Transactiontype',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.transactiontype_id = Transactiontype.id'
                ),
                array(
                    'table' => 'wards',
                    'alias' => 'Ward',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.ward_id = Ward.id')
                ),
                array(
                    'table' => 'categoriesproducts',
                    'alias' => 'CategoryProduct',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('CategoryProduct.id = Product.categoryproduct_id')
                ),
                array(
                    'table' => 'groupsproducts',
                    'alias' => 'Group',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Group.id = CategoryProduct.groupproduct_id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Ward.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
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
                //Dieu kien mac dinh
                'Product.status = 1',
                'Product.paid = 1',
                'Product.deleted = 0',
                'Product.expiry >= "' . $cur_date . '"',
//                'Transactiontype.vend = 1',
                //Dieu kien tim kiem
            ),
            'order' => array('Packet.sort' => 'asc', 'Product.date_paid' => 'desc')
        );
        try
        {
            $product = $this->paginate('Product');
        }
        catch (NotFoundException $e)
        {
            $this->Session->setFlash('Not found', 'flashError');
        }
        $this->set(array(
            'products' => $product,
        ));

        //Tim kiem
        //Province
        $provinces = null;
        $this->Product->Ward->District->Province->recursive = -1;
        $province = $this->Product->Ward->District->Province->find('all', array(
            'fields' => array('Province.id', 'Province.provincename'),
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item){
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //Direction
        $directions = null;
        $this->Product->Direction->recursive = -1;
        $direction = $this->Product->Direction->find('all');
        foreach ($direction as $item)
        {
            $directions[$item['Direction']['id']] = $item['Direction']['directionname'];
        }
        //Project
        $this->Product->Project->recursive = -1;
        $projects = $this->Product->Project->find('all', array(
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
            'limit' => 6
        ));
        $this->set(array(
            'title' => 'Nhà | Đất | Phòng bán - cho thuê',
            'provinces' => $provinces,
            'directions' => $directions,
            'projects' => $projects,
            'allow_share' => true
        ));
    }
    //nha-dat
    public function index_product()
    {
        //Title
        $title_type = 'Bán, cho thuê ';
        $title_location = '';
        $title = 'Nhà đất bán - cho thuê';
        //Group
        $group_id_search = isset($this->params['groupid'])? substr($this->params['groupid'], 1): '';
        $condition_group = '';
        if($group_id_search != '')
        {
            $condition_group = 'Group.id = ' . $group_id_search;
        }
        //Category
        $category_id_search = isset($this->params['categoryid'])? substr($this->params['categoryid'], 1): '';
        $condition_category = '';
        if($category_id_search != '')
        {
            $condition_category = 'CategoryProduct.id = ' . $category_id_search;
        }
        //Province
        $province_id_search = isset($this->params['provinceid'])? substr($this->params['provinceid'], 1): '';
        $condition_province = '';
        if($province_id_search != '')
        {
            $condition_province = 'Province.id = ' . $province_id_search;
        }
        //District
        $district_id_search = isset($this->params['districtid'])? substr($this->params['districtid'], 1): '';
        $condition_district = '';
        if($district_id_search != '')
        {
            $condition_district = 'District.id = ' . $district_id_search;
        }
        //Ward
        $ward_id_search = isset($this->params['wardid'])? substr($this->params['wardid'], 1): '';
        $condition_ward = '';
        if($ward_id_search != '')
        {
            $condition_ward = 'Ward.id = ' . $ward_id_search;
        }

        $url = $this->params['url'];
        $buy = isset($this->params['type'])? $this->params['type']: ''; // Set = ban or cho-thue or can-mua or can-thue ở router
        //
        //Điều kiện xác định bán hoặc cho thuê
        $condition_buy = '';
        if($buy != '' && $buy == 'ban')
        {
            $title_type = 'Bán ';
            $title = 'Nhà đất bán';
            $condition_buy = 'Transactiontype.vend = 1 AND Transactiontype.buy = 1';
        }
        if($buy != '' && $buy == 'cho-thue')
        {
            $title_type = 'Cho thuê ';
            $title = 'Nhà đất cho thuê';
            $condition_buy = 'Transactiontype.vend = 1 AND Transactiontype.buy = 0';
        }
        if($buy != '' && $buy == 'can-mua')
        {
            $title_type = 'Cần mua ';
            $title = 'Cần mua nhà đất';
            $condition_buy = 'Transactiontype.vend = 0 AND Transactiontype.buy = 1';
        }
        if($buy != '' && $buy == 'can-thue')
        {
            $title_type = 'Cần thuê ';
            $title = 'Cần thuê nhà đất';
            $condition_buy = 'Transactiontype.vend = 0 AND Transactiontype.buy = 0';
        }
        //
        //Dieu kien tim kiem
        //Giá
        $price = isset($url['price'])? $url['price']: '';
        $arr_price = explode('_', $price);
        $price_min = isset($arr_price[0])? $arr_price[0]: 0;
        $price_max = isset($arr_price[1])? $arr_price[1]: 0;
        $condition_price_min = ($price_min > 0)? 'Product.price >= ' . $price_min: '';
        $condition_price_max = ($price_max > 0)? 'Product.price <= ' . $price_max: '';
        $condition_price_deal = '';
        if($price_min == -1 && $price_max == -1)
        {
            $condition_price_deal = 'Product.price = 0';
        }
        //Dien tich
        $acreage = isset($url['acreage'])? $url['acreage']: '';
        $arr_acreage = explode('_', $acreage);
        $acreage_min = isset($arr_acreage[0])? $arr_acreage[0]: 0;
        $acreage_max = isset($arr_acreage[1])? $arr_acreage[1]: 0;
        $condition_acreage_min = ($acreage_min > 0)? 'Product.acreage >= ' . $acreage_min: '';
        $condition_acreage_max = ($acreage_max > 0)? 'Product.acreage <= ' . $acreage_max: '';
        //Direction
        $direction_search_id = isset($url['direction'])? $url['direction']: 0;
        $condition_direction = ($direction_search_id > 0)? 'Direction.id = ' . $direction_search_id: '';
        //Floor
        $floor_search = isset($url['floor_number'])? $url['floor_number']: 0;
        $condition_floornumber = ($floor_search > 0)? 'Product.floornumber >= ' . $floor_search: '';
        //Room
        $room_search = isset($url['room_number'])? $url['room_number']: 0;
        $condition_roomnumber = ($room_search > 0)? 'Product.roomnumber >= ' . $room_search: '';
        //Key
        $key_search = isset($url['search'])? $url['search']: 0;
        $condition_key = ($key_search != '')? 'Product.title LIKE "%' . $key_search . '%"': '';
        //End dieu kien tim kiem
        /////Dieu kien mac dinh
        //Ngay het han
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        ///
        $p_order = array('Packet.sort' => 'asc', 'Product.date_paid' => 'desc');
        if(isset($url['srt']) && $url['srt'] == 'new')
        {
            $p_order = array('Product.date_paid' => 'DESC');
        }
        if(isset($url['srt']) && $url['srt'] == 'priceup')
        {
            $p_order = array('Product.price' => 'ASC');
        }
        if(isset($url['srt']) && $url['srt'] == 'pricedown')
        {
            $p_order = array('Product.price' => 'DESC');
        }
        if(isset($url['srt']) && $url['srt'] == 'acreageup')
        {
            $p_order = array('Product.acreage' => 'ASC');
        }
        if(isset($url['srt']) && $url['srt'] == 'acreagedown')
        {
            $p_order = array('Product.acreage' => 'DESC');
        }
        // set ul for location
        $wards_option = array();
        $districts_option = array();
        if($ward_id_search != '')
        {
            $this->Product->recursive = -1;
            $wards = $this->Product->find('all', array(
                'fields' => array('Ward.id', 'Ward.wardname', 'Ward.wardtype', 'Ward.wardlink', 'COUNT(`Ward`.`id`) AS `sum`'),
                'joins' => array(
                    array(
                        'table' => 'transactiontypes',
                        'alias' => 'Transactiontype',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Product.transactiontype_id = Transactiontype.id'
                    ),
                    array(
                        'table' => 'wards',
                        'alias' => 'Ward',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Product.ward_id = Ward.id')
                    ),
                    array(
                        'table' => 'categoriesproducts',
                        'alias' => 'CategoryProduct',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('CategoryProduct.id = Product.categoryproduct_id')
                    ),
                    array(
                        'table' => 'groupsproducts',
                        'alias' => 'Group',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Group.id = CategoryProduct.groupproduct_id')
                    ),
                    array(
                        'table' => 'members',
                        'alias' => 'Member',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Product.member_id = Member.id')
                    ),
                    array(
                        'table' => 'districts',
                        'alias' => 'District',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('District.id = Ward.district_id')
                    ),
                    array(
                        'table' => 'provinces',
                        'alias' => 'Province',
                        'type' => 'INNER',
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
                    //Dieu kien mac dinh
                    'Product.status = 1',
                    'Product.paid = 1',
                    'Product.deleted = 0',
                    'Product.expiry >= "' . $cur_date . '"',
                    //Dieu kien ban hoac cho thue
                    $condition_buy,
                    //Group
                    $condition_group,
                    //Category
                    $condition_category,
                    //Dieu kien tim kiem
                    $condition_price_min,
                    $condition_price_max,
                    $condition_acreage_min,
                    $condition_acreage_max,
                    $condition_province,
                    $condition_district,
                    $condition_ward,
                    $condition_direction,
                    $condition_floornumber,
                    $condition_roomnumber,
                    $condition_key,
                ),
                'group' => array('Ward.id', 'Ward.wardname', 'Ward.wardtype', 'Ward.wardlink'),
                'order' => array('sum' => 'DESC')
            ));
            if($wards)
            {
                $this->set(
                    array(
                        'wards' => $wards,
                    )
                );
            }
            //Set option for ward and district
            $this->Product->Ward->recursive = -1;
            $ward_temp = $this->Product->Ward->find('first', array(
                'joins' => array(
                    array(
                        'table' => 'districts',
                        'alias' => 'District',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Ward.district_id = District.id'
                    )
                ),
                'fields' => array('District.province_id', 'District.id'),
                'conditions' => array('Ward.id' => $ward_id_search)
            ));
            $this->Product->Ward->recursive = -1;
            $ward_option = $this->Product->Ward->find('all', array(
                'conditions' => array('Ward.district_id' => $ward_temp['District']['id']),
                'order' => array('Ward.wardname' => 'ASC'),
                'fields' => array('Ward.wardlink', 'Ward.wardname')
            ));
            foreach ($ward_option as $item)
            {
                $wards_option[$item['Ward']['wardlink']] = $item['Ward']['wardname'];
            }
            $this->Product->Ward->District->recursive = -1;
            $district_option = $this->Product->Ward->District->find('all', array(
                'conditions' => array('District.province_id' => $ward_temp['District']['province_id']),
                'order' => array('District.districtname' => 'ASC'),
                'fields' => array('District.districtlink', 'District.districtname')
            ));
            foreach ($district_option as $item)
            {
                $districts_option[$item['District']['districtlink']] = $item['District']['districtname'];
            }
        }
        else if($district_id_search != '')
        {
            $this->Product->recursive = -1;
            $districts = $this->Product->find('all', array(
                'fields' => array('Ward.id', 'Ward.wardname', 'Ward.wardtype', 'Ward.wardlink', 'COUNT(`Ward`.`id`) AS `sum`'),
                'joins' => array(
                    array(
                        'table' => 'transactiontypes',
                        'alias' => 'Transactiontype',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Product.transactiontype_id = Transactiontype.id'
                    ),
                    array(
                        'table' => 'wards',
                        'alias' => 'Ward',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Product.ward_id = Ward.id')
                    ),
                    array(
                        'table' => 'categoriesproducts',
                        'alias' => 'CategoryProduct',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('CategoryProduct.id = Product.categoryproduct_id')
                    ),
                    array(
                        'table' => 'groupsproducts',
                        'alias' => 'Group',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Group.id = CategoryProduct.groupproduct_id')
                    ),
                    array(
                        'table' => 'members',
                        'alias' => 'Member',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Product.member_id = Member.id')
                    ),
                    array(
                        'table' => 'districts',
                        'alias' => 'District',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('District.id = Ward.district_id')
                    ),
                    array(
                        'table' => 'provinces',
                        'alias' => 'Province',
                        'type' => 'INNER',
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
                    //Dieu kien mac dinh
                    'Product.status = 1',
                    'Product.paid = 1',
                    'Product.deleted = 0',
                    'Product.expiry >= "' . $cur_date . '"',
                    //Dieu kien ban hoac cho thue
                    $condition_buy,
                    //Group
                    $condition_group,
                    //Category
                    $condition_category,
                    //Dieu kien tim kiem
                    $condition_price_min,
                    $condition_price_max,
                    $condition_acreage_min,
                    $condition_acreage_max,
                    $condition_province,
                    $condition_district,
//                    $condition_ward,
                    $condition_direction,
                    $condition_floornumber,
                    $condition_roomnumber,
                    $condition_key,
                ),
                'group' => array('Ward.id', 'Ward.wardname', 'Ward.wardtype', 'Ward.wardlink'),
                'order' => array('sum' => 'DESC')
            ));
            if($districts)
            {
                $this->set(
                    array(
                        'districts' => $districts,
                    )
                );
            }
            //Set option for district and ward
            $this->Product->Ward->recursive = -1;
            $ward_option = $this->Product->Ward->find('all', array(
                'conditions' => array('Ward.district_id' => $district_id_search),
                'order' => array('Ward.wardname' => 'ASC'),
                'fields' => array('Ward.wardlink', 'Ward.wardname')
            ));
            foreach ($ward_option as $item)
            {
                $wards_option[$item['Ward']['wardlink']] = $item['Ward']['wardname'];
            }
            $this->Product->Ward->District->recursive = -1;
            $district_temp = $this->Product->Ward->District->findById($district_id_search);
            $this->Product->Ward->District->recursive = -1;
            $district_option = $this->Product->Ward->District->find('all', array(
                'conditions' => array('District.province_id' => $district_temp['District']['province_id']),
                'order' => array('District.districtname' => 'ASC'),
                'fields' => array('District.districtlink', 'District.districtname')
            ));
            foreach ($district_option as $item)
            {
                $districts_option[$item['District']['districtlink']] = $item['District']['districtname'];
            }
            //
        }
        else if($province_id_search != '')
        {
            $this->Product->recursive = -1;
            $provinces = $this->Product->find('all', array(
                'fields' => array('District.id', 'District.districtname', 'District.districttype',  'District.districtlink', 'COUNT(`District`.`id`) AS `sum`'),
                'joins' => array(
                    array(
                        'table' => 'transactiontypes',
                        'alias' => 'Transactiontype',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Product.transactiontype_id = Transactiontype.id'
                    ),
                    array(
                        'table' => 'wards',
                        'alias' => 'Ward',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Product.ward_id = Ward.id')
                    ),
                    array(
                        'table' => 'categoriesproducts',
                        'alias' => 'CategoryProduct',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('CategoryProduct.id = Product.categoryproduct_id')
                    ),
                    array(
                        'table' => 'groupsproducts',
                        'alias' => 'Group',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Group.id = CategoryProduct.groupproduct_id')
                    ),
                    array(
                        'table' => 'members',
                        'alias' => 'Member',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Product.member_id = Member.id')
                    ),
                    array(
                        'table' => 'districts',
                        'alias' => 'District',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('District.id = Ward.district_id')
                    ),
                    array(
                        'table' => 'provinces',
                        'alias' => 'Province',
                        'type' => 'INNER',
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
                    //Dieu kien mac dinh
                    'Product.status = 1',
                    'Product.paid = 1',
                    'Product.deleted = 0',
                    'Product.expiry >= "' . $cur_date . '"',
                    //Dieu kien ban hoac cho thue
                    $condition_buy,
                    //Group
                    $condition_group,
                    //Category
                    $condition_category,
                    //Dieu kien tim kiem
                    $condition_price_min,
                    $condition_price_max,
                    $condition_acreage_min,
                    $condition_acreage_max,
                    $condition_province,
//                    $condition_district,
//                    $condition_ward,
                    $condition_direction,
                    $condition_floornumber,
                    $condition_roomnumber,
                    $condition_key,
                ),
                'group' => array('District.id', 'District.districtname', 'District.districttype', 'District.districtlink'),
                'order' => array('sum' => 'DESC')
            ));
            if($provinces)
            {
                $this->set(
                    array(
                        'provinces' => $provinces,
                    )
                );
            }
            //Set option for district
            $this->Product->Ward->District->recursive = -1;
            $district_option = $this->Product->Ward->District->find('all', array(
                'conditions' => array('District.province_id' => $province_id_search),
                'order' => array('District.districtname' => 'ASC'),
                'fields' => array('District.districtlink', 'District.districtname')
            ));
            foreach ($district_option as $item)
            {
                $districts_option[$item['District']['districtlink']] = $item['District']['districtname'];
            }
            //
        }
        else
        {
            $this->Product->recursive = -1;
            $provinces_all = $this->Product->find('all', array(
                'fields' => array('Province.id', 'Province.provincename', 'Province.provincelink', 'COUNT(`Province`.`id`) AS `sum`'),
                'joins' => array(
                    array(
                        'table' => 'transactiontypes',
                        'alias' => 'Transactiontype',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Product.transactiontype_id = Transactiontype.id'
                    ),
                    array(
                        'table' => 'wards',
                        'alias' => 'Ward',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Product.ward_id = Ward.id')
                    ),
                    array(
                        'table' => 'categoriesproducts',
                        'alias' => 'CategoryProduct',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('CategoryProduct.id = Product.categoryproduct_id')
                    ),
                    array(
                        'table' => 'groupsproducts',
                        'alias' => 'Group',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Group.id = CategoryProduct.groupproduct_id')
                    ),
                    array(
                        'table' => 'members',
                        'alias' => 'Member',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Product.member_id = Member.id')
                    ),
                    array(
                        'table' => 'districts',
                        'alias' => 'District',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('District.id = Ward.district_id')
                    ),
                    array(
                        'table' => 'provinces',
                        'alias' => 'Province',
                        'type' => 'INNER',
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
                    //Dieu kien mac dinh
                    'Product.status = 1',
                    'Product.paid = 1',
                    'Product.deleted = 0',
                    'Product.expiry >= "' . $cur_date . '"',
                    //Dieu kien ban hoac cho thue
                    $condition_buy,
                    //Group
                    $condition_group,
                    //Category
                    $condition_category,
                    //Dieu kien tim kiem
                    $condition_price_min,
                    $condition_price_max,
                    $condition_acreage_min,
                    $condition_acreage_max,
//                    $condition_province,
//                    $condition_district,
//                    $condition_ward,
                    $condition_direction,
                    $condition_floornumber,
                    $condition_roomnumber,
                    $condition_key,
                ),
                'group' => array('Province.id', 'Province.provincename', 'Province.provincelink'),
                'order' => array('sum' => 'DESC')
            ));
            if($provinces_all)
            {
                $this->set(array('provinces_all' => $provinces_all));
            }
        }
        //Breakcrumb for location
        //Ward Breakcrumb
        $this->Product->Ward->recursive = -1;
        $breadcrumb_ward = $this->Product->Ward->find('first', array(
            'fields' => array('*'),
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
            'conditions' => array(
                'Ward.id' => $ward_id_search
            )
        ));
        if($breadcrumb_ward)
        {
            $this->set(
                array(
                    'breadcrumb_ward' => $breadcrumb_ward
                )
            );
            $title = $title . ' tại ' . $breadcrumb_ward['Ward']['wardtype'] . ' ' . $breadcrumb_ward['Ward']['wardname'] .  ' ' .  $breadcrumb_ward['District']['districttype'] . ' ' . $breadcrumb_ward['District']['districtname'] . ' ' . $breadcrumb_ward['Province']['provincename'];
            $title_location = ' tại ' . $breadcrumb_ward['Ward']['wardtype'] . ' ' . $breadcrumb_ward['Ward']['wardname'] .  ' ' .  $breadcrumb_ward['District']['districttype'] . ' ' . $breadcrumb_ward['District']['districtname'] . ' ' . $breadcrumb_ward['Province']['provincename'];
        }
        //District Breakcrumb
        $this->Product->Ward->District->recursive = -1;
        $breadcrumb_district = $this->Product->Ward->District->find('first', array(
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'District.province_id = Province.id'
                )
            ),
            'conditions' => array(
                'District.id' => $district_id_search
            )
        ));
        if($breadcrumb_district)
        {
            $this->set(
                array(
                    'breadcrumb_district' => $breadcrumb_district
                )
            );
            $title = $title . ' tại ' . $breadcrumb_district['District']['districttype'] . ' ' . $breadcrumb_district['District']['districtname'] . ' ' . $breadcrumb_district['Province']['provincename'];
            $title_location = ' tại ' . $breadcrumb_district['District']['districttype'] . ' ' . $breadcrumb_district['District']['districtname'] . ' ' . $breadcrumb_district['Province']['provincename'];
        }
        //Province Breakcrumb
        $this->Product->Ward->District->Province->recursive = -1;
        $breadcrumb_province = $this->Product->Ward->District->Province->find('first', array(
            'conditions' => array(
                'Province.id' => $province_id_search
            )
        ));
        if($breadcrumb_province)
        {
            $this->set(
                array(
                    'breadcrumb_province' => $breadcrumb_province
                )
            );
            $title = $title . ' tại ' . $breadcrumb_province['Province']['provincename'];
            $title_location = ' tại ' . $breadcrumb_province['Province']['provincename'];
        }
        //
        $product = null;
        $this->Product->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => '20',
            'fields' => array(
                'Product.id',
                'Product.title',
                'Product.productlink',
                'Product.price',
                'Product.price2',
                'Product.opt_price',
                'Product.acreage',
                'Product.acreage2',
                'Product.image',
                'Product.date_paid',
                'Product.summary',
                'Product.description',
                'Product.fullname',
                'Product.phonenumber',
                'Product.email',
                'Product.red_title',
                'Product.address',
                'Province.provincename',
                'District.districtname',
                'District.districttype',
                'Ward.wardname',
                'Ward.wardtype',
                'Packet.id',
                'Packet.sort',
                'Member.image'
            ),
            'joins' => array(
                array(
                    'table' => 'transactiontypes',
                    'alias' => 'Transactiontype',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.transactiontype_id = Transactiontype.id'
                ),
                array(
                    'table' => 'wards',
                    'alias' => 'Ward',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.ward_id = Ward.id')
                ),
                array(
                    'table' => 'categoriesproducts',
                    'alias' => 'CategoryProduct',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('CategoryProduct.id = Product.categoryproduct_id')
                ),
                array(
                    'table' => 'groupsproducts',
                    'alias' => 'Group',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Group.id = CategoryProduct.groupproduct_id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Ward.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
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
                //Dieu kien mac dinh
                'Product.status = 1',
                'Product.paid = 1',
                'Product.deleted = 0',
                // 'Product.expiry >= "' . $cur_date . '"',
                //Dieu kien ban hoac cho thue
                $condition_buy,
                //Group
                $condition_group,
                //Category
                $condition_category,
                //Dieu kien tim kiem
                $condition_price_min,
                $condition_price_max,
                $condition_price_deal,
                $condition_acreage_min,
                $condition_acreage_max,
                $condition_province,
                $condition_district,
                $condition_ward,
                $condition_direction,
                $condition_floornumber,
                $condition_roomnumber,
                $condition_key,
            ),
            'order' => $p_order
        );
        try
        {
            $product = $this->paginate('Product');
        }
        catch (NotFoundException $e)
        {

        }
        $this->set(array(
            'products' => $product,
        ));

        //Direction
        $this->Product->Direction->recursive = -1;
        $direction = $this->Product->Direction->find('all');
        foreach ($direction as $item)
        {
            $directions[$item['Direction']['id']] = $item['Direction']['directionname'];
        }
        //Title theo breakcrumb
        //Set breadcrumb
        $this->Product->Category->Group->recursive = -1;
        $breadcrumb_group = $this->Product->Category->Group->findById($group_id_search);
        if($breadcrumb_group)
        {
            $this->set(array('breadcrumb_group' => $breadcrumb_group));
            $title = $title_type . $breadcrumb_group['Group']['groupname'] . $title_location;
        }
        //Set breadcrumb
        $this->Product->Category->recursive = -1;
        $breadcrumb_category = $this->Product->Category->find('first', array(
            'joins' => array(
                array(
                    'table' => 'groupsproducts',
                    'alias' => 'Group',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.groupproduct_id = Group.id')
                )
            ),
            'fields' => array('*'),
            'conditions' => array('Category.id' => $category_id_search)
        ));
        if($breadcrumb_category)
        {
            $this->set(array('breadcrumb_category' => $breadcrumb_category));
            $title = $title_type . $breadcrumb_category['Category']['categoryname'] . $title_location;
        }
        $this->set(array(
            'title' => $title,
            'directions' => $directions,
            'allow_share' => true,
            'wards_option' => $wards_option,
            'districts_option' => $districts_option
        ));
        //
    }

    //maps
    public function index_maps()
    {
        $url = $this->params['url'];
        //Dieu kien tim kiem
        $type = isset($url['type'])? $url['type']: '';
        $condition_type = $type != ''? 'Transactiontype.id = ' . $type: '';
        $price = isset($url['price'])? $url['price']: '';
        $arr_price = explode('_', $price);
        $price_min = isset($arr_price[0])? $arr_price[0]: 0;
        $price_max = isset($arr_price[1])? $arr_price[1]: 0;
        $condition_price_min = ($price_min > 0)? 'Product.price >= ' . $price_min: '';
        $condition_price_max = ($price_max > 0)? 'Product.price <= ' . $price_max: '';
        $condition_price_deal = '';
        if($price_min == -1 && $price_max == -1)
        {
            $condition_price_deal = 'Product.price = 0';
        }
        //Dien tich
        $acreage = isset($url['acreage'])? $url['acreage']: '';
        $arr_acreage = explode('_', $acreage);
        $acreage_min = isset($arr_acreage[0])? $arr_acreage[0]: 0;
        $acreage_max = isset($arr_acreage[1])? $arr_acreage[1]: 0;
        $condition_acreage_min = ($acreage_min > 0)? 'Product.acreage >= ' . $acreage_min: '';
        $condition_acreage_max = ($acreage_max > 0)? 'Product.acreage <= ' . $acreage_max: '';
        //Direction
        $direction_search_id = isset($url['direction'])? $url['direction']: 0;
        $condition_direction = ($direction_search_id > 0)? 'Direction.id = ' . $direction_search_id: '';
        //Floor
        $floor_search = isset($url['floor_number'])? $url['floor_number']: 0;
        $condition_floornumber = ($floor_search > 0)? 'Product.floornumber >= ' . $floor_search: '';
        //Room
        $room_search = isset($url['room_number'])? $url['room_number']: 0;
        $condition_roomnumber = ($room_search > 0)? 'Product.roomnumber >= ' . $room_search: '';
        //Province
        $province_search_id = isset($url['province'])? $url['province']: 0;
        $condition_province = ($province_search_id > 0)? 'Province.id = ' . $province_search_id: '' ;

        //Set district for province
        $districts = null;
        $this->Product->Ward->District->recursive = -1;
        $district = $this->Product->Ward->District->find('all', array(
            'order' => array('districtname' => 'asc'),
            'conditions' => array('province_id' => $province_search_id)
        ));
        foreach ($district as $item)
        {
            $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
        }
        //Quan huyen
        $district_search_id = isset($url['district'])? $url['district']: 0;
        $condition_district = ($district_search_id > 0)? 'District.id = ' . $district_search_id: '';
        //Set ward for district
        $wards = null;
        $this->Product->Ward->recursive = -1;
        $ward = $this->Product->Ward->find('all', array(
            'order' => array('wardname' => 'asc'),
            'conditions' => array('district_id' => $district_search_id)
        ));
        foreach ($ward as $item)
        {
            $wards[$item['Ward']['id']] = $item['Ward']['wardtype'] . ' ' . $item['Ward']['wardname'];
        }
        //Xa phuong
        $ward_search_id = isset($url['ward'])? $url['ward']: 0;
        $condition_ward = ($ward_search_id > 0)? 'Ward.id = ' . $ward_search_id: '';
        //Group
        $group_search = isset($url['group'])? $url['group']: 0;
        $condition_group = ($group_search > 0)? 'Group.id = ' . $group_search: '';
        //category
        $category_search = isset($url['category'])? $url['category']: '';
        $condition_category = ($category_search != '')? 'CategoryProduct.id = ' . $category_search: '';
        //Key
        $categories = null;
        ClassRegistry::init('Category')->recursive = -1;
        $category = ClassRegistry::init('Category')->find('all', array(
            'conditions' => array('groupproduct_id' => $group_search)
        ));
        foreach ($category as $item)
        {
            $categories[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //End dieu kien tim kiem

        //Ngay het han
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        ///
        $product = null;
        $this->Product->recursive = -1;
        $product = $this->Product->find('all', array(
            'paramType' => 'querystring',
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'transactiontypes',
                    'alias' => 'Transactiontype',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.transactiontype_id = Transactiontype.id'
                ),
                array(
                    'table' => 'wards',
                    'alias' => 'Ward',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.ward_id = Ward.id')
                ),
                array(
                    'table' => 'categoriesproducts',
                    'alias' => 'CategoryProduct',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('CategoryProduct.id = Product.categoryproduct_id')
                ),
                array(
                    'table' => 'groupsproducts',
                    'alias' => 'Group',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Group.id = CategoryProduct.groupproduct_id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Ward.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
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
                //Dieu kien mac dinh
                'Product.status = 1',
                'Product.paid = 1',
                'Product.deleted = 0',
                // 'Product.expiry >= "' . $cur_date . '"',
                'Product.latitude > 0',
                'Product.longitude > 0',
                //Dieu kien tim kiem
                $condition_type,
                $condition_group,
                $condition_category,
                $condition_price_min,
                $condition_price_max,
                $condition_price_deal,
                $condition_acreage_min,
                $condition_acreage_max,
                $condition_province,
                $condition_district,
                $condition_direction,
                $condition_floornumber,
                $condition_roomnumber,
                $condition_ward,
            ),
            'order' => array('Packet.sort' => 'asc', 'Product.date_paid' => 'desc'),
            'limit' => 100
        ));

        //Tim kiem
        //Province
        $provinces = null;
        $this->Product->Ward->District->Province->recursive = -1;
        $province = $this->Product->Ward->District->Province->find('all', array(
            'fields' => array('Province.id', 'Province.provincename'),
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item){
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //type
        $types = null;
        ClassRegistry::init('Transactiontype')->recursive = -1;
        $type = ClassRegistry::init('Transactiontype')->find('all');
        foreach ($type as $item)
        {
            $types[$item['Transactiontype']['id']] = $item['Transactiontype']['nametype'];
        }
        //Direction
        $directions = null;
        $this->Product->Direction->recursive = -1;
        $direction = $this->Product->Direction->find('all');
        foreach ($direction as $item)
        {
            $directions[$item['Direction']['id']] = $item['Direction']['directionname'];
        }
        //Group
        $groups = null;
        ClassRegistry::init('Group')->recursive = -1;
        $group = ClassRegistry::init('Group')->find('all');
        foreach ($group as $item)
        {
            $groups[$item['Group']['id']] = $item['Group']['groupname'];
        }
        //Set cennter for maps
        $lat = 10.0274;
        $lng = 105.7741;
        if($province_search_id > 0)
        {
            $this->Product->Ward->District->Province->recursive = -1;
            $location_province = $this->Product->Ward->District->Province->findById($province_search_id);
            if($location_province)
            {
                if($location_province['Province']['latitude'] > 0 && $location_province['Province']['longitude'] > 0)
                {
                    $lat = $location_province['Province']['latitude'];
                    $lng = $location_province['Province']['longitude'];
                }
            }
        }
        if($district_search_id > 0)
        {
            $this->Product->Ward->District->recursive = -1;
            $location_district = $this->Product->Ward->District->findById($district_search_id);
            if($location_district)
            {
                $lat = $location_district['District']['longitude'];
                $lng = $location_district['District']['latitude'];
            }
        }
        if($ward_search_id > 0)
        {
            $this->Product->Ward->recursive = -1;
            $location_ward = $this->Product->Ward->findById($ward_search_id);
            if($location_ward)
            {
                $lat = $location_ward['Ward']['latitude'];
                $lng = $location_ward['Ward']['longitude'];
            }
        }
        $this->set(array(
            'title' => 'Tìm nhà đất bán - cho thuê theo bản đồ',
            'products' => $product,
            'option_groups' => $groups,
            'option_categories' => $categories,
            'option_types' => $types,
            'option_provinces' => $provinces,
            'option_districts' => $districts,
            'option_wards' => $wards,
            'directions' => $directions,
            'lat' => $lat,
            'lng' => $lng
        ));
    }
    //

    public function add_can_mua_can_thue()
    {
        //Check session
        if(!$this->Session->check('Member'))
        {
            $this->Session->setFlash('Vui lòng đăng nhập trước khi đăng thông tin bất động sản', 'flashWarning');
            $this->redirect('/members/login');
        }
        //
        $directions = null;
        $transction_types = null;
        $groups = null;
        $provinces = null;
        $projects = null;
        //Group product
        $this->Product->Category->Group->recursive = -1;
        $group = $this->Product->Category->Group->find('all', array(
            'order' => array('Group.sort' => 'ASC')
        ));
        foreach ($group as $item)
        {
            $groups[$item['Group']['id']] = $item['Group']['groupname'];
        }
        //Province
        $this->Product->Ward->District->Province->recursive = -1;
        $province = $this->Product->Ward->District->Province->find('all', array(
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //Direction
        $this->Product->Direction->recursive = -1;
        $direction = $this->Product->Direction->find('all');
        foreach ($direction as $item)
        {
            $directions[$item['Direction']['id']] = $item['Direction']['directionname'];
        }
        //Project
        $this->Product->Project->recursive = -1;
        $project = $this->Product->Project->find('all');
        foreach ($project as $item)
        {
            $projects[$item['Project']['id']] = $item['Project']['title'];
        }
        //
        $member_id = $this->Session->read('Member.id');
        $this->Product->Member->recursive = -1;
        $member = $this->Product->Member->findById($member_id);
        //Set data category neu co chon group
        $categogies = null;
        if(isset($this->request->data['Product']['groupproduct']) && $this->request->data['Product']['groupproduct'] != '')
        {
            $groupproduct_id = $this->request->data['Product']['groupproduct'];
            $this->Product->Category->recursive = -1;
            $category = $this->Product->Category->find('all', array(
                'conditions' => array('Category.groupproduct_id = ' . $groupproduct_id)
            ));
            foreach ($category as $item)
            {
                $categogies[$item['Category']['id']] = $item['Category']['categoryname'];
            }
        }
        //Set data district neu co chon province
        $districts = null;
        if(isset($this->request->data['Product']['province']) && $this->request->data['Product']['province'] != '')
        {
            $province_id = $this->request->data['Product']['province'];
            $this->Product->Ward->District->recursive = -1;
            $district = $this->Product->Ward->District->find('all', array(
                'conditions' => array('District.province_id = ' . $province_id)
            ));
            foreach ($district as $item)
            {
                $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
            }
        }
        //Set data ward neu co chon district
        $wards = null;
        if(isset($this->request->data['Product']['district']) && $this->request->data['Product']['district'] != '')
        {
            $district_id = $this->request->data['Product']['district'];
            $this->Product->Ward->recursive = -1;
            $ward = $this->Product->Ward->find('all', array(
                'conditions' => array('Ward.district_id = ' . $district_id)
            ));
            foreach ($ward as $item)
            {
                $wards[$item['Ward']['id']] = $item['Ward']['wardtype'] . ' ' . $item['Ward']['wardname'];
            }
        }
        //
        $this->set(array(
            'groups' => $groups,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
            'directions' => $directions,
            'projects' => $projects,
            'member' => $member,
            'categories' => $categogies,
            'title' => 'Đăng tin cần mua - cần thuê'
        ));
        ////////////////////////////////////////
        ////////////////////////////////////////
        ////////////////////////////////////////
        //Post
        ///
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Product->set($this->request->data);
            if($this->Product->validates())
            {
                $this->Product->set('member_id', $member_id);
                //Tạo slug
                $product_link = $this->Library->make_link($this->request->data['Product']['title']);
                $this->Product->set('productlink', $product_link);
                ///Kiem tra gia
                //Nêu thỏa thuận => price = 0;
                if(isset($this->request->data['Product']['pricedeal']) && $this->request->data['Product']['pricedeal'] == 1)
                {
                    $this->Product->set('price', 0);
                }
                //Neu min max thì luu vao 2 column
                elseif (isset($this->request->data['Product']['priceminmax']) && $this->request->data['Product']['priceminmax'] == 1)
                {
                    $this->Product->set('price', $this->request->data['Product']['price_min']);
                    $this->Product->set('price2', $this->request->data['Product']['price_max']);
                }
                //còn lại lưu giá vào giá bình thuòng
                else
                {
                    $this->Product->set('price', $this->request->data['Product']['price']);
                }
                //Kiểm tra dien tích
                //Neu min max thi luu vao 2 cot
                if(isset($this->request->data['Product']['acreage_minmax']) && $this->request->data['Product']['acreage_minmax'] == 1)
                {
                    $this->Product->set('acreage', $this->request->data['Product']['acreage_min']);
                    $this->Product->set('acreage2', $this->request->data['Product']['acreage_max']);
                }
                //nguoc lai luu vao 1 cột
                else
                {
                    $this->Product->set('acreage', $this->request->data['Product']['acreage']);
                }
                //Upload image
                //Luu product
                if($this->Product->save($this->request->data))
                {
                    $image = $this->request->data['imagelink'][0];
                    if($image['name'] != '' && $image['error'] == 0 && $image['size'] < 2000000)
                    {
                        $date = getdate();
                        $year = $date['year'];
                        $month = $date['mon'];
                        App::import('Vendor', 'resize');
                        $thumb = new SimpleImage();
                        $path = $this->Library->create_folder($year, $month, $this->path_product);
                        $path_thum = $this->Library->create_folder($year, $month, $this->path_product_thumb);
                        $time = new DateTime();
                        $timestamp = $time->getTimestamp();
                        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                        $filename = $product_link.'-'.$timestamp.'.'.$ext;
                        if(move_uploaded_file($image['tmp_name'], $path.DS.$filename))
                        {
                            try
                            {
                                $this->Library->img_resize($path.DS.$filename, $path.DS.$filename, 630, 450, 100, $this->path_product.DS.'watermark.png');
                                $thumb->load($path.DS.$filename);
                                $thumb->scale(50);
                                $thumb->save($path_thum.DS.$filename);
                                $data_image_product = array(
                                    'id' => $this->Product->id,
                                    'image' => $year.'/'.$month.'/'.$filename
                                );
                                $this->Product->save($data_image_product);
                                //
                                $this->Product->Image->create();
                                $this->Product->Image->set('product_id', $this->Product->id);
                                $this->Product->Image->set('imagelink', $filename);
                                $this->Product->Image->set('imagedir', $year.'/'.$month);
                                $this->Product->Image->set('imagetitle', $this->request->data['Product']['title']);
                                $this->Product->Image->save();
//                            $i = $i + 1;
                            }
                            catch (Exception $exception)
                            {

                            }
                        }
                    }
                    //Redirect
                    $this->redirect('/packets/paid/?pid=' . $this->Product->id);
                }
            }
            else
            {
                $this->Session->setFlash('Vui lòng hoàn thành các trường bắt buột', 'flashWarning');
            }
        }
    }
    public function edit_can_mua_can_thue()
    {
        //Check session
        if(!$this->Session->check('Member'))
        {
            $this->Session->setFlash('Vui lòng đăng nhập trước khi đăng thông tin bất động sản', 'flashWarning');
            $this->redirect('/members/login');
        }
        //
        $pid = 0;
        if(isset($this->params['url']['pid']))
        {
            $pid = $this->params['url']['pid'];
        }
        //Get product
        $this->Product->recursive = -1;
        $product = $this->Product->find('first', array(
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'transactiontypes',
                    'alias' => 'Transactiontype',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Transactiontype.id = Product.transactiontype_id'
                ),
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
                    'type' => 'LEFT',
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
                'Transactiontype.vend = 0',
                'Product.status = 0',
                'Product.paid = 0',
                'Product.deleted = 0',
                'Product.id = ' . $pid
            ),
        ));
        if(!$product)
        {
            $this->redirect('/members/mypost');
        }
        //
        $transction_types = null;
        $groups = null;
        $provinces = null;
        $projects = null;
        //Group product
        $this->Product->Category->Group->recursive = -1;
        $group = $this->Product->Category->Group->find('all', array(
            'order' => array('Group.sort' => 'ASC')
        ));
        foreach ($group as $item)
        {
            $groups[$item['Group']['id']] = $item['Group']['groupname'];
        }
        //Province
        $this->Product->Ward->District->Province->recursive = -1;
        $province = $this->Product->Ward->District->Province->find('all', array(
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //Project
        $this->Product->Project->recursive = -1;
        $project = $this->Product->Project->find('all');
        foreach ($project as $item)
        {
            $projects[$item['Project']['id']] = $item['Project']['title'];
        }
        //
        $member_id = $this->Session->read('Member.id');
        $this->Product->Member->recursive = -1;
        $member = $this->Product->Member->findById($member_id);
        //Set data category neu co chon group
        $categogies = null;
        $groupproduct_id = $product['Group']['id'];
        $this->Product->Category->recursive = -1;
        $category = $this->Product->Category->find('all', array(
            'conditions' => array('Category.groupproduct_id = ' . $groupproduct_id)
        ));
        foreach ($category as $item)
        {
            $categogies[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //Set data district neu co chon province
        $districts = null;
        $province_id = $product['Province']['id'];
        $this->Product->Ward->District->recursive = -1;
        $district = $this->Product->Ward->District->find('all', array(
            'conditions' => array('District.province_id = ' . $province_id)
        ));
        foreach ($district as $item)
        {
            $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
        }
        //Set data ward neu co chon district
        $wards = null;
        $district_id = $product['District']['id'];
        $this->Product->Ward->recursive = -1;
        $ward = $this->Product->Ward->find('all', array(
            'conditions' => array('Ward.district_id = ' . $district_id)
        ));
        foreach ($ward as $item)
        {
            $wards[$item['Ward']['id']] = $item['Ward']['wardtype'] . ' ' . $item['Ward']['wardname'];
        }
        //
        $this->set(array(
            'products' => $product,
            'groups' => $groups,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
            'projects' => $projects,
            'member' => $member,
            'categories' => $categogies,
            'title' => 'Sửa tin cần mua - cần thuê'
        ));
        ////////////////////////////////////////
        ////////////////////////////////////////
        ////////////////////////////////////////
        //Post
        ///
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Product->set($this->request->data);
            if($this->Product->validates())
            {
                $this->Product->set('member_id', $member_id);
                //Tạo slug
                $product_link = $this->Library->make_link($this->request->data['Product']['title']);
                $this->Product->set('productlink', $product_link);
                ///Kiem tra gia
                //Nêu thỏa thuận => price = 0;
                if(isset($this->request->data['Product']['pricedeal']) && $this->request->data['Product']['pricedeal'] == 1)
                {
                    $this->Product->set('price', 0);
                    $this->Product->set('price2', 0);
                }
                //Neu min max thì luu vao 2 column
                elseif (isset($this->request->data['Product']['priceminmax']) && $this->request->data['Product']['priceminmax'] == 1)
                {
                    $this->Product->set('price', $this->request->data['Product']['price_min']);
                    $this->Product->set('price2', $this->request->data['Product']['price_max']);
                }
                //còn lại lưu giá vào giá bình thuòng
                else
                {
                    $this->Product->set('price', $this->request->data['Product']['price']);
                    $this->Product->set('price2', 0);
                }
                //Kiểm tra dien tích
                //Neu min max thi luu vao 2 cot
                if(isset($this->request->data['Product']['acreage_minmax']) && $this->request->data['Product']['acreage_minmax'] == 1)
                {
                    $this->Product->set('acreage', $this->request->data['Product']['acreage_min']);
                    $this->Product->set('acreage2', $this->request->data['Product']['acreage_max']);
                }
                //nguoc lai luu vao 1 cột
                else
                {
                    $this->Product->set('acreage', $this->request->data['Product']['acreage']);
                    $this->Product->set('acreage2', 0);
                }
                //Upload image
                $image = $this->request->data['imagelink'][0];
                $image_old = isset($this->request->data['Product']['image_old'])? $this->request->data['Product']['image_old']: '';
                if($image['name'] != '' && $image['error'] == 0 && $image['size'] < 2000000)
                {
                    $date = getdate();
                    $year = $date['year'];
                    $month = $date['mon'];
                    App::import('Vendor', 'resize');
                    $thumb = new SimpleImage();
                    $path = $this->Library->create_folder($year, $month, $this->path_product);
                    $path_thum = $this->Library->create_folder($year, $month, $this->path_product_thumb);
                    $time = new DateTime();
                    $timestamp = $time->getTimestamp();
                    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                    $filename = $product_link.'-'.$timestamp.'.'.$ext;
                    if(move_uploaded_file($image['tmp_name'], $path.DS.$filename))
                    {
                        //Thumb
                        $thumb->load($path.DS.$filename);
                        $thumb->scale(50);
                        $thumb->save($path_thum.DS.$filename);
                        $this->Product->set('image', $year.'/'.$month.'/'.$filename);
                        if($image_old != '' && file_exists($this->path_product . '/' . $image_old))
                        {
                            unlink($this->path_product . '/' . $image_old);
                        }
                        if($image_old != '' && file_exists($this->path_product_thumb . '/' . $image_old))
                        {
                            unlink($this->path_product_thumb . '/' . $image_old);
                        }
                    }
                }
//                Luu product
                if($this->Product->save($this->request->data))
                {
                    //Redirect
                    $this->redirect('/packets/paid/?pid=' . $this->Product->id);
                }
            }
            else
            {
                $this->Session->setFlash('Vui lòng hoàn thành các trường bắt buột', 'flashWarning');
            }
        }
    }
    public function view($title = null, $id = null)
    {
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        $this->Product->recursive = -1;
        //Product primary
        $product = $this->Product->find('first', array(
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'transactiontypes',
                    'alias' => 'Transactiontype',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.transactiontype_id = Transactiontype.id'
                ),
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
                // 'Product.expiry >= "' . $cur_date . '"',
                'Product.productlink = "' . $title . '"',
                'Product.id = ' . $id
            ),
        ));
        //Lấy hình ảnh
        $this->Product->Image->recursive = -1;
        $images = $this->Product->Image->find('all', array(
            'conditions' => array('product_id = ' . $id)
        ));
        //Lấy utility
        $this->Product->Utility->recursive = -1;
        $utility = $this->Product->Utility->find('first', array(
            'conditions' => array('Utility.product_id = ' . $id)
        ));
        //Lấy environment
        $this->Product->Environment->recursive = -1;
        $environment = $this->Product->Environment->find('first', array(
            'conditions' => array('Environment.product_id = ' . $id)
        ));
        if($product)
        {
            //Upadate view
            $this->Product->id = $id;
            $this->Product->saveField('view', (int)$this->Product->field('view') + 1);
            //
            //Lấy product liên quan
            $category_id = $product['Category']['id'];
            $ward_id = $product['Ward']['id'];
            $transctiontype_id = $product['Transactiontype']['id'];
            $this->Product->recursive = -1;
            $product_relative = $this->Product->find('all', array(
                'limit' => '10',
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
                    'Product.ward_id = ' . $ward_id,
                    'Product.categoryproduct_id = ' . $category_id,
                    'Product.transactiontype_id' => $transctiontype_id,
                    'Product.id != ' . $id),
                'order' => array('Packet.sort' => 'asc', 'Product.date_paid' => 'desc')
            ));
            //
            //Keywords
            $keywords = array(
                mb_strtolower('nhà đất ' . $product['Transactiontype']['nametype']),
                mb_strtolower($product['Group']['groupname']),
                mb_strtolower($product['Category']['categoryname']),
                mb_strtolower($product['Province']['provincename']),
                mb_strtolower($product['District']['districttype'] . ' ' . $product['District']['districtname']),
                mb_strtolower($product['Ward']['wardtype'] . ' ' . $product['Ward']['wardname']),
                mb_strtolower($product['Product']['title']),
            );
            $this->set(array(
                'head_description' => $product['Product']['summary'] != ''? $product['Product']['summary']: str_replace(PHP_EOL, ' ', substr($product['Product']['description'], 0, 200)),
                'product' => $product,
                'images' => $images,
                'title' => $product['Product']['title'],
                'og_image' => 'http://' . $_SERVER['HTTP_HOST'] . ($product['Product']['image'] != ''? '/uploads/products/' . $product['Product']['image']: '/img/og_logo_default.jpg'),
                'keywords' => implode(', ', $keywords),
                'environment' => $environment,
                'utility' => $utility,
                'product_relative' => $product_relative,
                'allow_share' => true
            ));
        }
        else
        {
            $this->set(array(
                'product' => null,
                'title' => 'Không tìm thấy trang',
            ));
        }
    }
    //
    public function add()
    {
        //Check session
        if(!$this->Session->check('Member'))
        {
            $this->Session->setFlash('Vui lòng đăng nhập trước khi đăng thông tin bất động sản', 'flashWarning');
            $this->redirect('/members/login?continue=http:///' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        }
        //
        $directions = null;
        $transction_types = null;
        $groups = null;
        $provinces = null;
        $projects = null;
        //Transaction type
        $this->Product->Transactiontype->recursive = -1;
        $tran_type = $this->Product->Transactiontype->find('all');
        foreach ($tran_type as $item)
        {
            $transction_types[$item['Transactiontype']['id']] = $item['Transactiontype']['nametype'];
        }
        //Group product
        $this->Product->Category->Group->recursive = -1;
        $group = $this->Product->Category->Group->find('all', array(
            'order' => array('Group.sort' => 'ASC')
        ));
        foreach ($group as $item)
        {
            $groups[$item['Group']['id']] = $item['Group']['groupname'];
        }
        //Province
        $this->Product->Ward->District->Province->recursive = -1;
        $province = $this->Product->Ward->District->Province->find('all', array(
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //Direction
        $this->Product->Direction->recursive = -1;
        $direction = $this->Product->Direction->find('all');
        foreach ($direction as $item)
        {
            $directions[$item['Direction']['id']] = $item['Direction']['directionname'];
        }
        //Project
        $this->Product->Project->recursive = -1;
        $project = $this->Product->Project->find('all');
        foreach ($project as $item)
        {
            $projects[$item['Project']['id']] = $item['Project']['title'];
        }
        //
        $member_id = $this->Session->read('Member.id');
        $this->Product->Member->recursive = -1;
        $member = $this->Product->Member->findById($member_id);
        //Set data category neu co chon group
        $categogies = null;
        if(isset($this->request->data['Product']['groupproduct']) && $this->request->data['Product']['groupproduct'] != '')
        {
            $groupproduct_id = $this->request->data['Product']['groupproduct'];
            $this->Product->Category->recursive = -1;
            $category = $this->Product->Category->find('all', array(
                'conditions' => array('Category.groupproduct_id = ' . $groupproduct_id)
            ));
            foreach ($category as $item)
            {
                $categogies[$item['Category']['id']] = $item['Category']['categoryname'];
            }
        }
        //Set data district neu co chon province
        $districts = null;
        if(isset($this->request->data['Product']['province']) && $this->request->data['Product']['province'] != '')
        {
            $province_id = $this->request->data['Product']['province'];
            $this->Product->Ward->District->recursive = -1;
            $district = $this->Product->Ward->District->find('all', array(
                'conditions' => array('District.province_id = ' . $province_id)
            ));
            foreach ($district as $item)
            {
                $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
            }
        }
        //Set data ward neu co chon district
        $wards = null;
        if(isset($this->request->data['Product']['district']) && $this->request->data['Product']['district'] != '')
        {
            $district_id = $this->request->data['Product']['district'];
            $this->Product->Ward->recursive = -1;
            $ward = $this->Product->Ward->find('all', array(
                'conditions' => array('Ward.district_id = ' . $district_id)
            ));
            foreach ($ward as $item)
            {
                $wards[$item['Ward']['id']] = $item['Ward']['wardtype'] . ' ' . $item['Ward']['wardname'];
            }
        }
        //
        $this->set(array(
            'transactiontypes' => $transction_types,
            'groups' => $groups,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
            'directions' => $directions,
            'projects' => $projects,
            'member' => $member,
            'categories' => $categogies,
            'title' => 'Đăng tin bất động sản'
        ));
        ////////////////////////////////////////
        ////////////////////////////////////////
        ////////////////////////////////////////
        //Post
        ///
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Product->set($this->request->data);
            if($this->Product->validates())
            {
                $this->Product->set('member_id', $member_id);
                $images = $this->request->data['Imagesproduct']['imagelink'];
                $err_image = false;
                if(count($images) > 20)
                {
                    $this->Session->setFlash('Bạn không được chọn quá 20 hình ảnh', 'flashError');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                //check error image
                foreach ($images as $item)
                {
                    if($item['name'] != '')
                    {
                        if($item['type'] != 'image/png' && $item['type'] != 'image/jpeg')
                        {
                            $this->Session->setFlash('Chỉ được chọn file hình ảnh', 'flashWarning');
                            $err_image = true;
                            break;
                        }
                        if($item['size'] > 2097152)
                        {
                            $this->Session->setFlash('Mỗi hình ảnh dung lượng không được quá 2Mb', 'flashWarning');
                            $err_image = true;
                            break;
                        }
                    }
                }
                //Neu hinh anh khong co loi
                if($err_image == false)
                {
                    //Tạo slug
                    $product_link = $this->Library->make_link($this->request->data['Product']['title']);
                    $this->Product->set('productlink', $product_link);
                    ///Kiem tra gia
                    //Nêu thỏa thuận => price = 0;
                    if(isset($this->request->data['Product']['pricedeal']) && $this->request->data['Product']['pricedeal'] == 1)
                    {
                        $this->Product->set('price', 0);
                    }
                    //Neu min max thì luu vao 2 column
                    elseif (isset($this->request->data['Product']['priceminmax']) && $this->request->data['Product']['priceminmax'] == 1)
                    {
                        $this->Product->set('price', $this->request->data['Product']['price_min']);
                        $this->Product->set('price2', $this->request->data['Product']['price_max']);
                    }
                    //còn lại lưu giá vào giá bình thuòng
                    else
                    {
                        $this->Product->set('price', $this->request->data['Product']['price']);
                    }
                    //Kiểm tra dien tích
                    //Neu min max thi luu vao 2 cot
                    if(isset($this->request->data['Product']['acreage_minmax']) && $this->request->data['Product']['acreage_minmax'] == 1)
                    {
                        $this->Product->set('acreage', $this->request->data['Product']['acreage_min']);
                        $this->Product->set('acreage2', $this->request->data['Product']['acreage_max']);
                    }
                    //nguoc lai luu vao 1 cột
                    else
                    {
                        $this->Product->set('acreage', $this->request->data['Product']['acreage']);
                    }
                    //Luu product
                    if($this->Product->save($this->request->data))
                    {
                        $this->Product->Environment->set('product_id', $this->Product->id);
                        $this->Product->Utility->set('product_id', $this->Product->id);
                        $this->Product->Environment->save($this->request->data);
                        $this->Product->Utility->save($this->request->data);
                        //Image
                        $date = getdate();
                        $year = $date['year'];
                        $month = $date['mon'];
                        App::import('Vendor', 'resize');
                        $thumb = new SimpleImage();
                        $path = $this->Library->create_folder($year, $month, $this->path_product);
                        $path_thum = $this->Library->create_folder($year, $month, $this->path_product_thumb);
                        $i = 1;
                        $time = new DateTime();
                        $timestamp = $time->getTimestamp();
                        foreach ($images as $image)
                        {
                            if($image['name'] != '')
                            {
                                $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                                $filename = $product_link.'-'.$this->Product->id.'-'.$timestamp.'-'.$i.'.'.$ext;
                                if(move_uploaded_file($image['tmp_name'], $path.DS.$filename))
                                {
                                    try
                                    {
                                        $this->Library->img_resize($path.DS.$filename, $path.DS.$filename, 630, 450, 100, $this->path_product.DS.'watermark.png');
                                        // $this->Library->watermark_image($path.DS.$filename, $path.DS.$filename, $this->path_product.DS.'watermark.png');
                                    }
                                    catch (Exception $exception)
                                    {

                                    }
                                    //Thumb
                                    $thumb->load($path.DS.$filename);
                                    $thumb->scale(50);
                                    $thumb->save($path_thum.DS.$filename);
                                    //
                                    $this->Product->Image->create();
                                    $this->Product->Image->set('product_id', $this->Product->id);
                                    $this->Product->Image->set('imagelink', $filename);
                                    $this->Product->Image->set('imagedir', $year.'/'.$month);
                                    $this->Product->Image->set('imagetitle', $this->request->data['Product']['title']);
                                    $this->Product->Image->save();
                                    $i = $i + 1;
                                }
                            }
                        }
                        //Update hình anh chinh
                        $this->Product->Image->recursive = -1;
                        $image_product_save = $this->Product->Image->find('first', array(
                            'conditions' => array('product_id' => $this->Product->id),
                            'order' => array('imagelink' => 'asc')
                        ));
                        if($image_product_save)
                        {
                            $update_image = array(
                                'id' => $this->Product->id,
                                'image' => $year.'/'.$month.'/'.$image_product_save['Image']['imagelink'],
                            );
                            $this->Product->save($update_image);
                        }
                        //Redirect
                        $this->redirect('/packets/paid/?pid=' . $this->Product->id);
                    }
                }
            }
            else
            {
                $this->Session->setFlash('Vui lòng hoàn thành các trường bắt buột', 'flashWarning');
            }
        }
    }
    public function edit()
    {
        //Check session
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/members/login');
        }
        $pid = 0;
        if(isset($this->params['url']['pid']))
        {
            $pid = $this->params['url']['pid'];
        }
        //Get product
        $this->Product->recursive = -1;
        $product = $this->Product->find('first', array(
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'transactiontypes',
                    'alias' => 'Transactiontype',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Transactiontype.id = Product.transactiontype_id'
                ),
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
                    'type' => 'LEFT',
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
                'Transactiontype.vend = 1',
//                'Product.status = 0',
//                'Product.paid = 0',
                'Product.deleted = 0',
                'Product.id = ' . $pid
            ),
        ));
        if(!$product)
        {
            $this->redirect('/members/mypost');
        }
        //Lấy hình ảnh
        $this->Product->Image->recursive = -1;
        $images = $this->Product->Image->find('all', array(
            'conditions' => array('product_id = ' . $pid)
        ));
        //Lấy utility
        $this->Product->Utility->recursive = -1;
        $utility = $this->Product->Utility->find('first', array(
            'conditions' => array('Utility.product_id = ' . $pid)
        ));
        //Lấy environment
        $this->Product->Environment->recursive = -1;
        $environment = $this->Product->Environment->find('first', array(
            'conditions' => array('Environment.product_id = ' . $pid)
        ));
        //
        $directions = null;
        $transction_types = null;
        $groups = null;
        $provinces = null;
        //Transaction type
        $this->Product->Transactiontype->recursive = -1;
        $tran_type = $this->Product->Transactiontype->find('all');
        foreach ($tran_type as $item)
        {
            $transction_types[$item['Transactiontype']['id']] = $item['Transactiontype']['nametype'];
        }
        //Group product
        $this->Product->Category->Group->recursive = -1;
        $group = $this->Product->Category->Group->find('all', array(
            'order' => array('Group.sort' => 'ASC')
        ));
        foreach ($group as $item)
        {
            $groups[$item['Group']['id']] = $item['Group']['groupname'];
        }
        //Province
        $this->Product->Ward->District->Province->recursive = -1;
        $province = $this->Product->Ward->District->Province->find('all', array(
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //Direction
        $this->Product->Direction->recursive = -1;
        $direction = $this->Product->Direction->find('all');
        foreach ($direction as $item)
        {
            $directions[$item['Direction']['id']] = $item['Direction']['directionname'];
        }
        //
        $member_id = $this->Session->read('Member.id');
        $this->Product->Member->recursive = -1;
        $member = $this->Product->Member->findById($member_id);
        //Set data category neu co chon group
        $categogies = null;
        $groupproduct_id = $product['Group']['id'];
        if(isset($this->request->data['Product']['groupproduct']) && $this->request->data['Product']['groupproduct'] != '')
        {
            $groupproduct_id = $this->request->data['Product']['groupproduct'];
        }
        $this->Product->Category->recursive = -1;
        $category = $this->Product->Category->find('all', array(
            'conditions' => array('Category.groupproduct_id = ' . $groupproduct_id)
        ));
        foreach ($category as $item)
        {
            $categogies[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //Set data district neu co chon province
        $districts = null;
        $province_id = $product['Province']['id'];
        if(isset($this->request->data['Product']['province']) && $this->request->data['Product']['province'] != '')
        {
            $province_id = $this->request->data['Product']['province'];
        }
        $this->Product->Ward->District->recursive = -1;
        $district = $this->Product->Ward->District->find('all', array(
            'conditions' => array('District.province_id = ' . $province_id)
        ));
        foreach ($district as $item)
        {
            $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
        }
        //Set data ward neu co chon district
        $wards = null;
        $district_id = $product['District']['id'];
        if(isset($this->request->data['Product']['district']) && $this->request->data['Product']['district'] != '')
        {
            $district_id = $this->request->data['Product']['district'];
        }
        $this->Product->Ward->recursive = -1;
        $ward = $this->Product->Ward->find('all', array(
            'conditions' => array('Ward.district_id = ' . $district_id)
        ));
        foreach ($ward as $item)
        {
            $wards[$item['Ward']['id']] = $item['Ward']['wardtype'] . ' ' . $item['Ward']['wardname'];
        }
        //
        $this->set(array(
            'product' => $product,
            'images' => $images,
            'environment' => $environment,
            'utility' => $utility,
            'transactiontypes' => $transction_types,
            'groups' => $groups,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
            'directions' => $directions,
            'member' => $member,
            'categories' => $categogies,
            'title' => 'Sửa tin bất động sản'
        ));
        ////////////////////////////////////////
        ////////////////////////////////////////
        ////////////////////////////////////////
        //Post
        ///
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Product->set($this->request->data);
            if($this->Product->validates())
            {
                $this->Product->set('member_id', $member_id);
                $images = $this->request->data['Imagesproduct']['imagelink'];
                $err_image = false;
                if(count($images) > 20)
                {
                    $this->Session->setFlash('Bạn không được chọn quá 20 hình ảnh', 'flashError');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
//                //check error image
                $count_image_choose = 0;
                foreach ($images as $item)
                {
                    if($item['name'] != '')
                    {
                        if($item['type'] != 'image/png' && $item['type'] != 'image/jpeg')
                        {
                            $this->Session->setFlash('Chỉ được chọn file hình ảnh', 'flashWarning');
                            $this->redirect($_SERVER['REQUEST_URI']);
                        }
                        if($item['size'] > 2097152)
                        {
                            $this->Session->setFlash('Mỗi hình ảnh dung lượng không được quá 2Mb', 'flashWarning');
                            $this->redirect($_SERVER['REQUEST_URI']);
                            break;
                        }
                        //Dem hinh anh chon
                        $count_image_choose = $count_image_choose + 1;
                    }
                }
                //Neu không có chọn hinh ảnh thì kiểm tra trong database xem còn bao nhieu ảnh cũ
                //Và kiểm tra xem tổng ảnh mới và ảnh củ có lớn hơn 20 không
                $this->Product->Image->recursive = -1;
                $count_image_old = $this->Product->Image->find('count', array(
                    'conditions' => array('Image.product_id' => $this->request->data['Product']['id'])
                ));
                if($count_image_old + $count_image_choose > 20)
                {
                    $this->Session->setFlash('Bạn không được chọn thêm quá ' . (20 - $count_image_old) . ' hình ảnh', 'flashWarning');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
//                elseif ($count_image_old == 0 && $count_image_choose == 0)
//                {
//                    $this->Session->setFlash('Chọn hình ảnh cho bất động sản', 'flashWarning');
//                    $this->redirect($_SERVER['REQUEST_URI']);
//                }
                //
                //Neu hinh anh khong co loi
                if($err_image == false)
                {
                    //Tạo slug
                    $product_link = $this->Library->make_link($this->request->data['Product']['title']);
                    $this->Product->set('productlink', $product_link);
                    ///Kiem tra gia
                    //Nêu thỏa thuận => price = 0;
                    if(isset($this->request->data['Product']['pricedeal']) && $this->request->data['Product']['pricedeal'] == 1)
                    {
                        $this->Product->set('price', 0);
                        $this->Product->set('price2', 0);
                    }
                    //Neu min max thì luu vao 2 column
                    elseif (isset($this->request->data['Product']['priceminmax']) && $this->request->data['Product']['priceminmax'] == 1)
                    {
                        $this->Product->set('price', $this->request->data['Product']['price_min']);
                        $this->Product->set('price2', $this->request->data['Product']['price_max']);
                    }
                    //còn lại lưu giá vào giá bình thuòng
                    else
                    {
                        $this->Product->set('price', $this->request->data['Product']['price']);
                        $this->Product->set('price2', 0);
                    }
                    //Kiểm tra dien tích
                    //Neu min max thi luu vao 2 cot
                    if(isset($this->request->data['Product']['acreage_minmax']) && $this->request->data['Product']['acreage_minmax'] == 1)
                    {
                        $this->Product->set('acreage', $this->request->data['Product']['acreage_min']);
                        $this->Product->set('acreage2', $this->request->data['Product']['acreage_max']);
                    }
                    //nguoc lai luu vao 1 cột
                    else
                    {
                        $this->Product->set('acreage', $this->request->data['Product']['acreage']);
                        $this->Product->set('acreage2', 0);
                    }
                    //Luu product
                    if($this->Product->save($this->request->data))//($this->request->data['Product'], array('Product.id' => $this->request->data['Product']['id'])))
                    {
                        //Update lại environment và utility
                        $this->Product->Environment->updateAll($this->request->data['Environment'], array('product_id' => $this->Product->id));
                        $this->Product->Utility->updateAll($this->request->data['Utility'], array('product_id' => $this->Product->id));
                        //Image dir //Lấy theo ngày tạo post
                        $this->Product->recursive = -1;
                        $product_saved = $this->Product->find('first', array(
                            'conditions' => array('id' => $this->Product->id),
                            'fields' => array('created')
                        ));
                        $date = $product_saved['Product']['created'];
                        $arr = explode(' ', $date);
                        $arr_date = explode('-', $arr[0]);
                        $img_dir =  (int)$arr_date[0] . '/' . (int)$arr_date[1];
                        //
                        App::import('Vendor', 'resize');
                        $thumb = new SimpleImage();
                        $path = $this->path_product.'/'.$img_dir;
                        $path_thumb = $this->path_product_thumb.'/'.$img_dir;
                        $i = 1;
                        $time = new DateTime();
                        $timestamp = $time->getTimestamp();
                        foreach ($images as $image)
                        {
                            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                            $filename = $product_link.'-'.$this->Product->id.'-'.$timestamp.'-'.$i.'.'.$ext;
                            if(move_uploaded_file($image['tmp_name'], $path.DS.$filename))
                            {
                                try
                                {
                                    $this->Library->img_resize($path.DS.$filename, $path.DS.$filename, 630, 450, 100, $this->path_product.DS.'watermark.png');
                                }
                                catch (Exception $exception)
                                {

                                }
                                //Thumb
                                $thumb->load($path.DS.$filename);
                                $thumb->scale(50);
                                $thumb->save($path_thumb.DS.$filename);
                                //
                                $this->Product->Image->create();
                                $this->Product->Image->set('product_id', $this->Product->id);
                                $this->Product->Image->set('imagelink', $filename);
                                $this->Product->Image->set('imagedir', $img_dir);
                                $this->Product->Image->set('imagetitle', $this->request->data['Product']['title']);
                                $this->Product->Image->save();
                                $i = $i + 1;
                            }
                        }
                        //Update hình anh chinh
                        $this->Product->Image->recursive = -1;
                        $image_product_save = $this->Product->Image->find('first', array(
                            'conditions' => array('product_id' => $this->Product->id),
                            'order' => array('imagelink' => 'asc')
                        ));
                        $image_product = '';
                        if($image_product_save)
                        {
                            $image_product = $img_dir.'/'.$image_product_save['Image']['imagelink'];
                        }
                        $update_image = array(
                            'id' => $this->Product->id,
                            'image' => $image_product,
                        );
                        $this->Product->save($update_image);
                        //Redirect
                        $this->redirect('/packets/paid/?pid=' . $this->Product->id);
                        //
                    }
                }
            }
            else
            {
                $this->Session->setFlash('Vui lòng hoàn thành các trường bắt buột', 'flashWarning');
            }
        }
    }
    public function delete_image()
    {
        $this->autoRender = false;
        if(!$this->Session->check('Member'))
        {
            echo 'fail';
        }
        else
        {
            $image_id = $this->request->data['image_id'];
            $image_data = $this->Product->Image->findById($image_id);
            if($image_data)
            {
                if($this->Product->Image->delete($image_id))
                {
                    unlink($this->path_product . '/' . $image_data['Image']['imagedir'] . '/' . $image_data['Image']['imagelink']);
                    unlink($this->path_product_thumb . '/' . $image_data['Image']['imagedir'] . '/' . $image_data['Image']['imagelink']);
                    echo 'success';
                }
                else
                {
                    echo 'fail';
                }
            }
            else
            {
                echo 'fail';
            }
        }
    }
    public function add_favorite()
    {
        $this->autoRender = false;
        if($this->Session->check('Member.id'))
        {
            $member_id = $this->Session->read('Member.id');
            $product_id = $this->request->data['product_id'];
            $data_save = array(
                'member_id' => $member_id,
                'product_id' => $product_id,
            );
            $count = $this->Product->Memberproduct->find('count', array(
                'conditions' => array(
                    'member_id' => $member_id,
                    'product_id' => $product_id,
                )
            ));
            if($count == 0)
            {
                if($this->Product->Memberproduct->save($data_save))
                {
                    $json = array(
                        'status' => 'success',
                        'message' => 'Đã thêm vào yêu thích'
                    );
                    echo json_encode($json);
                }
                else
                {
                    $json = array(
                        'status' => 'fail',
                        'message' => 'Lỗi'
                    );
                    echo json_encode($json);
                }
            }
            else
            {
                $json = array(
                    'status' => 'success',
                    'message' => 'Bạn đã thêm vào yêu thích'
                );
                echo json_encode($json);
            }
        }
        else
        {
            $json = array(
                'status' => 'not_login',
                'message' => 'Vui lòng đăng nhập trước khi lưu'
            );
            echo json_encode($json);
        }
    }

    //
    //Searh
    function search()
    {

    }

    ////////////////////////////////////////
    ////////////////////////////////////////
    //Admin
    ////////////////////////////////////////
    ////////////////////////////////////////
    public function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $url = $this->params['url'];
        //Tỉnh thành
        $province_search_id = isset($url['province'])? $url['province']: 0;
        $condition_province = ($province_search_id > 0)? 'Province.id = ' . $province_search_id: '';
        //Quan huyen
        $district_search_id = isset($url['district'])? $url['district']: 0;
        $condition_district = ($district_search_id > 0)? 'District.id = ' . $district_search_id: '';
        //Xa phuong
        $ward_search_id = isset($url['ward'])? $url['ward']: 0;
        $condition_ward = ($ward_search_id > 0)? 'Ward.id = ' . $ward_search_id: '';
        //Direction
        $direction_search_id = isset($url['direction'])? $url['direction']: 0;
        $condition_direction = ($direction_search_id > 0)? 'Direction.id = ' . $direction_search_id: '';
        //Floor
        $floor_search = isset($url['floornumber'])? $url['floornumber']: 0;
        $condition_floornumber = ($floor_search > 0)? 'Product.floornumber = ' . $floor_search: '';
        //Floor
        $room_search = isset($url['roomnumber'])? $url['roomnumber']: 0;
        $condition_roomnumber = ($room_search > 0)? 'Product.roomnumber = ' . $room_search: '';
        //Transaction type
        $transactiontype_search = isset($url['transactiontype'])? $url['transactiontype']: '';
        $condition_transactiontype = ($transactiontype_search != '')? 'Transactiontype.id = ' . $transactiontype_search: '';
        //Group
        $group_search = isset($url['group'])? $url['group']: '';
        $condition_group = ($group_search != '')? 'Group.id = ' . $group_search: '';
        //category
        $category_search = isset($url['category'])? $url['category']: '';
        $condition_category = ($category_search != '')? 'CategoryProduct.id = ' . $category_search: '';
        //member
        $member_search = isset($url['member'])? $url['member']: '';
        $condition_member = ($member_search != '')? 'Member.fullname LIKE "%' . $member_search . '%"': '';
        //phone contact
        $phonenumber_search = isset($url['phonenumber'])? $url['phonenumber']: '';
        $condition_phonenumber = ($phonenumber_search != '')? 'Product.phonenumber = \'' . $phonenumber_search . '\'': '';
        //Email
        $email_search = isset($url['email'])? $url['email']: '';
        $condition_email = ($email_search != '')? 'Product.email = \'' . $email_search . '\'': '';
        //Packet
        $packet_search = isset($url['packet'])? $url['packet']: '';
        $condition_packet = ($packet_search != '')? 'Packet.id = ' . $packet_search: '';
        //Ngay het han
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        ///Filter
        $filter = isset($url['filter'])? $url['filter']: '';
        $condition_filter = '';
        if($filter == 'expired')
        {
            $condition_filter = 'Product.expiry < "' . $cur_date . '" AND Product.expiry > "0000-00-00 00:00:00"';
            $condition_filter = $condition_filter . ' AND Product.status = 1 AND Product.paid = 1 AND Product.deleted  = 0';
        }
        if($filter == 'visible')
        {
            $condition_filter = 'Product.expiry >= "' . $cur_date . '" AND Product.deleted = 0 AND Product.status = 1 AND Product.paid = 1';
        }
        if($filter == 'deleted')
        {
            $condition_filter = 'Product.deleted = 1';
        }
        if($filter == 'draft')
        {
            $condition_filter = 'Product.deleted = 0 AND Product.status = 0 AND Product.paid = 0';
        }
        //End dieu kien tim kiem
        /////Dieu kien mac dinh
        $this->Product->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => '10',
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'transactiontypes',
                    'alias' => 'Transactiontype',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.transactiontype_id = Transactiontype.id'
                ),
                array(
                    'table' => 'wards',
                    'alias' => 'Ward',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.ward_id = Ward.id')
                ),
                array(
                    'table' => 'categoriesproducts',
                    'alias' => 'CategoryProduct',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('CategoryProduct.id = Product.categoryproduct_id')
                ),
                array(
                    'table' => 'groupsproducts',
                    'alias' => 'Group',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Group.id = CategoryProduct.groupproduct_id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Ward.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'LEFT',
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
                //Dieu kien mac dinh
                $condition_filter,
                $condition_member,
                $condition_transactiontype,
                $condition_group,
                $condition_category,
                $condition_province,
                $condition_district,
                $condition_direction,
                $condition_floornumber,
                $condition_roomnumber,
                $condition_ward,
                $condition_packet,
                $condition_phonenumber,
                $condition_email
            ),
            'order' => array('Product.id' => 'DESC')
        );
        try
        {
            $product = $this->paginate('Product');
        }
        catch (NotFoundException $e)
        {
            $product = null;
        }
        $this->set(array(
            'products' => $product,
        ));

        //Tim kiem
        //Set transactiontype
        $transactiontypes = null;
        $this->Product->Transactiontype->recrusive = -1;
        $transactiontype = $this->Product->Transactiontype->find('all');
        foreach ($transactiontype as $item)
        {
            $transactiontypes[$item['Transactiontype']['id']] = $item['Transactiontype']['nametype'];
        }
        //Set Group
        $groups = null;
        $this->Product->Category->Group->recursive = -1;
        $group = $this->Product->Category->Group->find('all');
        foreach ($group as $item)
        {
            $groups[$item['Group']['id']] = $item['Group']['groupname'];
        }
        //Categories
        $categories = null;
        $this->Product->Category->recursive = -1;
        $category = $this->Product->Category->find('all', array(
            'conditions' => array('groupproduct_id' => $group_search)
        ));
        foreach ($category as $item)
        {
            $categories[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //Province
        $this->Product->Ward->District->Province->recursive = -1;
        $province = $this->Product->Ward->District->Province->find('all', array(
            'fields' => array('Province.id', 'Province.provincename'),
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item){
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //District
        $districts = null;
        $this->Product->Ward->District->recursive = -1;
        $district = $this->Product->Ward->District->find('all', array(
            'conditions' => array(
                'province_id' => $province_search_id
            )
        ));
        foreach ($district as $item)
        {
            $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
        }
        //Ward
        $wards = null;
        $this->Product->Ward->recursive = -1;
        $ward = $this->Product->Ward->find('all', array(
            'conditions' => array(
                'district_id' => $district_search_id
            )
        ));
        foreach ($ward as $item)
        {
            $wards[$item['Ward']['id']] = $item['Ward']['wardtype'] . ' ' . $item['Ward']['wardname'];
        }
        //Direction
        $this->Product->Direction->recursive = -1;
        $direction = $this->Product->Direction->find('all');
        foreach ($direction as $item)
        {
            $directions[$item['Direction']['id']] = $item['Direction']['directionname'];
        }
        //Packet
        $this->Product->Packet->recursive = -1;
        $packets = null;
        $packet = $this->Product->Packet->find('all');
        foreach ($packet as $item)
        {
            $packets[$item['Packet']['id']] = $item['Packet']['packetname'];
        }
        //
        $this->set(array(
            'title' => 'Danh sách tin đăng',
            'transactiontypes' => $transactiontypes,
            'groups' => $groups,
            'categories' => $categories,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
            'directions' => $directions,
            'packets' => $packets
        ));
    }
    public function admin_view($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->Product->recursive = -1;
        //Product primary
        $product = $this->Product->find('first', array(
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
                    'table' => 'transactiontypes',
                    'alias' => 'Transactiontype',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.transactiontype_id = Transactiontype.id'
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
                    'type' => 'LEFT',
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
                'Product.id = ' . $id
            ),
        ));
        //Lấy hình ảnh
        $this->Product->Image->recursive = -1;
        $images = $this->Product->Image->find('all', array(
            'conditions' => array('product_id = ' . $id)
        ));
        //Lấy utility
        $this->Product->Utility->recursive = -1;
        $utility = $this->Product->Utility->find('first', array(
            'conditions' => array('Utility.product_id = ' . $id)
        ));
        //Lấy environment
        $this->Product->Environment->recursive = -1;
        $environment = $this->Product->Environment->find('first', array(
            'conditions' => array('Environment.product_id = ' . $id)
        ));
        if($product)
        {
            //Lấy product liên quan
            //
            $this->set(array(
                'title' => 'Chi tiết tin bất động sản',
                'product' => $product,
                'images' => $images,
                'environment' => $environment,
                'utility' => $utility,
            ));
        }
        else
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/products');
        }
    }
    public function admin_edit($pid)
    {
        //Check session
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Get product
        $this->Product->recursive = -1;
        $product = $this->Product->find('first', array(
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
                    'type' => 'LEFT',
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
                'Product.id = ' . $pid
            ),
        ));
        if(!$product)
        {
            $this->redirect('/admin/products');
        }
        //Lấy hình ảnh
        $this->Product->Image->recursive = -1;
        $images = $this->Product->Image->find('all', array(
            'conditions' => array('product_id = ' . $pid)
        ));
        //Lấy utility
        $this->Product->Utility->recursive = -1;
        $utility = $this->Product->Utility->find('first', array(
            'conditions' => array('Utility.product_id = ' . $pid)
        ));
        //Lấy environment
        $this->Product->Environment->recursive = -1;
        $environment = $this->Product->Environment->find('first', array(
            'conditions' => array('Environment.product_id = ' . $pid)
        ));
        //
        $directions = null;
        $transction_types = null;
        $groups = null;
        $provinces = null;
        //Transaction type
        $this->Product->Transactiontype->recursive = -1;
        $tran_type = $this->Product->Transactiontype->find('all');
        foreach ($tran_type as $item)
        {
            $transction_types[$item['Transactiontype']['id']] = $item['Transactiontype']['nametype'];
        }
        //Group product
        $this->Product->Category->Group->recursive = -1;
        $group = $this->Product->Category->Group->find('all', array(
            'order' => array('Group.sort' => 'ASC')
        ));
        foreach ($group as $item)
        {
            $groups[$item['Group']['id']] = $item['Group']['groupname'];
        }
        //Province
        $this->Product->Ward->District->Province->recursive = -1;
        $province = $this->Product->Ward->District->Province->find('all', array(
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //Direction
        $this->Product->Direction->recursive = -1;
        $direction = $this->Product->Direction->find('all');
        foreach ($direction as $item)
        {
            $directions[$item['Direction']['id']] = $item['Direction']['directionname'];
        }
        //
        $member_id = $product['Product']['member_id'];
        $this->Product->Member->recursive = -1;
        $member = $this->Product->Member->findById($member_id);
        //Set data category neu co chon group
        $categogies = null;
        $groupproduct_id = $product['Group']['id'];
        if(isset($this->request->data['Product']['groupproduct']) && $this->request->data['Product']['groupproduct'] != '')
        {
            $groupproduct_id = $this->request->data['Product']['groupproduct'];
        }
        $this->Product->Category->recursive = -1;
        $category = $this->Product->Category->find('all', array(
            'conditions' => array('Category.groupproduct_id = ' . $groupproduct_id)
        ));
        foreach ($category as $item)
        {
            $categogies[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //Set data district neu co chon province
        $districts = null;
        $province_id = $product['Province']['id'];
        if(isset($this->request->data['Product']['province']) && $this->request->data['Product']['province'] != '')
        {
            $province_id = $this->request->data['Product']['province'];
        }
        $this->Product->Ward->District->recursive = -1;
        $district = $this->Product->Ward->District->find('all', array(
            'conditions' => array('District.province_id = ' . $province_id)
        ));
        foreach ($district as $item)
        {
            $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
        }
        //Set data ward neu co chon district
        $wards = null;
        $district_id = $product['District']['id'];
        if(isset($this->request->data['Product']['district']) && $this->request->data['Product']['district'] != '')
        {
            $district_id = $this->request->data['Product']['district'];
        }
        $this->Product->Ward->recursive = -1;
        $ward = $this->Product->Ward->find('all', array(
            'conditions' => array('Ward.district_id = ' . $district_id)
        ));
        foreach ($ward as $item)
        {
            $wards[$item['Ward']['id']] = $item['Ward']['wardtype'] . ' ' . $item['Ward']['wardname'];
        }
        //
        $this->set(array(
            'product' => $product,
            'images' => $images,
            'environment' => $environment,
            'utility' => $utility,
            'transactiontypes' => $transction_types,
            'groups' => $groups,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
            'directions' => $directions,
            'member' => $member,
            'categories' => $categogies,
            'title' => 'Sửa tin bất động sản'
        ));
        ////////////////////////////////////////
        ////////////////////////////////////////
        ////////////////////////////////////////
        //Post
        ///
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Product->set($this->request->data);
            if($this->Product->validates())
            {
                $images = $this->request->data['Imagesproduct']['imagelink'];
                $err_image = false;
                if(count($images) > 20)
                {
                    $this->Session->setFlash('Không được chọn quá 20 hình ảnh', 'flashError');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
//                //check error image
                $count_image_choose = 0;
                foreach ($images as $item)
                {
                    if($item['name'] != '')
                    {
                        if($item['type'] != 'image/png' && $item['type'] != 'image/jpeg')
                        {
                            $this->Session->setFlash('Chỉ được chọn file hình ảnh', 'flashWarning');
                            $this->redirect($_SERVER['REQUEST_URI']);
                        }
                        if($item['size'] > 2097152)
                        {
                            $this->Session->setFlash('Mỗi hình ảnh dung lượng không được quá 2Mb', 'flashWarning');
                            $this->redirect($_SERVER['REQUEST_URI']);
                            break;
                        }
                        //Dem hinh anh chon
                        $count_image_choose = $count_image_choose + 1;
                    }
                }
                //Neu không có chọn hinh ảnh thì kiểm tra trong database xem còn bao nhieu ảnh cũ
                //Và kiểm tra xem tổng ảnh mới và ảnh củ có lớn hơn 20 không
                $this->Product->Image->recursive = -1;
                $count_image_old = $this->Product->Image->find('count', array(
                    'conditions' => array('Image.product_id' => $this->request->data['Product']['id'])
                ));
                if($count_image_old + $count_image_choose > 20)
                {
                    $this->Session->setFlash('Bạn không được chọn thêm quá ' . (20 - $count_image_old) . ' hình ảnh', 'flashWarning');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
//                elseif ($count_image_old == 0 && $count_image_choose == 0)
//                {
//                    $this->Session->setFlash('Chọn hình ảnh cho bất động sản', 'flashWarning');
//                    $this->redirect($_SERVER['REQUEST_URI']);
//                }
                //
                //Neu hinh anh khong co loi
                if($err_image == false)
                {
                    //Tạo slug
                    $product_link = $this->Library->make_link($this->request->data['Product']['title']);
                    $this->Product->set('productlink', $product_link);
                    ///Kiem tra gia
                    //Nêu thỏa thuận => price = 0;
                    if(isset($this->request->data['Product']['pricedeal']) && $this->request->data['Product']['pricedeal'] == 1)
                    {
                        $this->Product->set('price', 0);
                        $this->Product->set('price2', 0);
                    }
                    //Neu min max thì luu vao 2 column
                    elseif (isset($this->request->data['Product']['priceminmax']) && $this->request->data['Product']['priceminmax'] == 1)
                    {
                        $this->Product->set('price', $this->request->data['Product']['price_min']);
                        $this->Product->set('price2', $this->request->data['Product']['price_max']);
                    }
                    //còn lại lưu giá vào giá bình thuòng
                    else
                    {
                        $this->Product->set('price', $this->request->data['Product']['price']);
                        $this->Product->set('price2', 0);
                    }
                    //Kiểm tra dien tích
                    //Neu min max thi luu vao 2 cot
                    if(isset($this->request->data['Product']['acreage_minmax']) && $this->request->data['Product']['acreage_minmax'] == 1)
                    {
                        $this->Product->set('acreage', $this->request->data['Product']['acreage_min']);
                        $this->Product->set('acreage2', $this->request->data['Product']['acreage_max']);
                    }
                    //nguoc lai luu vao 1 cột
                    else
                    {
                        $this->Product->set('acreage', $this->request->data['Product']['acreage']);
                        $this->Product->set('acreage2', 0);
                    }
                    //Luu product
                    if($this->Product->save($this->request->data))//($this->request->data['Product'], array('Product.id' => $this->request->data['Product']['id'])))
                    {
                        //Update lại environment và utility
                        if($product['Product']['transactiontype_id'] == 1 || $product['Product']['transactiontype_id'] == 2)
                        {
                            $this->Product->Environment->updateAll($this->request->data['Environment'], array('product_id' => $this->Product->id));
                            $this->Product->Utility->updateAll($this->request->data['Utility'], array('product_id' => $this->Product->id));
                        }
                        //Image dir //Lấy theo ngày tạo post
                        $this->Product->recursive = -1;
                        $product_saved = $this->Product->find('first', array(
                            'conditions' => array('id' => $this->Product->id),
                            'fields' => array('created')
                        ));
                        $date = $product_saved['Product']['created'];
                        $arr = explode(' ', $date);
                        $arr_date = explode('-', $arr[0]);
                        $img_dir =  (int)$arr_date[0] . '/' . (int)$arr_date[1];
                        //
                        App::import('Vendor', 'resize');
                        $thumb = new SimpleImage();
                        $path = $this->path_product.'/'.$img_dir;
                        $path_thumb = $this->path_product_thumb.'/'.$img_dir;
                        $i = 1;
                        $time = new DateTime();
                        $timestamp = $time->getTimestamp();
                        foreach ($images as $image)
                        {
                            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                            $filename = $product_link.'-'.$this->Product->id.'-'.$timestamp.'-'.$i.'.'.$ext;
                            if(move_uploaded_file($image['tmp_name'], $path.DS.$filename))
                            {
                                try
                                {
                                    $this->Library->img_resize($path.DS.$filename, $path.DS.$filename, 630, 450, 100, $this->path_product.DS.'watermark.png');
                                }
                                catch (Exception $exception)
                                {

                                }
                                //Thumb
                                $thumb->load($path.DS.$filename);
                                $thumb->scale(50);
                                $thumb->save($path_thumb.DS.$filename);
                                //
                                $this->Product->Image->create();
                                $this->Product->Image->set('product_id', $this->Product->id);
                                $this->Product->Image->set('imagelink', $filename);
                                $this->Product->Image->set('imagedir', $img_dir);
                                $this->Product->Image->set('imagetitle', $this->request->data['Product']['title']);
                                $this->Product->Image->save();
                                $i = $i + 1;
                            }
                        }
                        //Update hình anh chinh
                        $this->Product->Image->recursive = -1;
                        $image_product_save = $this->Product->Image->find('first', array(
                            'conditions' => array('product_id' => $this->Product->id),
                            'order' => array('imagelink' => 'asc')
                        ));
                        $image_product = '';
                        if($image_product_save)
                        {
                            $image_product = $img_dir.'/'.$image_product_save['Image']['imagelink'];
                        }
                        $update_image = array(
                            'id' => $this->Product->id,
                            'image' => $image_product,
                        );
                        $this->Product->save($update_image);
                        //Redirect
                        $this->Session->setFlash('Đã cập nhật', 'flashSuccess');
                        $this->redirect('/admin/products');
                        //
                    }
                }
            }
            else
            {
                $this->Session->setFlash('Vui lòng hoàn thành các trường bắt buột', 'flashWarning');
            }
        }
    }
    public function admin_delete_image()
    {
        $this->autoRender = false;
        if(!$this->Session->check('Admin'))
        {
            echo 'fail';
        }
        else
        {
            $image_id = $this->request->data['image_id'];
            $image_data = $this->Product->Image->findById($image_id);
            if($image_data)
            {
                if($this->Product->Image->delete($image_id))
                {
                    unlink($this->path_product . '/' . $image_data['Image']['imagedir'] . '/' . $image_data['Image']['imagelink']);
                    unlink($this->path_product_thumb . '/' . $image_data['Image']['imagedir'] . '/' . $image_data['Image']['imagelink']);
                    echo 'success';
                }
                else
                {
                    echo 'fail';
                }
            }
            else
            {
                echo 'fail';
            }
        }
    }
    public function admin_register_products()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Set
        $register_products = null;
        ClassRegistry::init('Registerproduct')->recursive = -1;
        $register_products = ClassRegistry::init('Registerproduct')->find('all', array(
            'joins' => array(
                array(
                    'table' => 'products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Registerproduct.product_id = Product.id'
                )
            ),
            'conditions' => array(),
            'order' => array('Registerproduct.id' => 'DESC'),
            'fields' => array('Registerproduct.*', 'Product.title', 'Product.id')
        ));
        $this->set(array(
            'title' => 'Danh sách đăng ký nhận thông tin bất động sản',
            'register_products' => $register_products
        ));
    }
    public function admin_awaiting_approval()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
//        $url = $this->params['url'];
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        ///Filter
        //End dieu kien tim kiem
        /////Dieu kien mac dinh
        $product = null;
        $this->Product->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => '10',
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
                array(
                    'table' => 'orders',
                    'alias' => 'Order',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.id = Order.product_id')
                )
            ),
            'conditions' => array(
                'Product.status = 0',
                'Product.paid = 1',
                'Product.expiry >= "' . $cur_date . '"',
                'Order.status = 0'
            ),
            'order' => array('Product.id' => 'DESC')
        );
        try
        {
            $product = $this->paginate('Product');
        }
        catch (NotFoundException $e)
        {
            $this->Session->setFlash('Not found', 'flashError');
        }

        $this->set(array(
            'products' => $product,
            'title' => 'Tin đăng chờ duyệt',
        ));
    }
    public function admin_confirm_approval()
    {
        if($this->Session->check('Admin'))
        {
            $this->autoRender = false;
            if($this->request->is('post') || $this->request->is('put'))
            {
                $product_id = $this->request->data['product_id'];
                $order_id = $this->request->data['order_id'];
                $data_update_product = array(
                    'id' => $product_id,
                    'status' => '1'
                );
                $data_update_order = array(
                    'id' => $order_id,
                    'status' => '1',
                    'staff_id' => $this->Session->read('Admin.id')
                );
                if($this->Product->save($data_update_product) && $this->Product->Order->save($data_update_order))
                {
                    $this->Session->setFlash('Đã duyệt tin', 'flashSuccess');
                }
                else
                {
                    $this->Session->setFlash('Lỗi', 'flashError');
                }
            }
        }
    }
}