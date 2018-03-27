<?php
class CommentpostsController extends AppController
{
    public $components = array('Library');

    //////////////
    //////////////
    //User
    //////////////
    //////////////
    function send_post()
    {
        $this->autoRender = false;
        if($this->Session->check('Member'))
        {
            if($this->request->is('post') || $this->request->is('put'))
            {
                $comment = $this->request->data['comment'];
                $member_id = $this->Session->read('Member.id');
                $post_id = $this->request->data['post_id'];
                $this->Commentpost->set('member_id', $member_id);
                $this->Commentpost->set('post_id', $post_id);
                $this->Commentpost->set('comment', $comment);
                if($this->Commentpost->save())
                {
                    ClassRegistry::init('Member')->recursive = -1;
                    $member = ClassRegistry::init('Member')->find('first', array(
                        'joins' => array(
                            array(
                                'table' => 'profiles',
                                'alias' => 'Profile',
                                'type' => 'INNER',
                                'foreignKey' => false,
                                'conditions' => 'Member.id = Profile.member_id'
                            )
                        ),
                        'fields' => array('Member.fullname', 'Member.image', 'Profile.admin'),
                        'conditions' => array('Member.id' => $member_id)
                    ));
                    $this->Commentpost->recursive = -1;
                    $commentpost = $this->Commentpost->findById($this->Commentpost->id);
                    $data = array(
                        'status' => 'success',
                        'comment' => nl2br(htmlentities($commentpost['Commentpost']['comment'], ENT_QUOTES, 'UTF-8')),
                        'comment_id' => $commentpost['Commentpost']['id'],
                        'created' => $this->Library->time_elapsed_string($commentpost['Commentpost']['created']),
                        'fullname' => $member['Member']['fullname'],
                        'image' => $member['Member']['image'],
                        'admin' => $member['Profile']['admin'],

                    );
                    echo json_encode($data);
                }
                else
                {
                    echo json_encode(array('status' => 'fail'));
                }
            }
        }
        else
        {
            echo json_encode(array('status' => 'notSession'));
        }
    }
    function get_comment()
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            $limit = 5;
            $page = isset($this->request->data['page'])? $this->request->data['page']: 1;
            $post_id = $this->request->data['post_id'];
            $this->Commentpost->recursive = -1;
            $sum_remain = $this->Commentpost->find('all', array(
                'joins' => array(
                    array(
                        'table' => 'members',
                        'alias' => 'Member',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Commentpost.member_id = Member.id'
                    ),
                    array(
                        'table' => 'profiles',
                        'alias' => 'Profile',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Member.id = Profile.member_id'
                    ),
                ),
                'fields' => array('Commentpost.id'),
                'conditions' => array('Commentpost.post_id' => $post_id),
                'limit' => $limit,
                'page' => ($page + 1)
            ));
            $this->Commentpost->recursive = -1;
            $commentposts = $this->Commentpost->find('all', array(
                'joins' => array(
                    array(
                        'table' => 'members',
                        'alias' => 'Member',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Commentpost.member_id = Member.id'
                    ),
                    array(
                        'table' => 'profiles',
                        'alias' => 'Profile',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Member.id = Profile.member_id'
                    ),
                ),
                'fields' => array(
                    'Member.fullname',
                    'Member.image',
                    'Profile.admin',
                    'Commentpost.id',
                    'Commentpost.comment',
                    'Commentpost.created',
                    'Commentpost.like',
                ),
                'conditions' => array('Commentpost.post_id' => $post_id),
                'order' => array('Commentpost.id' => 'DESC'),
                'limit' => $limit,
                'page' => $page
            ));
            $data = null;
            $i = 0;
            foreach ($commentposts as $item)
            {
                //Get reply
                ClassRegistry::init('Commentpostreply')->recursive = -1;
                $sum_remain_reply = ClassRegistry::init('Commentpostreply')->find('all', array(
                    'joins' => array(
                        array(
                            'table' => 'members',
                            'alias' => 'Member',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => 'Commentpostreply.member_id = Member.id'
                        ),
                        array(
                            'table' => 'profiles',
                            'alias' => 'Profile',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => 'Member.id = Profile.member_id'
                        )
                    ),
                    'order' => array('Commentpostreply.id' => 'DESC'),
                    'fields' => array('Commentpostreply.id'),
                    'conditions' => array(
                        'Commentpostreply.comment_post_id' => $item['Commentpost']['id']
                    ),
                    'limit' => 2,
                    'page' => 2,
                ));
                ClassRegistry::init('Commentpostreply')->recursive = -1;
                $replys = ClassRegistry::init('Commentpostreply')->find('all', array(
                    'joins' => array(
                        array(
                            'table' => 'members',
                            'alias' => 'Member',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => 'Commentpostreply.member_id = Member.id'
                        ),
                        array(
                            'table' => 'profiles',
                            'alias' => 'Profile',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => 'Member.id = Profile.member_id'
                        )
                    ),
                    'order' => array('Commentpostreply.id' => 'DESC'),
                    'fields' => array(
                        'Member.fullname',
                        'Member.image',
                        'Profile.admin',
                        'Commentpostreply.reply',
                        'Commentpostreply.created',
                        'Commentpostreply.like',
                        'Commentpostreply.id'
                    ),
                    'conditions' => array(
                        'Commentpostreply.comment_post_id' => $item['Commentpost']['id']
                    ),
//                    'limit' => 2,
                ));
                $data_reply = null;
                $j = 0;
                foreach ($replys as $reply)
                {
                    $data_reply[$j] = array(
                        'reply_id' => $reply['Commentpostreply']['id'],
                        'reply' => nl2br(htmlentities($reply['Commentpostreply']['reply'], ENT_QUOTES, 'UTF-8')),
                        'created' => $this->Library->time_elapsed_string($reply['Commentpostreply']['created']),
                        'like' => $reply['Commentpostreply']['like'],
                        'fullname' => $reply['Member']['fullname'],
                        'image' => $reply['Member']['image'],
                        'admin' => $reply['Profile']['admin']
                    );
                    $j = $j + 1;
                }
                //
                $data[$i] = array(
                    'id' => $item['Commentpost']['id'],
                    'comment' => nl2br(htmlentities($item['Commentpost']['comment'], ENT_QUOTES, 'UTF-8')),
                    'created' => $this->Library->time_elapsed_string($item['Commentpost']['created']),
                    'like' => $item['Commentpost']['like'],
                    'fullname' => $item['Member']['fullname'],
                    'image' => $item['Member']['image'],
                    'admin' => $item['Profile']['admin'],
                    'reply' => $data_reply,
                    'sum_remain_reply' => count($sum_remain_reply)
                );
                $i = $i + 1;
            }
            echo json_encode(array('data' => $data, 'sum_remain' => count($sum_remain)));
        }
    }
    function like()
    {
        $this->autoRender = false;
        if($this->Session->check('Member'))
        {
            if($this->request->is('post'))
            {
                $comment_id = $this->request->data['comment_id'];
                $this->Commentpost->recursive = -1;
                if($this->Commentpost->updateAll(array('Commentpost.like' => 'Commentpost.like + 1'), array('Commentpost.id' => $comment_id)))
                {
                    $this->Commentpost->recursive = -1;
                    $like = $this->Commentpost->find('first', array('conditions' => array('id' => $comment_id)));
                    echo json_encode(array(
                        'status' => 'success',
                        'like' => $like['Commentpost']['like']
                    ));
                }
            }
        }
        else
        {
            echo json_encode(array('status' => 'notSession'));
        }
    }

}