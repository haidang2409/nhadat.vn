<?php
App::uses('Security', 'Utility');
class DirectionsController extends AppController
{
    //Transaction, commit and rollback
    function transaction()
    {
        $this->Direction->recursive = -1;
        $datasource = $this->Direction->getDataSource();
        try
        {

            $datasource->begin();

            $d = array(
                'id' => '99',
                'directionname' => 'abc 123'
            );

            if(!$this->Direction->save($d))
            {
                throw new Exception();
            }
            $d = array(
                array(
                    'a' => 1,
                    'b' => 2
                )
            );
            if(!$this->Direction->save($d))
            {
                throw new Exception();
            }

            $datasource->commit();

        }
        catch (Exception $e)
        {

        }
    }

}