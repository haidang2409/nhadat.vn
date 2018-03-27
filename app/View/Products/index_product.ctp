<?php
$price = isset($this->params['url']['price'])? $this->params['url']['price']: '';
$acreage = isset($this->params['url']['acreage'])? $this->params['url']['acreage']: '';
$direction = isset($this->params['url']['direction'])? $this->params['url']['direction']: '';
$floornumber = isset($this->params['url']['floor_number'])? $this->params['url']['floor_number']: '';
$roomnumber = isset($this->params['url']['room_number'])? $this->params['url']['room_number']: '';
$search = isset($this->params['url']['search'])? $this->params['url']['search']: '';
//Type ban hoac cho thue
$type = isset($this->params['type'])? $this->params['type'] . '-': '';
$name_type = '';
if($type == 'ban-')
{
    $name_type = 'Bán ';
}
if($type == 'cho-thue-')
{
    $name_type = 'Cho thuê ';
}
if($type == 'can-mua-')
{
    $name_type = 'Cần mua ';
}
if($type == 'can-thue-')
{
    $name_type = 'Cần thuê ';
}
//Group
$grouplink = isset($this->params['grouplink'])? $this->params['grouplink']: '';
$groupid = isset($this->params['groupid'])? $this->params['groupid']: '';
//Category
$categorylink = isset($this->params['categorylink'])? $this->params['categorylink']: '';
$categoryid = isset($this->params['categoryid'])? $this->params['categoryid']: '';

//Link for location
$here = explode('/', $this->here);
$link_for_cat = isset($here[2])? '/'. $here[2]: '';
$link_for_location = '/' . $here[1];
$category_selected = '';
if($grouplink != '' && $groupid !='')
{
    $link_for_location = '/' . $type . $grouplink . '-' . $groupid;
    $category_selected = $grouplink . '-' . $groupid;
}
if($categorylink != '' && $categoryid != '')
{
    $link_for_location = '/' . $type . $categorylink . '-' . $categoryid;
    $category_selected = $categorylink . '-' . $categoryid;
}
$province_selected = '';
$district_selected = '';
$ward_selected = '';
if(isset($breadcrumb_province))
{
    $province_selected = $breadcrumb_province['Province']['provincelink'];
}
//District
if(isset($breadcrumb_district))
{
    $district_selected = $breadcrumb_district['District']['districtlink'];
    $province_selected = $breadcrumb_district['Province']['provincelink'];
}
//Ward
if(isset($breadcrumb_ward))
{
    $district_selected = $breadcrumb_ward['District']['districtlink'];
    $province_selected = $breadcrumb_ward['Province']['provincelink'];
    $ward_selected = $breadcrumb_ward['Ward']['wardlink'];
}

$query_string = $_SERVER['QUERY_STRING']!= ''? '?' . $_SERVER['QUERY_STRING']: '';
$query_string = preg_replace('/\?page=([0-9]+)/', '', $query_string);
$query_string = preg_replace('/\&page=([0-9]+)/', '', $query_string);
//
$option_price = array(
    '-1_-1' => 'Thỏa thuận',
    '0_1' => '< 1 triệu',
    '1_5' => '1 - 5 triệu',
    '5_10' => '5 - 10 triệu',
    '10_50' => '10 - 50 triệu',
    '50_100' => '50 - 100 triệu',
    '100_500' => '100 - 500 triệu',
    '500_1000' => '500 - 1 tỷ',
    '1000_5000' => '1 - 5 tỷ',
    '5000_10000' => '5 - 10 tỷ',
    '10000_50000' => '10 - 50 tỷ',
    '50000_0' => '> 50 tỷ',
);
$option_acreage = array(
    '0_10' => '< 10 m2',
    '10_50' => '10 - 50 m2',
    '50_100' => '50 - 100 m2',
    '100_500' => '100 - 500 m2',
    '500_1000' => '500 - 1000 m2',
    '1000_5000' => '1000 - 5000 m2',
    '5000_0' => '> 5000 m2',

);
$option_floor = array(
    '1' => '1+',
    '2' => '2+',
    '3' => '3+',
    '4' => '4+',
    '5' => '5+',
    '10' => '10+',
    '20' => '20+',
    '50' => '50+',
    '100' => '100+',
);
$option_room = array(
    '1' => '1+',
    '2' => '2+',
    '3' => '3+',
    '4' => '4+',
    '5' => '5+',
    '10' => '10+'
);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-3" style="padding-top: 0 !important;">
            <div class="product-search-header product-search-header-first">
                <div class="row">
                    <div class="col-xs-9">
                        <h3><?php echo __('Tìm kiếm');?></h3>
                    </div>
                    <div class="col-xs-3 text-right visible-xs" style="margin-top: 5px">
                        <i class="fa fa-angle-down bigger-150 btn-hide-search"></i>
                    </div>
                </div>
            </div>
            <div class="search-primary search-3">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-sm-12 div-choose-type">
                            <input id="type" type="hidden" value="<?php echo rtrim($type, '-');?>">
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="radio">
                                <label>
                                    <input name="rdoType" value="ban" class="ace rdoType" type="radio" <?php if($type == 'ban-'){ echo 'checked';}?>>
                                    <span class="lbl"> BĐS BÁN</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="radio">
                                <label>
                                    <input name="rdoType" value="cho-thue" class="ace rdoType" type="radio" <?php if($type == 'cho-thue-'){ echo 'checked';}?>>
                                    <span class="lbl"> CHO THUÊ</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="radio">
                                <label>
                                    <input name="rdoType" value="can-mua" class="ace rdoType" type="radio" <?php if($type == 'can-mua-'){ echo 'checked';}?>>
                                    <span class="lbl"> CẦN MUA</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="radio">
                                <label>
                                    <input name="rdoType" value="can-thue" class="ace rdoType" type="radio" <?php if($type == 'can-thue-'){ echo 'checked';}?>>
                                    <span class="lbl"> CẦN THUÊ</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <?php echo $this->Form->input('category_', array('name' => 'category', 'id' => 'category', 'label' => false, 'class' => 'form-control', 'title' => 'Loại nhà đất', 'options' => $option_category, 'type' => 'select', 'empty' => ' -- Loại nhà đất -- ', 'style' => 'width: 100 % !important;', 'default' => $category_selected));?>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <?php echo $this->Form->input('province_', array('name' => 'province', 'id' => 'province', 'label' => false, 'class' => 'form-control', 'title' => 'Tỉnh/Thành phố', 'options' => $province_menu, 'type' => 'select', 'empty' => '-- Tỉnh thành -- ', 'style' => 'width: 100 % !important;', 'default' => $province_selected));?>
                            <?php echo $this->Form->input('district_', array('name' => 'district', 'id' => 'district', 'label' => false, 'class' => 'form-control', 'title' => 'Quận huyện', 'options' => $districts_option, 'type' => 'select', 'empty' => ' -- Quận huyện -- ', 'style' => 'width: 100 % !important;', 'default' => $district_selected));?>
                            <?php echo $this->Form->input('ward_', array('name' => 'ward', 'id' => 'ward', 'label' => false, 'class' => 'form-control', 'title' => 'Xã phường', 'options' => $wards_option, 'type' => 'select', 'empty' => ' -- Xã phường -- ', 'style' => 'width: 100 % !important;', 'default' => $ward_selected));?>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <?php echo $this->Form->input('price_', array('name' => 'price', 'id' => 'price', 'label' => false, 'class' => 'form-control', 'title' => 'Mức giá', 'options' => $option_price, 'type' => 'select', 'empty' => ' -- Mức giá -- ', 'style' => 'width: 100 % !important;', 'default' => $price));?>
                            <?php echo $this->Form->input('acreage_', array('name' => 'acreage', 'id' => 'acreage', 'label' => false, 'class' => 'form-control', 'title' => 'Diện tích', 'options' => $option_acreage, 'type' => 'select', 'empty' => ' -- Diện tích -- ', 'style' => 'width: 100 % !important;', 'default' => $acreage));?>
                            <?php echo $this->Form->input('direction', array('name' => 'direction', 'id' => 'direction', 'label' => false, 'class' => 'form-control', 'title' => 'Hướng bất động sản', 'options' => $directions, 'type' => 'select', 'empty' => ' -- Hướng -- ', 'style' => 'width: 100 % !important;', 'default' => $direction));?>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <?php echo $this->Form->input('floor_number', array('name' => 'floor_number', 'id' => 'floor_number', 'label' => false, 'class' => 'form-control', 'title' => 'Số tầng', 'options' => $option_floor, 'type' => 'select', 'empty' => ' -- Số tầng -- ', 'style' => 'width: 100 % !important;', 'default' => $floornumber));?>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <?php echo $this->Form->input('room_number', array('name' => 'room_number', 'id' => 'room_number', 'label' => false, 'class' => 'form-control', 'title' => 'Số phòng', 'options' => $option_room, 'type' => 'select', 'empty' => ' -- Phòng ngủ -- ', 'style' => 'width: 100 % !important;', 'default' => $roomnumber));?>
                        </div>
                        <div class="col-sm-12 col-xs-12 text-right">
                            <button type="button" id="btnSearchPrimary" class="btn btn-primary bolder"><i class="fa fa-search"> </i> TÌM KIẾM </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="product-search-category hidden-xs">
                <div class="product-search-header">
                    <h3><?php echo __('Search by category');?></h3>
                </div>
                <div class="accordian accordian-search">
                    <ul>
                        <?php
                        $sum_group = count($categories_menu);
                        for($i = 0; $i < $sum_group; $i++)
                        {
                            ?>
                            <li>
                                <h4>
                                    <a class="<?php if(isset($breadcrumb_group) && $breadcrumb_group['Group']['id'] == $categories_menu[$i]['Group']['id']){ echo ' link-waring';}?>" href="/<?php echo $type?><?php echo $categories_menu[$i]['Group']['grouplink'];?>-g<?php echo $categories_menu[$i]['Group']['id'];?><?php echo $link_for_cat?><?php echo $query_string?>">
                                        <?php
                                        echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower($name_type . $categories_menu[$i]['Group']['groupname'])), 1);
                                        ?>
                                    </a>
                                    <i data-expand="1" class="fa fa-plus icon-plus-expand"></i>
                                </h4>
                                <ul <?php if(isset($breadcrumb_category) && $breadcrumb_category['Group']['id'] == $categories_menu[$i]['Group']['id']){ echo 'style="display: block !important;"';}?>>
                                    <?php
                                    $cat = $categories_menu[$i]['Category'];
                                    $sum_category = count($cat);
                                    for($j = 0; $j < $sum_category; $j++)
                                    {
                                        ?>
                                        <li>
                                            <a class="<?php if(isset($breadcrumb_category) && $breadcrumb_category['Category']['id'] == $cat[$j]['id']){ echo ' link-waring';}?>" href="/<?php echo $type?><?php echo $cat[$j]['categorylink'];?>-c<?php echo $cat[$j]['id'];?><?php echo $link_for_cat;?><?php echo $query_string;?>">
                                                <?php echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower($name_type . $cat[$j]['categoryname'])), 1);?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="accordian">
                    <div class="product-search-location">
                        <div class="product-search-header">
                            <h3>Tìm theo vị trí</h3>
                        </div>
                    </div>
                    <!--                        //Breadcrumd-->
                    <ul>
                        <?php
                        if(isset($breadcrumb_province))
                        {
                            ?>
                            <li>
                                <h4>
                                    <a href="<?php echo $link_for_location . $query_string;?>">
                                        <?php echo $breadcrumb_province['Province']['provincename'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>
                                </h4>
                            </li>
                            <?php
                        }
                        if(isset($breadcrumb_district))
                        {
                            ?>
                            <li>
                                <h4>
                                    <a href="<?php echo $link_for_location . $query_string;?>">
                                        <?php echo $breadcrumb_district['Province']['provincename'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="<?php echo $link_for_location . '/' . $breadcrumb_district['Province']['provincelink'] . $query_string;?>">
                                        <?php echo $breadcrumb_district['District']['districttype'] . ' ' . $breadcrumb_district['District']['districtname'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>
                                </h4>
                            </li>
                            <?php
                        }
                        if(isset($breadcrumb_ward))
                        {
                            ?>
                            <li>
                                <h4>
                                    <a href="<?php echo $link_for_location . $query_string;?>">
                                        <?php echo $breadcrumb_ward['Province']['provincename'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="<?php echo $link_for_location . '/' . $breadcrumb_ward['Province']['provincelink'] . $query_string;?>">
                                        <?php echo $breadcrumb_ward['District']['districttype'] . ' ' . $breadcrumb_ward['District']['districtname'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="<?php echo $link_for_location . '/' . $breadcrumb_ward['District']['districtlink'] . $query_string;?>">
                                        <?php echo $breadcrumb_ward['Ward']['wardtype'] . ' ' . $breadcrumb_ward['Ward']['wardname'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>
                                </h4>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                    if(isset($provinces_all))
                    {
                        ?>
                        <ul>
                            <?php
                            foreach ($provinces_all as $item)
                            {
                                ?>
                                <li>
                                    <h4>
                                        <a href="<?php echo $link_for_location . '/' . $item['Province']['provincelink']  . $query_string;;?>">
                                            <?php echo $item['Province']['provincename']?>
                                        </a>
                                        <small style="font-style: italic" class="project-count-4">(<?php echo $item[0]['sum'];?>)</small>
                                    </h4>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    if(isset($provinces))
                    {
                        ?>
                        <ul>
                            <li>
                                <ul style="display: block;">
                                    <?php
                                    foreach ($provinces as $item)
                                    {
                                        ?>
                                        <li>
                                            <a style="display: inline !important;" href="<?php echo $link_for_location . '/' . $item['District']['districtlink'] . $query_string;;?>">
                                                <?php echo $item['District']['districttype'] .' ' . $item['District']['districtname'];?>
                                            </a>
                                            <small style="font-style: italic" class="project-count-4">(<?php echo $item[0]['sum'];?>)</small>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                        <?php
                    }
                    if(isset($districts))
                    {
                        ?>
                        <ul>
                            <li>
                                <ul style="display: block">
                                    <?php
                                    foreach ($districts as $item)
                                    {
                                        ?>
                                        <li>
                                            <a style="display: inline !important;" href="<?php echo $link_for_location . '/' . $item['Ward']['wardlink']  . $query_string;;?>">
                                                <?php echo $item['Ward']['wardtype'] .' ' . $item['Ward']['wardname'];?>
                                            </a>
                                            <small style="font-style: italic" class="project-count-4">(<?php echo $item[0]['sum'];?>)</small>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--            ADV-->
            <div class="hidden-xs" style="margin: 15px 0">
                <a href="http://dream.edu.vn" target="_blank">
                    <img src="/uploads/advertise/quang-cao-2.jpg" width="100%">
                </a>
            </div>
            <!--            ADV-->
            <!--            API product_new-->
            <link rel="stylesheet" type="text/css" href="http://thanhlycantho.com/api/api_product_new.css"/>
            <script type="text/javascript" src="http://thanhlycantho.com/api/api_product_new.js" async></script>
            <div class="hidden-xs" id="api-get-cdc-new">

            </div>
            <br>
            <!--            End API product_new-->
        </div>
        <div class="col-sm-9">
            <!--            Breadcrumbs-->
            <div class="breadcrumbs ace-save-state hidden" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><?php echo __('Home');?></a>
                    </li>
                    <?php
                    if($type == 'ban-')
                    {
                        ?>
                        <li><a href="/nha-dat-ban">Nhà đất bán</a></li>
                        <?php
                    }
                    else if($type == 'cho-thue-')
                    {
                        ?>
                        <li><a href="/nha-dat-cho-thue">Nhà đất cho thuê</a></li>
                        <?php
                    }
                    else
                    {
                        ?>
                        <li><a href="/nha-dat">Nhà đất</a></li>
                        <?php
                    }
                    ?>
                    <?php
                    if(isset($breadcrumb_group))
                    {
                        ?>
                        <li><?php echo $breadcrumb_group['Group']['groupname'];?></li>
                        <?php
                    }
                    if(isset($breadcrumb_category))
                    {
                        ?>
                        <li><a href="/<?php echo $breadcrumb_category['Group']['grouplink'];?>-g<?php echo $breadcrumb_category['Group']['id'];?>"><?php echo $breadcrumb_category['Group']['groupname'];?></a></li>
                        <li><?php echo $breadcrumb_category['Category']['categoryname'];?></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="hidden"><h2>Bất động sản mới</h2></div>
            <div class=" product-container">
                <?php
                include ('list_product.ctp');
                ?>
            </div>
            <!--            End paginate-->
        </div>
        <div class="col-sm-3 visible-xs" style="padding-top: 0 !important;">
            <div class="product-search-category">
                <div class="product-search-header">
                    <h3><?php echo __('Search by category');?></h3>
                </div>
                <div class="accordian accordian-search">
                    <ul>
                        <?php
                        $sum_group = count($categories_menu);
                        for($i = 0; $i < $sum_group; $i++)
                        {
                            ?>
                            <li>
                                <h4>
                                    <a class="<?php if(isset($breadcrumb_group) && $breadcrumb_group['Group']['id'] == $categories_menu[$i]['Group']['id']){ echo ' link-waring';}?>" href="/<?php echo $type?><?php echo $categories_menu[$i]['Group']['grouplink'];?>-g<?php echo $categories_menu[$i]['Group']['id'];?><?php echo $link_for_cat?><?php echo $query_string?>">
                                        <?php
                                        echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower($name_type . $categories_menu[$i]['Group']['groupname'])), 1);
                                        ?>
                                    </a>
                                    <i data-expand="1" class="fa fa-plus icon-plus-expand"></i>
                                </h4>
                                <ul <?php if(isset($breadcrumb_category) && $breadcrumb_category['Group']['id'] == $categories_menu[$i]['Group']['id']){ echo 'style="display: block !important;"';}?>>
                                    <?php
                                    $cat = $categories_menu[$i]['Category'];
                                    $sum_category = count($cat);
                                    for($j = 0; $j < $sum_category; $j++)
                                    {
                                        ?>
                                        <li>
                                            <a class="<?php if(isset($breadcrumb_category) && $breadcrumb_category['Category']['id'] == $cat[$j]['id']){ echo ' link-waring';}?>" href="/<?php echo $type?><?php echo $cat[$j]['categorylink'];?>-c<?php echo $cat[$j]['id'];?><?php echo $link_for_cat;?><?php echo $query_string;?>">
                                                <?php echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower($name_type . $cat[$j]['categoryname'])), 1);?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="accordian">
                    <div class="product-search-location">
                        <div class="product-search-header">
                            <h3>Tìm theo vị trí</h3>
                        </div>
                    </div>
                    <!--                        //Breadcrumd-->
                    <ul>
                        <?php
                        if(isset($breadcrumb_province))
                        {
                            ?>
                            <li>
                                <h4>
                                    <a href="<?php echo $link_for_location . $query_string;?>">
                                        <?php echo $breadcrumb_province['Province']['provincename'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>
                                </h4>
                            </li>
                            <?php
                        }
                        if(isset($breadcrumb_district))
                        {
                            ?>
                            <li>
                                <h4>
                                    <a href="<?php echo $link_for_location . $query_string;?>">
                                        <?php echo $breadcrumb_district['Province']['provincename'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="<?php echo $link_for_location . '/' . $breadcrumb_district['Province']['provincelink'] . $query_string;?>">
                                        <?php echo $breadcrumb_district['District']['districttype'] . ' ' . $breadcrumb_district['District']['districtname'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>
                                </h4>
                            </li>
                            <?php
                        }
                        if(isset($breadcrumb_ward))
                        {
                            ?>
                            <li>
                                <h4>
                                    <a href="<?php echo $link_for_location . $query_string;?>">
                                        <?php echo $breadcrumb_ward['Province']['provincename'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="<?php echo $link_for_location . '/' . $breadcrumb_ward['Province']['provincelink'] . $query_string;?>">
                                        <?php echo $breadcrumb_ward['District']['districttype'] . ' ' . $breadcrumb_ward['District']['districtname'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="<?php echo $link_for_location . '/' . $breadcrumb_ward['District']['districtlink'] . $query_string;?>">
                                        <?php echo $breadcrumb_ward['Ward']['wardtype'] . ' ' . $breadcrumb_ward['Ward']['wardname'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>
                                </h4>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                    if(isset($provinces_all))
                    {
                        ?>
                        <ul>
                            <?php
                            foreach ($provinces_all as $item)
                            {
                                ?>
                                <li>
                                    <h4>
                                        <a href="<?php echo $link_for_location . '/' . $item['Province']['provincelink']  . $query_string;;?>">
                                            <?php echo $item['Province']['provincename']?>
                                        </a>
                                        <small style="font-style: italic" class="project-count-4">(<?php echo $item[0]['sum'];?>)</small>
                                    </h4>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    if(isset($provinces))
                    {
                        ?>
                        <ul>
                            <li>
                                <ul style="display: block;">
                                    <?php
                                    foreach ($provinces as $item)
                                    {
                                        ?>
                                        <li>
                                            <a style="display: inline !important;" href="<?php echo $link_for_location . '/' . $item['District']['districtlink'] . $query_string;;?>">
                                                <?php echo $item['District']['districttype'] .' ' . $item['District']['districtname'];?>
                                            </a>
                                            <small style="font-style: italic" class="project-count-4">(<?php echo $item[0]['sum'];?>)</small>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                        <?php
                    }
                    if(isset($districts))
                    {
                        ?>
                        <ul>
                            <li>
                                <ul style="display: block">
                                    <?php
                                    foreach ($districts as $item)
                                    {
                                        ?>
                                        <li>
                                            <a style="display: inline !important;" href="<?php echo $link_for_location . '/' . $item['Ward']['wardlink']  . $query_string;;?>">
                                                <?php echo $item['Ward']['wardtype'] .' ' . $item['Ward']['wardname'];?>
                                            </a>
                                            <small style="font-style: italic" class="project-count-4">(<?php echo $item[0]['sum'];?>)</small>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--            ADV-->
            <div class="" style="margin: 15px 0">
                <a href="http://dream.edu.vn" target="_blank">
                    <img src="/uploads/advertise/quang-cao-2.jpg" width="100%">
                </a>
            </div>
            <!--            ADV-->

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".accordian-search h4").click(function(){
            $(".accordian-search ul ul").slideUp();
            if(!$(this).next().is(":visible"))
            {
                $(this).next().slideDown();
            }
        });
        $('.phone-number').on('click', function(){
            var phone = $(this).data('phonenumber');
            $(this).html(phone)
        });

        $('#province, #district, #ward, #category, #price, #acreage, #direction, #floor_number, #room_number').select2({
            minimumResultsForSearch: -1
        });
        $('#province').change(function () {
            var province_id = $('#province').val();
            if(province_id != '')
            {
                $.ajax({
                    'url': '/districts/get_district_link',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'province_id': province_id
                    },
                    beforeSend: function(){
                        $('#district').html('<option disabled selected>Đang tải</option>').select2({minimumResultsForSearch: -1});
                        $('#ward').html('<option value=""> -- Phường xã -- </option>').select2({minimumResultsForSearch: -1});
                    },
                    success: function(string)
                    {
                        $('#district').html(string).select2({minimumResultsForSearch: -1});
                    }
                });
            }
        });
        $('#district').change(function () {
            var district_id = $('#district').val();
            if(district_id != '')
            {
                $.ajax({
                    'url': '/wards/get_ward_link',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'district_id': district_id
                    },
                    beforeSend: function(){
                        $('#ward').html('<option disabled selected>Đang tải</option>').select2({minimumResultsForSearch: -1});
                    },
                    success: function(string)
                    {
                        $('#ward').html(string).select2({minimumResultsForSearch: -1});
                    }
                });
            }
        });
        $('.btn-choose-type').click(function () {
            $('.btn-choose-type').removeClass('active');
            $(this).addClass('active');
            var type = $(this).data('type');
            $('#type').val($.trim(type));
        });
        $('.rdoType').click(function () {
            var type = $(this).val();
            $('#type').val(type);
        });
        $('#btnSearchPrimary').click(function () {
            var here = '';
            var type = $('#type').val();
            if(type == 'ban')
            {
                here = '/nha-dat-ban';
            }
            if(type == 'cho-thue')
            {
                here = '/nha-dat-cho-thue';
            }
            if(type == 'can-mua')
            {
                here = '/can-mua-nha-dat';
            }
            if(type == 'can-thue')
            {
                here = '/can-thue-nha-dat';
            }
            var category = $('#category').val();
            if(category != '')
            {
                if(type == 'ban')
                {
                    here = '/ban-' + category;
                }
                if(type == 'cho-thue')
                {
                    here = '/cho-thue-' + category;
                }
                if(type == 'can-mua')
                {
                    here = '/can-mua-'+ category;
                }
                if(type == 'can-thue')
                {
                    here = '/can-thue-' + category;
                }
            }
            //Price
            var query_string = '?search=';
            var price = $('#price').val();
            var acreage = $('#acreage').val();
            var direction = $('#direction').val();
            var floor_number = $('#floor_number').val();
            var room_number = $('#room_number').val();
            var window_location = '';
            query_string = query_string + '&price=' + price + '&acreage=' + acreage + '&direction=' + direction + '&floor_number=' + floor_number + '&room_number=' + room_number;

            var ward_link = $('#ward').val();
            if(ward_link != '')
            {
                window_location = here + '/' + ward_link;
            }
            else
            {
                var district_link = $('#district').val();
                if(district_link != '')
                {
                    window_location = here + '/' + district_link;
                }
                else
                {
                    var province_link = $('#province').val();
                    if(province_link != '')
                    {
                        window_location = here + '/' + province_link;
                    }
                    else
                    {
                        window_location = here;
                    }
                }
            }
            window.location = window_location + query_string;
        });
        $('.btn-hide-search').click(function(){
            $('.search-primary').toggle();
            $(this).toggleClass('fa-angle-right fa-angle-down');
        });
    })
</script>