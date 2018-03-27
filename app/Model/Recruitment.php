<?php

class Recruitment extends AppModel
{
    public $belongsTo = array(
        'Staff' => array(
            'className' => 'Staff',
            'foreign' => 'staff_id'
        ),
    );
    public $validate = array(
        'title' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tiêu đề không được để trống'
            ),
            'between' => array(
                'rule' => array('between', 10, 255),
                'message' => 'Tiêu đề phải từ %d đến %d ký tự'
            ),
        ),
        'content' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tiêu đề không được để trống'
            ),
            'between' => array(
                'rule' => array('between', 10, 50000),
                'message' => 'Tiêu đề phải từ %d đến %d ký tự'
            ),
        ),
    );
}