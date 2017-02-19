<?php
/**
 * Created by PhpStorm.
 * User: shaunhare
 * Date: 11/02/2017
 * Time: 11:43
 */

namespace NottsDigital\Http\Request;


interface ParserInterface
{
    
    public function groupInfo():ParserInterface;
    
    public function setAttributes(array $attributes):ParserInterface;
    
    public function toArray():array;
}