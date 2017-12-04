<?php
/**
 * Created by PhpStorm.
 * User: chand
 * Date: 2017-10-12
 * Time: 2:44 PM
 */

class Helpme extends Application
{

    public function index()
    {
        $this->data['pagebody'] = 'homepage';
        $stuff = file_get_contents('../data/jobs.md');
        $this->data['content'] = $this->parsedown->parse($stuff);
        $this->render();
    }
}