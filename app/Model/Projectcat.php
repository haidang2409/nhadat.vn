<?php
class Projectcat extends AppModel
{
    public $useTable = 'project_categories';
    public $hasMany = array(
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'project_category_id'
        )
    );

    public $validate = array(
        'project_category_name' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tên nhóm dự án không được để trống'
            ),
            'between' => array(
                'rule' => array('between', 5, 50),
                'message' => 'Tên nhóm dự án từ %d đến %d ký tự'
            )
        ),
        'project_category_link' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Nhập link nhóm dự án'
            ),
            'pattern' => array(
                'rule'      => '/^[0-9a-z-]+$/',
                'message'   => 'Link không có khoảng trắng',
            ),
        ),
    );
}