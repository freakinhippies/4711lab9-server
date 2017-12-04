<?php
/**
 * Created by PhpStorm.
 * User: chand
 * Date: 2017-11-16
 * Time: 2:24 PM
 */

class XML_Model extends Memory_Model
{
    /**
     * Constructor.
     * @param string $origin Filename of the XML file
     * @param string $keyfield  Name of the primary key field
     * @param string $entity	Entity name meaningful to the persistence
     */
    function __construct($origin = null, $keyfield = 'id', $entity = null)
    {

        parent::__construct();

        // guess at persistent name if not specified
        if ($origin == null)
            $this->_origin = get_class($this);
        else
            $this->_origin = $origin;

        // remember the other constructor fields
        $this->_keyfield = $keyfield;
        $this->_entity = $entity;

        // start with an empty collection
        $this->_data = array(); // an array of objects
        $this->fields = array(); // an array of strings
        // and populate the collection
        $this->load();

    }

    protected function load()
    {

        if (file_exists($this->_origin)) {
            $xml = simplexml_load_file($this->_origin);
            $tasks = $xml->children();
            foreach($tasks as $task)
            {
                $record = new stdClass();

                $taskArray = (array)$task;
                $taskFields = array_keys($taskArray);
                $this->_fields=$taskFields;
                foreach($taskFields as $taskField)
                {
                    $record->{$taskField} = $taskArray[$taskField];
                }

                $key = $record->{$this->_keyfield};
                $this->_data[$key] = $record;
            }
        }
          // --------------------
        // rebuild the keys table
        $this->reindex();
    }

    /**
     * Store the collection state appropriately, depending on persistence choice.
     * OVER-RIDE THIS METHOD in persistence choice implementations
     */
    protected function store()
    {
        // rebuild the keys table
        $this->reindex();
        //---------------------
        $xmlheader = '<?xml version="1.0" encoding="UTF-8"?>
                        <tasks></tasks>';
        if (file_exists($this->_origin)) {

            $xml = new SimpleXMLElement($xmlheader);
            $tasks = $this->_data;
            foreach($this->_data as $key => $record)
            {
                $task = $xml->addChild('task');
                foreach($this->_fields as $field)
                {
                    $temp = (array)$record;
                    $task->addChild((string)$field, (string)$temp[$field]);
                }
            }
           // $xml->addChild('info')->addChild('detail', 'fourth data');
            $xml->asXML($this->_origin);
        }




      //  file_put_contents($this->_origin, $this->_data->asXML());

        // --------------------
    }


}