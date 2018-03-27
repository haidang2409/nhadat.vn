<?php
class Direction extends AppModel
{
    public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'direction_id'
        )
    );
}