<?php
/**
 * Created by PhpStorm.
 * User: shaunhare
 * Date: 10/02/2017
 * Time: 17:20
 */

namespace NottsDigital\Http\Request;

use NottsDigital\Event\GroupInfo;

/**
 * Class MeetupRequestParser
 * @package NottsDigital\Http\Request
 */
class MeetupRequestParser implements ParserInterface
{
    
    /**
     * @var array
     */
    private $attributes;
    /**
     * @var array
     */
    private $required;
    /**
     * @var array
     */
    private $map;
    
    /**
     * MeetupParser constructor.
     * @param array $map
     *
     */
    public function __construct(array $map)
    {
        $this->map = $map;
    }
    
    /**
     * @param array $attributes
     * @return MeetupRequestParser
     */
    public function setAttributes(array $attributes): ParserInterface
    {
        $this->attributes = $attributes;
        return $this;
    }
    
    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
    
    
    /**
     * @return array
     */
    public function groupInfo():array
    {
        
       $map = $this->map;
        
       $attributes = $this->getAttributes();
       
        foreach (array_keys($map) as $k)
        {
            $map[$k] = array_key_exists($k,$attributes)?$attributes[$k]:"";
        }
        
        $items = $this->renameKeys($map);
       
        return $items;
    }
    
    /**
     * @param array $input
     * @return array
     */
    private function renameKeys(array $input):array
    {
        $keys = array_keys($input);
        foreach($this->map as $request_key=>$map_key){
            if (false === $index = array_search($request_key, $keys)) {
                continue;
            }
            
            $keys[$index] = $map_key;
        }
        return array_combine($keys, array_values($input));
    }
}