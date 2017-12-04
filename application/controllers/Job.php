<?php
/**
 * Created by PhpStorm.
 * User: Chandu
 * Date: 2017-12-03
 * Time: 9:11 PM
 */

require APPPATH.'/third_party/restful/libraries/Rest_controller.php';
class Job extends Rest_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Task');
    }

    // GET
    function index_get($key=null)
    {
        if (!$key)
        {
            //Return all tasks
            $this->response($this->tasks->all(), 200);
        } else
        {
            //return request or 404
            $result = $this->tasks->get($key);
            if ($result != null)
                $this->response($result, 200);
            else
                $this->response(array('error' => 'Todo item not found!'), 404);
        }
    }

    //PUT (update tasks)
    function index_put($key=null)
    {
        $record = array_merge(array('id' => $key), $this->_put_args);
        $this->tasks->update($record);
        $this->response(array('ok'), 200);
    }

    //POST (add task)
    function index_post($key=null)
    {
        $record = array_merge(array('id' => $key), $_POST);
        $this->tasks->add($record);
        $this->response(array('ok'), 200);
    }

    // DELETE
    function item_delete($key=null)
    {
        $this->tasks->delete($key);
        $this->response(array('ok'), 200);
    }
}
