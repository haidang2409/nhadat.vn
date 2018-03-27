<?php
class Project extends AppModel
{

    public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'project_id'
        )
    );
    public $belongsTo = array(
        'Projectcat' => array(
            'className' => 'Projectcat',
            'foreignKey' => 'projetc_category_id'
        ),
        'District' => array(
            'className' => 'District',
            'foreignKey' => 'district_id'
        )
    );

    public $validate = array(
        'project_category_id' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Chọn nhóm dự án'
            )
        ),
        'province' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Chọn tỉnh thành'
            )
        ),
        'district_id' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Chọn quận huyện'
            )
        ),
        'title' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tiêu đề dự án không được để trống'
            ),
            'between' => array(
                'rule' => array('between', 10, 200),
                'message' => 'Tiêu đề dự án từ %d đến %d ký tự'
            ),
        ),
        'summary' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tóm tắt dự án không được để trống'
            ),
            'between' => array(
                'rule' => array('between', 50, 1000),
                'message' => 'Tóm tắt dự án từ %d đến %d ký tự'
            ),
        ),
        'description' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Mô tả dự án không được để trống'
            ),
        ),
        'image' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Hình ảnh đại diện không được để trống'
            )
        )
    );
}