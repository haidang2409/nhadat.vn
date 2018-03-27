<?php
class Category extends AppModel
{
    
    public $useTable = 'categoriesproducts';
    public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'groupproduct_id'
        )
    );
    public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'categoryproduct_id'
        )
    );

    public $validate = array(
        'categoryname' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tên loại bất động sản không được để trống'
            ),
        ),
        'groupproduct_id' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Chọn nhóm'
            )
        ),
        'categorylink' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Nhập link cho loại bất động sản'
            ),
            'pattern' => array(
                'rule'      => '/^[0-9a-z-]+$/',
                'message'   => 'Link không có khoảng trắng',
            ),
        ),
    );
}