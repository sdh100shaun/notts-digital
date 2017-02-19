<?php
/**
 * Created by PhpStorm.
 * User: shaunhare
 * Date: 10/02/2017
 * Time: 17:20
 */

namespace NottsDigital\Http\Request;


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
    private $groupProperties;
    
    
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
        
        return $this->groupInfo();
    }
    
    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
    
    /**
     * @param array $groupProperties
     */
    public function setGroupProperties(array $groupProperties)
    {
        $this->groupProperties = $groupProperties;
    }
    
    /**
     * @return array
     */
    public function groupInfo():ParserInterface
    {
        
       $map = $this->map;
        
       $attributes = $this->getAttributes();
       
        foreach (array_keys($map) as $k)
        {
            $value = '';
            
            if(preg_match("/\-stub$/",$k))
            {
                $k = str_ireplace("-stub","",$k);
                $value = $map[$k];
            }
            
            $map[$k] = array_key_exists($k,$attributes)?$attributes[$k]:$value;
            
           
        }
        
        $this->setGroupProperties($this->renameKeys($map));
        
        
        return $this;
    }
    
    /**
     * @param array $input
     * @return array
     */
    private function renameKeys(array $input):array
    {
        $keys = array_keys($input);
        $this->map = preg_grep('/^\{/', $this->map, PREG_GREP_INVERT);
        foreach($this->map as $request_key=>$map_key){
            if (false === $index = array_search($request_key, $keys)) {
                continue;
            }
            
            $keys[$index] = $map_key;
        }
        
        $values = array_values($input);
        return array_combine($keys, $values);
    }
    
    /**
     * Get the array representation of this object
     *
     * @return array
     */
    public function toArray():array
    {
        return $this->groupProperties;
    }
    
    
    
}