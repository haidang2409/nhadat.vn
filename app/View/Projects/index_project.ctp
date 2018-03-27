<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <!--            Breadcrumbs-->
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><?php echo __('Home');?></a>
                    </li>
                    <li><a href="/du-an"><?php echo __('Dự án');?></a></li>
                    <li><a href="/du-an-bat-dong-san"><?php echo __('Dự án bất động sản');?></a></li>
                    <li>
                        <?php
                        if(isset($breakcrumb_category))
                        {
                            echo $breakcrumb_category['Projectcat']['project_category_name'];
                        }
                        ?>
                    </li>
                </ul>
            </div>
            <br>
            <!--            End Breadcrumbs-->
        </div>
        <!--        Right-->
        <div class="col-sm-9 col-sm-push-3">
            <!--            Du an moi-->
            <div class="row">
                <div class="col-xs-12">
                    <h3>DỰ ÁN MỚI</h3>
                </div>
            </div>
            <hr class="hr-double">
            <div class="">
                <?php
                echo $this->Session->flash();
                $sum_project_new = count($projects_new);
                for($i = 0; $i < $sum_project_new; $i++)
                {
                    ?>
                    <div class="row">
                        <div class="col-sm-3 col-xs-5" style="margin-bottom: 15px; padding-right: 5px !important;">
                            <div style="
                                    background: url('/uploads/projects/<?php echo $projects_new[$i]['Project']['image'];?>');
                                    background-size: cover;
                                    background-position: center center;
                                    height: 130px">
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-7" style="padding-left: 5px !important;">
                            <h4>
                                <small>
                                    <a style="font-size: 17px" class="project-title" href="/du-an/<?php echo $projects_new[$i]['Projectcat']['project_category_link'];?>-<?php echo $projects_new[$i]['Projectcat']['id'];?>/<?php echo $projects_new[$i]['Project']['projectlink'];?>-<?php echo $projects_new[$i]['Project']['id'];?>" title="<?php echo $projects_new[$i]['Project']['title'];?>">
                                        <?php echo $projects_new[$i]['Project']['title'];?>
                                    </a>
                                    <br>
                                    <?php echo $projects_new[$i]['Projectcat']['project_category_name'];?>
                                    <br>

                                </small>
                            </h4>
                            <div class="hidden-xs">
                                <?php echo $projects_new[$i]['Project']['summary'];?>
                            </div>
                            <i class="fa fa-map-marker"></i>
                            <?php echo $projects_new[$i]['District']['districtname'];?>,
                            <?php echo $projects_new[$i]['Province']['provincename'];?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!--            Pagination-->
            <?php if($this->params['paging']['Project']['pageCount'] > 1):?>
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
            <!--            End pagination-->
            <!--            Advertise-->
            <div style="margin-bottom: 15px">
                <?php
                if(isset($advertise))
                {
                    ?>
                    <img width="100%" src="/uploads/advertise/<?php echo $advertise[4]['Advertise']['image'];?>">
                    <?php
                }
                ?>
            </div>
            <!--            End advertise-->
        </div>
<!--        Left-->
        <div class="col-sm-3 col-sm-pull-9">
            <div class="">
                <div class="product-search-header product-search-header-first">
                    <h3><?php echo __('Tìm kiếm dự án');?></h3>
                </div>
                <div id="" class="accordian">
                    <ul style="margin-left: 0 !important;">
                        <li>
                            <h4>
                                <a href="/du-an-vip">Dự án VIP</a>
                                <small style="font-style: italic" class="project-count-vip"></small>
                            </h4>
                        </li>
                        <?php
                        $cat_id = isset($this->params['projectcat_id'])? $this->params['projectcat_id']: '';
                        $cat_link = isset($this->params['projectcat'])? $this->params['projectcat']: '';
                        $link_category_full = 'du-an-bat-dong-san';
                        //Xoa ky tu p truoc id
                        $province_id = isset($this->params['provinceid'])? substr($this->params['provinceid'], 1): '';
                        $district_id = isset($this->params['districtid'])? substr($this->params['districtid'], 1): '';
                        if($cat_id != '' && $cat_link != '')
                        {
                            $link_category_full = $cat_link . '-' . $cat_id;
                        }
                        for($i = 0; $i < count($project_cats); $i++)
                        {
                            ?>
                            <li>
                                <h4><a class="a-group <?php if($cat_id == $project_cats[$i]['Projectcat']['id'] && $cat_link == $project_cats[$i]['Projectcat']['project_category_link']) { echo 'link-waring';}?>" href="/du-an/<?php echo $project_cats[$i]['Projectcat']['project_category_link'];?>-<?php echo $project_cats[$i]['Projectcat']['id'];?>"><?php echo $project_cats[$i]['Projectcat']['project_category_name'];?> </a>
                                    <small style="font-style: italic" class="project-count-<?php echo $project_cats[$i]['Projectcat']['id'];?>"></small>
                                </h4>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
<!--                    ul tỉnh thanh-->
                    <div class="product-search-header product-search-header-first">
                        <h3><?php echo __('Vị trí dự án');?></h3>
                    </div>
                    <ul style="margin-left: 0 !important;">
                        <?php
                        //Breadcrumb
                        if(isset($breadcrumb_province))
                        {
                            ?>
                            <li>
                                <h4>
                                    <a href="/du-an-bat-dong-san">
                                        <?php echo $breadcrumb_province[0]['Province']['provincename'];?>
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
                                    <a href="/du-an-bat-dong-san">
                                        <?php echo $breadcrumb_district[0]['Province']['provincename'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>

                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="/du-an/du-an-bat-dong-san/<?php  echo $breadcrumb_district[0]['Province']['provincelink'];?>">
                                        <?php echo $breadcrumb_district[0]['District']['districtname'];?>
                                        <i class="fa fa-remove icon-plus-expand"></i>
                                    </a>

                                </h4>
                            </li>
                            <?php
                        }
                        //
                        if(isset($provinces))
                        {
                            foreach ($provinces as $item)
                            {
                                ?>
                                <li>
                                    <h4>
                                        <a href="/du-an/<?php echo $link_category_full;?>/<?php echo $item['Province']['provincelink'];?>" class="<?php if($province_id == $item['Province']['id']) { echo 'link-waring';}?>">
                                            <?php echo $item['Province']['provincename'];?>
                                        </a>
                                        <small style="font-style: italic">(<?php echo $item[0]['sum'];?> dự án)</small>
                                    </h4>
                                </li>
                                <?php
                            }
                        }
                        if(isset($districts))
                        {
                            ?>
                            <li>
                                <ul style="display: block">
                                <?php
                                foreach ($districts as $item)
                                {
                                    ?>
                                    <li>
                                        <a style="display: inline !important;" href="/du-an/<?php echo $link_category_full;?>/<?php echo $item['District']['districtlink'];?>" class="<?php if($district_id == $item['District']['id']) { echo 'link-waring';}?>">
                                            <?php echo $item['District']['districtname'];?>
                                        </a>
                                        <small style="font-style: italic;">(<?php echo $item[0]['sum'];?> dự án)</small>
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

                <!--                Advertise-->
                <div>
                    <?php
                    if(isset($advertise))
                    {
                        ?>
                        <img width="100%" src="/uploads/advertise/<?php echo $advertise[0]['Advertise']['image'];?>">
                        <?php
                    }
                    ?>
                </div>
                <!--                End advertise-->
            </div>
        </div>


    </div>
</div>
<script>
    $(function () {
        $.getJSON('/projects/get_count_project', function(data){
            var i = 0;
            for(i = 0; i< data.length; i++)
            {
                $('.project-count-' + data[i]['cat']).html('(' + data[i]['count'] + ' dự án)')
            }
        });
        $.getJSON('/projects/get_count_project_vip', function(data){
            $('.project-count-vip').html('(' + data[0]['count'] + ' dự án)')
        });
        $('#province').change(function () {
            var province_id = $('#province').val();
            if(province_id != '')
            {
                $.ajax({
                    url: '/districts/get_district',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        province_id: province_id
                    },
                    beforeSend: function(){
                        $('#district').html('<option>Đang tải</option>');
                    },
                    success: function(data)
                    {
                        $('#district').html(data);
                    }
                })
            }
        });
        $('#district').change(function () {
            var district_id = $('#district').val();
            if(district_id != '')
            {
                $.ajax({
                    url: '/wards/get_ward',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        district_id: district_id
                    },
                    beforeSend: function(){
                        $('#ward').html('<option>Đang tải</option>');
                    },
                    success: function(data)
                    {
                        $('#ward').html(data);
                    }
                })
            }
        })
    })
</script>