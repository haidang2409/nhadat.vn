<?php
include "header2.ctp";
    echo $this->fetch('content');
include "footer.ctp";
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery-ui.min');
echo $this->Html->script('ace.min');
echo $this->Html->script('select2.min');
echo $this->Html->script('wizard.min');
echo $this->Html->script('ace-elements.min');
echo $this->Html->script('bootbox');
echo $this->Html->script('mscript');
echo $this->Html->script('jquery.colorbox.min');
include('script_all.ctp');
?>
</body>
</html>
