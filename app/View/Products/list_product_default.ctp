<div class="div-label-search">
    <?php
    $remove_all = '/nha-dat';
    $link_remove_group_or_cat = '/nha-dat' . $link_for_cat . $query_string;
    if($this->params['controller'] == 'products' && $this->params['action'] == 'index_can_mua_can_thue')
    {
        $link_remove_group_or_cat = '/can-mua-can-thue' . $link_for_cat . $query_string;
        $remove_all = '/can-mua-can-thue';
    }
    if($type == 'ban-')
    {
        $link_remove_group_or_cat = '/nha-dat-ban' . $link_for_cat . $query_string;
        $remove_all = '/nha-dat-ban';
    }
    if($type == 'cho-thue-')
    {
        $link_remove_group_or_cat = '/nha-dat-cho-thue' . $link_for_cat . $query_string;
        $remove_all = '/nha-dat-cho-thue';
    }
    if($type == 'can-mua-')
    {
        $link_remove_group_or_cat = '/can-mua-nha-dat' . $link_for_cat . $query_string;
        $remove_all = '/can-mua-nha-dat';
    }
    if($type == 'can-thue-')
    {
        $link_remove_group_or_cat = '/can-thue-nha-dat' . $link_for_cat . $query_string;
        $remove_all = '/can-thue-nha-dat';
    }
    //Group
    if(isset($breadcrumb_group))
    {
        ?>
        <span>
            <a href="<?php echo $link_remove_group_or_cat;?>">
                <?php echo $breadcrumb_group['Group']['groupname'];?>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    //Category
    if(isset($breadcrumb_category))
    {
        ?>
        <span>
            <a href="<?php echo $link_remove_group_or_cat;?>">
                <?php echo $breadcrumb_category['Category']['categoryname'];?>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    //Province
    if(isset($breadcrumb_province))
    {
        ?>
        <span>
            <a href="<?php echo $link_for_location . $query_string;?>">
                <?php echo $breadcrumb_province['Province']['provincename'];?>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    //District
    if(isset($breadcrumb_district))
    {
        ?>
        <span>
            <a href="<?php echo $link_for_location . $query_string;?>">
                <?php echo $breadcrumb_district['Province']['provincename'];?>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <span>
            <a href="<?php echo $link_for_location . '/' . $breadcrumb_district['Province']['provincelink'] . $query_string;?>">
                <?php echo $breadcrumb_district['District']['districttype'];?>
                <?php echo $breadcrumb_district['District']['districtname'];?>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    //Ward
    if(isset($breadcrumb_ward))
    {
        ?>
        <span>
            <a href="<?php echo $link_for_location . $query_string;?>">
                <?php echo $breadcrumb_ward['Province']['provincename'];?>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <span>
            <a href="<?php echo $link_for_location . '/' . $breadcrumb_ward['Province']['provincelink'] . $query_string;?>">
                <?php echo $breadcrumb_ward['District']['districttype'];?>
                <?php echo $breadcrumb_ward['District']['districtname'];?>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <span>
            <a href="<?php echo $link_for_location . '/' . $breadcrumb_ward['District']['districtlink'] . $query_string?>">
                <?php echo $breadcrumb_ward['Ward']['wardtype'];?>
                <?php echo $breadcrumb_ward['Ward']['wardname'];?>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    //Keys
    if(isset($this->params['url']['search']) && $this->params['url']['search'] != '')
    {
        $href_remove = str_replace('search=' . urlencode($this->params['url']['search']), '', $_SERVER['REQUEST_URI']);
        ?>
        <span>
            <a href="<?php echo $href_remove;?>">
                <?php echo $this->params['url']['search'];?>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    //Giá
    if(isset($this->params['url']['price_min']) && $this->params['url']['price_min'] > 0 && isset($this->params['url']['price_max']) && $this->params['url']['price_max'] > 0)
    {
        $href_remove = str_replace('&price_min=' . $this->params['url']['price_min'], '', $_SERVER['REQUEST_URI']);
        $href_remove = str_replace('&price_max=' . $this->params['url']['price_max'], '',$href_remove);
        ?>
        <span>
            <a href="<?php echo $href_remove;?>">
                Từ
                <?php echo $this->Lib->format_price_non_decimal($this->params['url']['price_min']);?>
                -
                <?php echo $this->Lib->format_price_non_decimal($this->params['url']['price_max']);?>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    elseif (isset($this->params['url']['price_min']) && $this->params['url']['price_min'] > 0)
    {
        $href_remove = str_replace('&price_min=' . $this->params['url']['price_min'], '', $_SERVER['REQUEST_URI']);
        ?>
        <span>
            <a href="<?php echo $href_remove;?>">
                Từ
                <?php echo $this->Lib->format_price_non_decimal($this->params['url']['price_min']);?>
                <i class="fa fa-remove"> </i> </a></span>
        <?php
    }
    elseif (isset($this->params['url']['price_max']) && $this->params['url']['price_max'] > 0)
    {
        $href_remove = str_replace('&price_max=' . $this->params['url']['price_max'], '', $_SERVER['REQUEST_URI']);
        ?>
        <span>
            <a href="<?php echo $href_remove;?>">
                Đến
                <?php echo $this->Lib->format_price_non_decimal($this->params['url']['price_max']);?>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    //dien tich
    if(isset($this->params['url']['acreage_min']) && $this->params['url']['acreage_min'] > 0 && isset($this->params['url']['acreage_max']) && $this->params['url']['acreage_max'] > 0)
    {
        $href_remove = str_replace('&acreage_min=' . $this->params['url']['acreage_min'], '', $_SERVER['REQUEST_URI']);
        $href_remove = str_replace('&acreage_max=' . $this->params['url']['acreage_max'], '',$href_remove);
        ?>
        <span>
            <a href="<?php echo $href_remove;?>">
                Từ
                <?php echo number_format($this->params['url']['acreage_min'], 0, '', '.');?>
                -
                <?php echo number_format($this->params['url']['acreage_max'], 0, '', '.');?>m<sup>2</sup>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    elseif (isset($this->params['url']['acreage_min']) && $this->params['url']['acreage_min'] > 0)
    {
        $href_remove = str_replace('&acreage_min=' . $this->params['url']['acreage_min'], '', $_SERVER['REQUEST_URI']);
        ?>
        <span>
            <a href="<?php echo $href_remove;?>">
                Từ
                <?php echo number_format($this->params['url']['acreage_min'], 0, '', '.');?>m<sup>2</sup>
                <i class="fa fa-remove"> </i> </a></span>
        <?php
    }
    elseif (isset($this->params['url']['acreage_max']) && $this->params['url']['acreage_max'] > 0)
    {
        $href_remove = str_replace('&acreage_max=' . $this->params['url']['acreage_max'], '', $_SERVER['REQUEST_URI']);
        ?>
        <span>
            <a href="<?php echo $href_remove;?>">
                Đến
                <?php echo number_format($this->params['url']['acreage_max'], 0, '', '.');?>m<sup>2</sup>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    //Số tầng
    if(isset($this->params['url']['floornumber']) && $this->params['url']['floornumber'] > 0)
    {
        $href_remove = str_replace('&floornumber=' . $this->params['url']['floornumber'], '', $_SERVER['REQUEST_URI']);
        ?>
        <span>
            <a href="<?php echo $href_remove;?>">
                <?php echo $this->params['url']['floornumber'];?> tầng
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    //Phòng ngủ
    if(isset($this->params['url']['roomnumber']) && $this->params['url']['roomnumber'] > 0)
    {
        $href_remove = str_replace('&roomnumber=' . $this->params['url']['roomnumber'], '', $_SERVER['REQUEST_URI']);
        ?>
        <span>
            <a href="<?php echo $href_remove;?>">
                <?php echo $this->params['url']['roomnumber'];?> phòng ngủ
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    //hướng
    if(isset($this->params['url']['direction']) && $this->params['url']['direction'] > 0)
    {
        $href_remove = str_replace('&direction=' . $this->params['url']['direction'], '', $_SERVER['REQUEST_URI']);
        ?>
        <span>
            <a href="<?php echo $href_remove;?>">
                Hướng <?php echo $directions[$this->params['url']['direction']];?>
                <i class="fa fa-remove"> </i>
            </a>
        </span>
        <?php
    }
    ?>
<!--    Remove all-->
</div>
<br>
<!--            End Breadcrumbs-->
<?php
$sum_product = count($products);
if($sum_product > 0)
{
    for($i = 0; $i < $sum_product; $i++)
    {
//                    ADV
        if($i == 3)
        {
            ?>
            <div class="row" style="margin-top: 10px; margin-bottom: 10px">
                <div class="col-md-12">
                    <img src="/uploads/advertise/quang-cao-ngang-1.jpg" width="100%">
                </div>
            </div>
            <?php
        }
//                    End ADV

        $item = $products[$i];
        ?>
        <div class="list-product-bg-hover-<?php echo $item['Packet']['id'];?>">
            <div class="row list-style-<?php echo $item['Packet']['id']; if($item['Product']['red_title'] == 1) { echo ' red-title';}?>">
                <div class="col-sm-3 col-xs-5 product-list-image">
                    <a href="/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                        <?php
                        $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/no-image-product.png';
                        if($item['Product']['image'] && ($item['Packet']['id'] == 1 || $item['Packet']['id'] == 2))
                        {
                            $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/thumb/'.$item['Product']['image'];
                        }
                        ?>
                        <div class=""
                             style="height: 150px;background-image: url('<?php echo $imglink;?>'); background-repeat: no-repeat; background-position: center center; background-size: cover">
                            <?php
                            if($item['Packet']['id'] == 1)
                            {
                                ?>
                                <div class="label-top1-icon">
                                    NỔI BẬT
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </a>
                </div>
                <div class="col-sm-9 col-xs-7 product-list-summary">
                    <hr>
                    <h4>
                        <a href="/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                            <?php
                            echo htmlentities($item['Product']['title'], ENT_QUOTES, 'UTF-8');
                            ?>
                        </a>
                    </h4>
                    <div class="visible-xs text-center">
                        <span class="price">
                            <?php if($item['Product']['price'] == 0):?>
                                Giá thỏa thuận
                            <?php elseif ($item['Product']['price'] > 0 && $item['Product']['price2'] > $item['Product']['price']): ?>
                                <i class="fa fa-dollar"></i>
                                <?php echo 'Giá ' . $this->Lib->format_price_onlynumber($item['Product']['price']) . ' - ' . $this->Lib->format_price($item['Product']['price2']);?>
                            <?php else:?>
                                <i class="fa fa-dollar"></i>
                                <?php echo $this->Lib->format_price($item['Product']['price']);?>
                            <?php endif ?>
                                <br>
                                <!--                                    Acreage-->
                            <i class="fa fa-book"></i>
                            <?php if ($item['Product']['acreage'] > 0 && $item['Product']['acreage2'] > $item['Product']['acreage']): ?>
                                <?php echo number_format($item['Product']['acreage'], 0, '', '.') . ' - ' . number_format($item['Product']['acreage2'], 0, '', '.');?>m<sup>2</sup>
                            <?php else:?>
                                <?php echo number_format($item['Product']['acreage'], 0, '', '.');?>m<sup>2</sup>
                            <?php endif ?>
                        </span>
                    </div>
                    <div class="hidden-xs">
                        <span class="price">
                            <?php if($item['Product']['price'] == 0):?>
                                Giá thỏa thuận
                            <?php elseif ($item['Product']['price'] > 0 && $item['Product']['price2'] > $item['Product']['price']): ?>
                                <i class="fa fa-dollar"></i>
                                <?php echo 'Giá ' . $this->Lib->format_price_onlynumber($item['Product']['price']) . ' - ' . $this->Lib->format_price($item['Product']['price2']);?>
                            <?php else:?>
                                <i class="fa fa-dollar"></i>
                                <?php echo $this->Lib->format_price($item['Product']['price']);?>
                            <?php endif ?>
                            <!--                                    Acreage-->
                            - <i class="fa fa-book"></i>
                            <?php if ($item['Product']['acreage'] > 0 && $item['Product']['acreage2'] > $item['Product']['acreage']): ?>
                                <?php echo number_format($item['Product']['acreage'], 0, '', '.') . ' - ' . number_format($item['Product']['acreage2'], 0, '', '.');?>m<sup>2</sup>
                            <?php else:?>
                                <?php echo number_format($item['Product']['acreage'], 0, '', '.');?>m<sup>2</sup>
                            <?php endif ?>
                        </span>
                        <div class="summary">
                            <?php
                            $summary = '';
                            if($item['Product']['summary'] != '')
                            {
                                $summary = $this->Lib->hidden_text($item['Product']['summary'], 200);
                            }
                            else
                            {
                                $summary = $this->Lib->hidden_text($item['Product']['description'], 200);
                            }
                            echo htmlentities($summary, ENT_QUOTES, 'UTF-8');
                            ?>
                        </div>
                        <span class="location">
                            <i class="fa fa-map-marker"> </i>
                            <?php echo htmlentities($item['Product']['address'], ENT_QUOTES, 'UTF-8');?>,
                            <?php echo $item['Ward']['wardtype'];?>
                            <?php echo $item['Ward']['wardname'];?>,
                            <?php echo $item['District']['districttype'];?>
                            <?php echo $item['District']['districtname'];?>,
                            <?php echo $item['Province']['provincename'];?>
                        </span>
                        <div class="row">
                            <div class="col-sm-8">
                                <span class="member">
                                    <img src="/img/members/<?php echo $item['Member']['image'];?>" width="25px" height="25px" class="img-circle">
                                    <?php echo $item['Product']['fullname'];?>
                                    <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                        <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $item['Product']['phonenumber'];?>">
                                            <a style="color: orangered" href="tel:<?php echo $item['Product']['phonenumber'];?>"><?php echo $this->Lib->hide_phonenumber($item['Product']['phonenumber']);?></a>
                                        </span>
                                    </span>
                                </span>
                            </div>
                            <div class="col-sm-4 text-right">
                            <span class="date">
                                <i class="fa fa-clock-o"> </i>
                                <?php echo $this->Lib->time_elapsed_string($item['Product']['date_paid']);?>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 visible-xs">
                    <div class="summary">
                        <?php
                        echo htmlentities($summary, ENT_QUOTES, 'UTF-8');
                        ?>
                    </div>
                    <span class="location">
                        <i class="fa fa-map-marker"> </i>
                        <?php echo htmlentities($item['Product']['address'], ENT_QUOTES, 'UTF-8');?>,
                        <?php echo $item['Ward']['wardtype'];?>
                        <?php echo $item['Ward']['wardname'];?>,
                        <?php echo $item['District']['districttype'];?>
                        <?php echo $item['District']['districtname'];?>,
                        <?php echo $item['Province']['provincename'];?>
                    </span>
                    <div class="row">
                        <div class="col-sm-8">
                            <span class="member">
                                <img src="/img/members/<?php echo $item['Member']['image'];?>" width="25px" height="25px" class="img-circle">
                                <?php echo $item['Product']['fullname'];?>
                                <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                    <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $item['Product']['phonenumber'];?>">
                                        <a style="color: orangered" href="tel:<?php echo $item['Product']['phonenumber'];?>"><?php echo $this->Lib->hide_phonenumber($item['Product']['phonenumber']);?></a>
                                    </span>
                                </span>
                            </span>
                        </div>
                        <div class="col-sm-4 text-right">
                            <span class="date">
                                <i class="fa fa-clock-o"> </i>
                                <?php echo $this->Lib->time_elapsed_string($item['Product']['date_paid']);?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
else
{
    ?>
    <div class="" style="margin: 10px 0 20px 0">
        <?php echo $this->Session->flash();?>
        Không có kết quả tìm kiếm
    </div>
    <?php
}
?>
<!--            Paginate-->
<?php if($this->params['paging']['Product']['pageCount'] > 1):?>
    <div class="pagination">
        <ul class="pagination">
            <?php
            //
            $here = $this->here;
            $len_here = strlen($here);
            $here = substr($here, 1, $len_here);
            $this->Paginator->options(array(
                'url'=> array(
                    'controller' => '/',
                    'action' => '/',
                    $here//nha-dat or /nha-dat-ban or /nha-dat-cho-thue
                )
            ));
            //set querystring
            $this->Paginator->options['url']['?'] = $this->params['url'];
            echo urldecode($this->Paginator->prev(__('<<'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')));
            echo urldecode($this->Paginator->numbers(
                array(
                    'separator' => '',
                    'currentTag' => 'a',
                    'currentClass' => 'active',
                    'tag' => 'li',
                    'ellipsis'=>'<li class="ellipsis"><a>...</a></li>',
                    'modulus' => 4,
                    'first' => 2,
                    'last' => 2
                )));
            echo urldecode($this->Paginator->next(__('>>'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')));
            ?>
        </ul>
    </div>
<?php endif;?>