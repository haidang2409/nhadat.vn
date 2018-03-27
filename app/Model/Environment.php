<?php
class Environment extends AppModel
{
    public $useTable = 'environments';
    public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id'
        )
    );
    public $validate = array(

    );
}