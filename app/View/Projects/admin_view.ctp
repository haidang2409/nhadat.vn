
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li><a href="/admin/projects">Dự án</a></li>
                <li>Thông tin dự án</li>
            </ul><!-- /.breadcrumb -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>
                            <?php
                            echo $projects['Project']['title'];
                            ?>
                            <br>
                            <small>
                                <?php
                                if($projects['Project']['vipproject'] == 1)
                                {
                                    ?>
                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                    Dự án vip
                                    <?php
                                }
                                ?>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                <?php
                                echo $projects['Projectcat']['project_category_name'];
                                ?>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                <?php
                                echo $projects['District']['districtname'];
                                ?>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                <?php
                                echo $projects['Province']['provincename'];
                                ?>
                            </small>
                        </h1>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <div style="font-weight: bold; padding: 0px 0">
                        <?php
                        echo $projects['Project']['summary'];
                        ?>
                    </div>
                    <div style="overflow-x: hidden !important;">
                        <?php
                        echo $projects['Project']['description'];
                        ?>
                     </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

