<?php
class Post extends AppModel
{
    public $belongsTo = array(
        'Postcat' => array(
            'className' => 'Postcat',
            'foreignKey' => 'post_category_id'
        ),
        'Staff' => array(
            'className' => 'Staff',
            'foreignKey' => 'staff_id'
        )
    );
    public $validate = array(
        'title' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tiêu đề không được để trống'
            ),
            'between' => array(
                'rule' => array('between', 20, 255),
                'message' => 'Tiêu đề từ %d đến %d ký tự'
            )
        ),
        'post_category_id' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Chọn chuyên mục bài viết'
            )
        ),
        'summary' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tóm tắt không được để trống'
            ),
            'between' => array(
                'rule' => array('between', 50, 500),
                'message' => 'Tóm tắt bài viết từ %d đến %d ký tự'
            )
        ),
        'description' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Nội dung bài viết không được để trống'
            ),
            'between' => array(
                'rule' => array('between', 50, 1000000),
                'message' => 'Nội dung bài viết từ %d đến %d ký tự'
            )
        ),

    );

}
