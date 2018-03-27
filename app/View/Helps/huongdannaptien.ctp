<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php
            include 'menu_help.ctp';
            ?>
        </div>
        <div class="col-md-9">
            <div style="font-size: 1.2em; color: #8C8C8C">
                <?php
                if(isset($helps))
                {
                    echo str_replace('app/webroot/', '', $helps['Help']['content']);
                }
                ?>
            </div>
        </div>
    </div>
</div>