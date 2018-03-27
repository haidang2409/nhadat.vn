<?php
include "header_project_detail.ctp";
    echo $this->fetch('content');
include "footer.ctp";
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery-ui.min');
echo $this->Html->script('ace.min');
include('script_all.ctp');
?>
</body>
</html>
