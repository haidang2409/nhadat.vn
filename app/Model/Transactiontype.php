<?php
class Transactiontype extends AppModel
{
    public $useTable = 'transactiontypes';
    public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'transactiontype_id'
        )
    );
}