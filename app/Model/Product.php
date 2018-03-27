<?php

class Product extends AppModel
{
    public $belongsTo = array(
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id'
        ),
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'categoryproduct_id'
        ),
        'Ward' => array(
            'className' => 'Ward',
            'foreignKey' => 'ward_id'
        ),
        'Transactiontype' => array(
            'className' => 'Transactiontype',
            'foreignKey' => 'transactiontype_id'
        ),
        'Direction' => array(
            'className' => 'Direction',
            'foreignKey' => 'direction_id'
        ),
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'project_id'
        ),
        'Packet' => array(
            'className' => 'Packet',
            'foreignKey' => 'packet_id'
        )
    );
    public $hasMany = array(
        'Image' => array(
            'className' => 'Image',
            'foreignKey' => 'product_id'
        ),
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'product_id'
        ),
        'Memberproduct' => array(
            'className' => 'Memberproduct',
            'foreignKey' => 'product_id'
        ),
    );
    public $hasOne = array(
        'Environment' => array(
            'className' => 'Environment',
            'foreignKey' => 'product_id'
        ),
        'Utility' => array(
            'className' => 'Utility',
            'foreignKey' => 'product_id',
        ),
    );
    //Validation
    public $validate = array(
        'groupproduct' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Chọn nhóm bất động sản'
            )
        ),
        'categoryproduct_id' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Chọn'
            )
        ),
        'transactiontype_id' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Chọn hình thức giao dịch'
            )
        ),
        'ward_id' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Chọn vị trí xã phường bất động sản'
            )
        ),
        'province' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Chọn vị trí tỉnh thành bất động sản'
            )
        ),
        'district' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Chọn vị trí quận huyện bất động sản'
            )
        ),
//        s
        'title' => array(
            'notBalnk' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập tiêu đề cho tin đăng của bạn'
            ),
            'between' => array(
                'rule' => array('between', 5, 150),
                'message' => 'Tiêu đề tin đăng phải từ %d đến %d ký tự'
            )
        ),
        'description' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập mô tả chi tiết bất động sản của bạn'
            ),
            'between' => array(
                'rule' => array('between', 20, 4000),
                'message' => 'Mô tả bất động sản từ %d đến %d ký tụ'
            )
        ),
        'phonenumber' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập số điện thoại của bạn'
            ),
            'between' => array(
                'rule' => array('between', 10, 11),
                'message' => 'Vui lòng nhập đúng số điện thoại của bạn'
            )
        ),
        'price' => array(
//            'notBlank' => array(
//                'rule' => array('notBlank'),
//                'message' => 'Nhập giá của bất động sản'
//            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Vui lòng nhập đúng giá'
            )
        ),
        'price_min' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập giá của bất động sản'
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Vui lòng nhập đúng giá'
            )
        ),
        'price_max' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập giá của bất động sản'
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Vui lòng nhập đúng giá'
            ),
            'lessThanMyOtherField' => array(
                'rule' => array('comparisonWithField', '>', 'price_min'),
                'message' => 'Giá trị nhập vào không chính xác',
            ),
        ),
        'acreage' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập diện tích của bất động sản'
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Vui lòng nhập đúng diện tích'
            ),
        ),
        'acreage_min' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập diện tích của bất động sản'
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Vui lòng nhập đúng diện tích'
            ),
        ),
        'acreage_max' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập diện tích của bất động sản'
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Vui lòng nhập đúng diện tích'
            ),
            'lessThanMyOtherField' => array(
                'rule' => array('comparisonWithField', '>', 'acreage_min'),
                'message' => 'Giá trị nhập vào không chính xác',
            ),
        ),

    );
    //////////////////////////////////////////////////
    //////////////////////////////////////////////////
    //Function
    /* Custom validation function */
    public function comparisonWithField($validationFields = array(), $operator = null, $compareFieldName = '') {
        if (!isset($this->data[$this->name][$compareFieldName])) {
            throw new CakeException(sprintf(__('Can\'t compare to the non-existing field "%s" of model %s.'), $compareFieldName, $this->name));
        }
        $compareTo = $this->data[$this->name][$compareFieldName];
        foreach ($validationFields as $key => $value) {
            if (!Validation::comparison($value, $operator, $compareTo)) {
                return false;
            }
        }
        return true;
    }



}