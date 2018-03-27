<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <!--            Breadcrumbs-->
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><?php echo __('Home');?></a>
                    </li>
                    <li><a href="/du-an">Dự án</a> </li>
                    <li>Dự án vip </li>
                </ul>
            </div>
            <br>
            <!--            End Breadcrumbs-->
        </div>
        <!--        Left-->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xs-12">
                    <h3>DỰ ÁN VIP</h3>
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
                        <div style="
                            background: url('/uploads/projects/<?php echo $projects[$i]['Project']['image'];?>');
                            background-size: cover;
                            background-position: center center;
                            height: 230px">
                        </div>
                        <div>
                            <h4>
                                <small>
                                    <a class="project-title" href="/du-an-vip/<?php echo $projects[$i]['Projectcat']['project_category_link'] . '-' . $projects[$i]['Projectcat']['id'];?>/<?php echo $projects[$i]['Project']['projectlink'];?>-<?php echo $projects[$i]['Project']['id'];?>">
                                        <?php echo $projects[$i]['Project']['title'];?>
                                    </a>
                                    <br>
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
        </div>

    </div>
</div>
