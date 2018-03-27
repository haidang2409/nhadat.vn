<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <!--            Breadcrumbs-->
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><?php echo __('Home');?></a>
                    </li>
                    <li>Dự án</li>
                </ul>
            </div>
            <br>
            <!--            End Breadcrumbs-->
        </div>
        <div class="col-sm-12">
            <div class="row">
                <!--        Right-->
                <div class="col-xs-12 col-sm-9 col-sm-push-3">
                    <div class="row">
                        <div class="col-xs-8">
                            <h3>DỰ ÁN VIP</h3>
                        </div>
                        <div class="col-xs-4 text-right" style="padding-top: 4px">
                            <a class="view-all" href="/du-an-vip">Xem thêm + </i> </a>
                        </div>
                    </div>
                    <hr class="hr-double">
                    <div class="row">
                        <?php
                        echo $this->Session->flash();
                        $sum_project = count($projects);
                        for($i = 0; $i < $sum_project; $i++)
                        {
                            ?>
                            <div class="col-sm-4" style="margin-bottom: 15px">
                                <a class="project-title" href="/du-an-vip/<?php echo $projects[$i]['Projectcat']['project_category_link'];?>-<?php echo $projects[$i]['Projectcat']['id'];?>/<?php echo $projects[$i]['Project']['projectlink'];?>-<?php echo $projects[$i]['Project']['id'];?>" title="<?php echo $projects[$i]['Project']['title'];?>">
                                    <div class="div-image-project" style="
                                            background: url('/uploads/projects/<?php echo $projects[$i]['Project']['image'];?>');
                                            background-size: cover;
                                            background-position: center center;
                                            height: 170px">
<!--                                        <div class="div-on-image-project">-->
<!--                                            <a class="btn btn-warning project-title" href="/du-an-vip/--><?php //echo $projects[$i]['Projectcat']['project_category_link'];?><!-----><?php //echo $projects[$i]['Projectcat']['id'];?><!--/--><?php //echo $projects[$i]['Project']['projectlink'];?><!-----><?php //echo $projects[$i]['Project']['id'];?><!--" title="--><?php //echo $projects[$i]['Project']['title'];?><!--">-->
<!--                                                XEM DỰ ÁN-->
<!--                                            </a>-->
<!--                                        </div>-->
                                    </div>
                                </a>
                                <div>
                                    <h4>
                                        <small>
                                            <a class="project-title" href="/du-an-vip/<?php echo $projects[$i]['Projectcat']['project_category_link'];?>-<?php echo $projects[$i]['Projectcat']['id'];?>/<?php echo $projects[$i]['Project']['projectlink'];?>-<?php echo $projects[$i]['Project']['id'];?>" title="<?php echo $projects[$i]['Project']['title'];?>">
                                                <?php echo $projects[$i]['Project']['title'];?>
                                            </a>
                                            <br>
                                            <i class="fa fa-angle-double-right"></i>
                                            <?php echo $projects[$i]['Projectcat']['project_category_name'];?>
                                            <br>
                                            <i class="fa fa-map-marker"></i>
                                            <?php echo $projects[$i]['District']['districttype'] . ' ' . $projects[$i]['District']['districtname'];?>,
                                            <?php echo $projects[$i]['Province']['provincename'];?>
                                        </small>
                                    </h4>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
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
                    <!--            Du an moi-->
                    <div class="row">
                        <div class="col-xs-8">
                            <h3>DỰ ÁN MỚI</h3>
                        </div>
                        <div class="col-xs-4 text-right" style="padding-top: 4px">
                            <a class="view-all" href="/du-an-bat-dong-san">Xem thêm + </i> </a>
                        </div>
                    </div>
                    <hr class="hr-double">
                    <div class="">
                        <?php
                        $sum_project_new = count($projects_new);
                        for($i = 0; $i < $sum_project_new; $i++)
                        {
                            ?>
                            <div class="row">
                                <div class="col-sm-3 col-xs-5" style="margin-bottom: 15px; padding-right: 5px !important;">
                                    <a style="font-size: 17px" class="project-title" href="/du-an/<?php echo $projects_new[$i]['Projectcat']['project_category_link'];?>-<?php echo $projects_new[$i]['Projectcat']['id'];?>/<?php echo $projects_new[$i]['Project']['projectlink'];?>-<?php echo $projects_new[$i]['Project']['id'];?>" title="<?php echo $projects_new[$i]['Project']['title'];?>">
                                        <div style="
                                                background: url('/uploads/projects/<?php echo $projects_new[$i]['Project']['image'];?>');
                                                background-size: cover;
                                                background-position: center center;
                                                height: 130px">
                                        </div>
                                    </a>
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
                </div>
                <!--        Left-->
                <div class="col-xs-12 col-sm-3 col-sm-pull-9">
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
                                for($i = 0; $i < count($project_cats); $i++)
                                {
                                    ?>
                                    <li>
                                        <h4>
                                            <a class="a-group" href="/du-an/<?php echo $project_cats[$i]['Projectcat']['project_category_link'];?>-<?php echo $project_cats[$i]['Projectcat']['id'];?>"><?php echo $project_cats[$i]['Projectcat']['project_category_name'];?> </a>
                                            <small style="font-style: italic" class="project-count-<?php echo $project_cats[$i]['Projectcat']['id'];?>"></small>
                                        </h4>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div>
                            <div class="product-search-header">
                                <h3><?php echo __('Tìm theo vị trí');?></h3>
                            </div>
                            <?php
                            $province_search = isset($this->params['url']['province'])? $this->params['url']['province']: '';
                            $district_search = isset($this->params['url']['district'])? $this->params['url']['district']: '';
                            ?>
                            <form method="get" action="<?php echo $_SERVER['REQUEST_URI'];?>">
                                <div style="margin-bottom: 15px">
                                    <?php echo $this->Form->input('province_smenu', array('name' => 'province', 'id' => 'province', 'label' => false, 'class' => 'form-control', 'title' => 'Tỉnh/Thành phố', 'options' => $provinces_link, 'type' => 'select', 'empty' => ' -- Tỉnh thành -- ', 'style' => 'width: 100 % !important;', 'default' => $province_search));?>
                                </div>
                                <div style="margin-bottom: 15px">
                                    <?php echo $this->Form->input('district_smenu', array('name' => 'district', 'id' => 'district', 'label' => false, 'class' => 'form-control', 'title' => 'Quận huyện', 'options' => null, 'type' => 'select', 'empty' => ' -- Quận huyện -- ', 'style' => 'width: 100 % !important;'));?>
                                </div>
                                <div class="text-right">
                                    <button type="button" id="btn-search-location" class="btn btn-info">Tìm <i class="fa fa-search"></i> </button>
                                </div>
                            </form>
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
                        <!--                Posts-->
                        <div style="margin-top: 15px">
                            <?php echo $this->Element('../Elements/posts_col_sm');?>
                        </div>
                        <!--                End Posts-->
                    </div>
                </div>
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
                    url: '/districts/get_district_link',
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
        $('#btn-search-location').click(function(){
            var province = $('#province').val();
            var district = $('#district').val();
            if(district != '')
            {
                window.location = '/du-an/du-an-bat-dong-san/' + district;
            }
            else
            {
                if(province != '')
                {
                    window.location = '/du-an/du-an-bat-dong-san/' + province;
                }
            }
        });
    })
</script>