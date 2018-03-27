<?php
class Commentpost extends AppModel
{
    public $useTable = 'comment_posts';

    public $validate = array(
        'comment' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Không được để trống'
            ),
        )
    );
}