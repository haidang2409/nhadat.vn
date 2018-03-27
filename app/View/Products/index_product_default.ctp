<?php
$price_min = isset($this->params['url']['price_min'])? $this->params['url']['price_min']: '';
$price_max = isset($this->params['url']['price_max'])? $this->params['url']['price_max']: '';
$acreage_min = isset($this->params['url']['acreage_min'])? $this->params['url']['acreage_min']: '';
$acreage_max = isset($this->params['url']['acreage_max'])? $this->params['url']['acreage_max']: '';
$direction = isset($this->params['url']['direction'])? $this->params['url']['direction']: '';
$floornumber = isset($this->params['url']['floornumber'])? $this->params['url']['floornumber']: '';
$roomnumber = isset($this->params['url']['roomnumber'])? $this->params['url']['roomnumber']: '';
$search = isset($this->params['url']['search'])? $this->params['url']['search']: '';
//
$province = isset($this->params['url']['province'])? $this->params['url']['province']: '';
$district = isset($this->params['url']['district'])? $this->params['url']['district']: '';
$ward = isset($this->params['url']['ward'])? $this->params['url']['ward']: '';
//Type (ban hoac cho thue
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
if($grouplink != '' && $groupid !='')
{
    $link_for_location = '/' . $type . $grouplink . '-' . $groupid;
}
if($categorylink != '' && $categoryid != '')
{
    $link_for_location = '/' . $type . $categorylink . '-' . $categoryid;
}
$query_string = $_SERVER['QUERY_STRING']!= ''? '?' . $_SERVER['QUERY_STRING']: '';
$query_string = preg_replace('/\?page=([0-9]+)/', '', $query_string);
$query_string = preg_replace('/\&page=([0-9]+)/', '', $query_string);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-9 product-container">
<!--            Breadcrumbs-->
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
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
            <?php
            include ('list_product.ctp');
            ?>
<!--            End paginate-->
        </div>
        <div class="col-sm-3" style="padding-top: 0 !important;">
            <form method="get" action="<?php echo $_SERVER['REQUEST_URI'];?>">
                <div class="product-search-category">
                    <div>
                        <div class="form-group has-feedback">
                            <input placeholder="<?php echo __('Search');?>" class="form-control" type="text" name="search" style="padding-left: 10px" value="<?php echo $search;?>">
                            <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="product-search-header product-search-header-first">
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
                <div class="product-search-price">
                    <div class="product-search-header">
                        <h3><?php echo __('Search by basic info');?></h3>
                    </div>
                    <table class="table-search-basic" style="width: 100%">
                        <tr>
                            <td style="width: 50%">
                                Tìm theo giá
                                <select name="price_min" id="price_min">
                                    <option value="">Min</option>
                                    <option <?php if($price_min == 50){ echo 'selected';}?> value="50">50 triệu</option>
                                    <option <?php if($price_min == 100){ echo 'selected';}?> value="100">100 triệu</option>
                                    <option <?php if($price_min == 500){ echo 'selected';}?> value="500">500 triệu</option>
                                    <option <?php if($price_min == 1000){ echo 'selected';}?> value="1000">1 tỷ</option>
                                    <option <?php if($price_min == 10000){ echo 'selected';}?> value="10000">10 tỷ</option>
                                    <option <?php if($price_min == 50000){ echo 'selected';}?> value="50000">50 tỷ</option>
                                    <option <?php if($price_min == 100000){ echo 'selected';}?> value="100000">100 tỷ</option>
                                </select>
                            </td>
                            <td style="width: 50%">
                                <select name="price_max" id="price_max">
                                    <option value="">Max</option>
                                    <option <?php if($price_max == 50){ echo 'selected';}?> value="50">50 triệu</option>
                                    <option <?php if($price_max == 100){ echo 'selected';}?> value="100">100 triệu</option>
                                    <option <?php if($price_max == 500){ echo 'selected';}?> value="500">500 triệu</option>
                                    <option <?php if($price_max == 1000){ echo 'selected';}?> value="1000">1 tỷ</option>
                                    <option <?php if($price_max == 10000){ echo 'selected';}?> value="10000">10 tỷ</option>
                                    <option <?php if($price_max == 50000){ echo 'selected';}?> value="50000">50 tỷ</option>
                                    <option <?php if($price_max == 100000){ echo 'selected';}?> value="100000">100 tỷ</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 50%;">
                                Tìm theo diện tích
                                <select name="acreage_min" id="acreage_min">
                                    <option value="">Min</option>
                                    <option <?php if($acreage_min == 10){ echo 'selected';}?> value="10">10 m2</option>
                                    <option <?php if($acreage_min == 50){ echo 'selected';}?> value="50">50 m2</option>
                                    <option <?php if($acreage_min == 100){ echo 'selected';}?> value="100">100 m2</option>
                                    <option <?php if($acreage_min == 200){ echo 'selected';}?> value="200">200 m2</option>
                                    <option <?php if($acreage_min == 500){ echo 'selected';}?> value="500">500 m2</option>
                                    <option <?php if($acreage_min == 1000){ echo 'selected';}?> value="1000">1.000 m2</option>
                                    <option <?php if($acreage_min == 5000){ echo 'selected';}?> value="5000">5.000 m2</option>
                                    <option <?php if($acreage_min == 10000){ echo 'selected';}?> value="10000">10.000 m2</option>
                                </select>
                            </td>
                            <td style="width: 50%">
                                <select name="acreage_max" id="acreage_max">
                                    <option value="">Max</option>
                                    <option <?php if($acreage_max == 10){ echo 'selected';}?> value="10">10 m2</option>
                                    <option <?php if($acreage_max == 50){ echo 'selected';}?> value="50">50 m2</option>
                                    <option <?php if($acreage_max == 100){ echo 'selected';}?> value="100">100 m2</option>
                                    <option <?php if($acreage_max == 200){ echo 'selected';}?> value="200">200 m2</option>
                                    <option <?php if($acreage_max == 500){ echo 'selected';}?> value="500">500 m2</option>
                                    <option <?php if($acreage_max == 1000){ echo 'selected';}?> value="1000">1.000 m2</option>
                                    <option <?php if($acreage_max == 5000){ echo 'selected';}?> value="5000">5.000 m2</option>
                                    <option <?php if($acreage_max == 10000){ echo 'selected';}?> value="10000">10.000 m2</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 0 0 10px 0 !important;">
                                Tìm theo hướng bất động sản
                                <?php echo $this->Form->input('direction', array('name' => 'direction', 'id' => 'direction', 'label' => false, 'class' => 'form-control', 'title' => 'Hướng bất động sản', 'options' => $directions, 'type' => 'select', 'empty' => ' -- Chọn hướng -- ', 'default' => $direction));?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Số tầng
                                <?php echo $this->Form->input('floornumber', array('name' => 'floornumber', 'id' => 'floornumber', 'label' => false, 'class' => 'form-control', 'title' => 'Số tầng', 'type' => 'text', 'placeholder' => 'Số tầng', 'value' => $floornumber));?>
                            </td>
                            <td>
                                Số phòng
                                <?php echo $this->Form->input('roomnumber', array('name' => 'roomnumber', 'id' => 'roomnumber', 'label' => false, 'class' => 'form-control', 'title' => 'Số phòng ngủ', 'type' => 'text', 'placeholder' => 'Số phòng ngủ', 'value' => $roomnumber));?>
                            </td>
                        </tr>
                    </table>
                    <div class="text-right">
                        <button class="btn btn-primary">Tìm <i class="fa fa-search"></i> </button>
                    </div>
                </div>
            </form>
<!--            ADV-->
            <div class="" style="margin: 15px 0">
                <a href="http://dream.edu.vn" target="_blank">
                    <img src="/uploads/advertise/quang-cao-2.jpg" width="100%">
                </a>
            </div>
<!--            ADV-->
<!--            Posts-->
            <div style="margin-top: 15px">
                <?php echo $this->Element('../Elements/posts_col_sm');?>
            </div>
<!--            End posts-->
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
        })
    })
</script>