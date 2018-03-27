<?php
function highlight($text, $words) {
    preg_match_all('~\w+~', $words, $m);
    if(!$m)
        return $text;
    $re = '~\\b(' . implode('|', $m[0]) . ')\\b~';
    return preg_replace($re, '<b>$0</b>', $text);
}

$text = '
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat.
';

$words = 'ipsum labore';

print highlight($text, $words);


function index_can_mua_can_thue_1()
{
//        $this->layout = 'default_can_mua_can_thue';
    //Title
    $title_type = 'Cần mua, cần thuê ';
    $title_location = '';
    $title = 'Nhà đất cần mua, cần thuê';
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
    $buy = isset($this->params['type'])? $this->params['type']: ''; // Set = can mua or can thue ở router
    //
    //Điều kiện xác định bán hoặc cho thuê
    $condition_buy = '';
    if($buy != '' && $buy == 'can-mua')
    {
        $title_type = 'Cần mua ';
        $title = 'Cần mua nhà đất ';
        $condition_buy = 'Transactiontype.buy = 1';
    }
    if($buy != '' && $buy == 'can-thue')
    {
        $title_type = 'Cần thuê ';
        $title = 'Cần thuê nhà đất ';
        $condition_buy = 'Transactiontype.buy = 0';
    }
    //
    //Dieu kien tim kiem
    //Giá
    $price_min = isset($url['price_min'])? $url['price_min']: 0;
    $price_max = isset($url['price_max'])? $url['price_max']: 0;
    $condition_price_min = ($price_min > 0)? 'Product.price >= ' . $price_min: '';
    $condition_price_max = ($price_max > 0)? 'Product.price <= ' . $price_max: '';
    //Dien tich
    $acreage_min = isset($url['acreage_min'])? $url['acreage_min']: 0;
    $acreage_max = isset($url['acreage_max'])? $url['acreage_max']: 0;
    $condition_acreage_min = ($acreage_min > 0)? 'Product.acreage >= ' . $acreage_min: '';
    $condition_acreage_max = ($acreage_max > 0)? 'Product.acreage <= ' . $acreage_max: '';
    //Direction
    $direction_search_id = isset($url['direction'])? $url['direction']: 0;
    $condition_direction = ($direction_search_id > 0)? 'Direction.id = ' . $direction_search_id: '';
    //Floor
    $floor_search = isset($url['floornumber'])? $url['floornumber']: 0;
    $condition_floornumber = ($floor_search > 0)? 'Product.floornumber = ' . $floor_search: '';
    //Room
    $room_search = isset($url['roomnumber'])? $url['roomnumber']: 0;
    $condition_roomnumber = ($room_search > 0)? 'Product.roomnumber = ' . $room_search: '';
    //Key
    $key_search = isset($url['search'])? $url['search']: 0;
    $condition_key = ($key_search != '')? 'Product.title LIKE "%' . $key_search . '%"': '';
    //End dieu kien tim kiem
    /////Dieu kien mac dinh
    //Ngay het han
    $date = getdate();
    $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
    ///
    // set ul for location
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
                'Transactiontype.vend = 0',
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
                'Transactiontype.vend = 0',
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
                'Transactiontype.vend = 0',
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
                'Transactiontype.vend = 0',
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
            'Transactiontype.vend = 0',
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
        'order' => array('Packet.sort' => 'asc', 'Product.date_paid' => 'desc')
    );
    try
    {
        $product = $this->paginate('Product');
    }
    catch (NotFoundException $e)
    {
//            $this->Session->setFlash('Not found', 'flashError');
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
        'head_description' => $title,
        'title' => $title,
        'directions' => $directions,
    ));
    //
}