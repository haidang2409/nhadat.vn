<?php
/**
 * Created by PhpStorm.
 * User: nhdang
 * Date: 6/17/2017
 * Time: 1:16 PM
 */
class Ward extends AppModel
{
    public $hasMany = array(
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'ward_id',
        ),
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'ward_id'
        ),
        'Staff' => array(
            'className' => 'Staff',
            'foreignKey' => 'ward_id'
        )
    );
    public $belongsTo = array(
        'District' => array(
            'className' => 'District',
            'foreignKey' => 'district_id'
        )
    );

    //Validate
    public $validate = array(
        'wardname' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tên phường xã không được trống'
            ),
            'between' => array(
                'rule' => array('between', 1, 50),
                'message' => 'Tên phường xã từ %d đến %d ký tự'
            ),
        ),

        'province' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tỉnh thành không được trống'
            ),
        ),
        'district_id' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Quận huyện không được trống'
            ),
        ),
        'longitude' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Kinh độ không được để trống'
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Nhập đúng kinh độ'
            ),
            'more_than' => array(
                'rule' => array('comparison', '>=', 100),
                'message' => 'Nhập đúng tọa độ của tỉnh thành'
            ),
            'less_than' => array(
                'rule' => array('comparison', '<=', 120),
                'message' => 'Nhập đúng tọa độ của tỉnh thành'
            ),
        ),
        'latitude' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Vỹ độ không được để trống'
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Nhập đúng vỹ độ'
            ),
            'more_than' => array(
                'rule' => array('comparison', '>=', 8),
                'message' => 'Nhập đúng tọa độ của tỉnh thành'
            ),
            'less_than' => array(
                'rule' => array('comparison', '<=', 30),
                'message' => 'Nhập đúng tọa độ của tỉnh thành'
            ),
        )
    );
}