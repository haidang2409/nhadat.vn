<?php

class Group extends AppModel
{
    public $useTable = 'groupsproducts';
    public $hasMany = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'groupproduct_id'
        ),
    );

    public $validate = array(
        'groupname' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Tên nhóm không được để trống'
            ),
            'between' => array(
                'rule' => array('between', 5, 50),
                'message' => 'Tên nhóm từ 5 đến 50 ký tự'
            )
        ),
        'grouplink' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Link không được để trống'
            ),
            'pattern' => array(
                'rule'      => '/^[0-9a-z-]+$/',
                'message'   => 'Link không có khoảng trắng',
            ),
        ),
    );
}