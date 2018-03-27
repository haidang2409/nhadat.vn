<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <?php
            include ('profile-menu.ctp');
            ?>
        </div>
        <div class="col-sm-9">
            <h2>Nạp thẻ cào</h2>
            <hr class="hr-double">
            <?php echo $this->Session->flash();?>
            <form class="form-horizontal form-bk" role="form" method="post" action="/members/recharge">
                <div class="form-group">
                    <label for="txtpin" class="col-sm-3 control-label">Loại thẻ</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="chonmang">
                            <option value="VIETEL">Viettel</option>
                            <option value="MOBI">Mobifone</option>
                            <option value="VINA">Vinaphone</option>
                            <option value="GATE">Gate</option>
                            <option value="VTC">VTC</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtpin" class="col-sm-3 control-label">Mã thẻ</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="txtpin" name="txtpin" placeholder="Mã thẻ" data-toggle="tooltip" data-title="Mã số sau lớp bạc mỏng"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtseri" class="col-sm-3 control-label">Số seri</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="txtseri" name="txtseri" placeholder="Số seri" data-toggle="tooltip" data-title="Mã seri nằm sau thẻ">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary" name="napthe">Nạp thẻ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".form-control").tooltip({ placement: 'right'});
    });
</script>