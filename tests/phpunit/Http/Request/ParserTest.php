<?php
namespace NottsDigital\Tests\Http\Request;

use NottsDigital\Http\Request\MeetupParser;
use NottsDigital\Http\Request\MeetupRequestParser;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: shaunhare
 * Date: 10/02/2017
 * Time: 21:23
 */
class ParserTest extends TestCase
{
    /**
     * @var MeetupRequestParser
     */
    private $parser;
    
    public function setUp()
    {
        $this->parser = (new MeetupRequestParser(["group_photo"=>"photo","group_description"=>"description","name"=>"name","key"=>"key","test3"=>"test3"]))->setAttributes(["group_photo"=>"test1","group_description"=>"test2","name"=>"name from request","test3"=>["ss"=>"test"]]);
        parent::setUp();
    }
    
    public function testParserReadsRequestProperties()
    {
        $attributes = $this->parser->getAttributes();
        $this->assertInternalType("array",$attributes);
        $this->assertContains("group_photo",array_keys($attributes));
        
    }
    
    public function testGroupInfoPropertiesSet()
    {
        $actual = $this->parser->groupInfo();
        $this->assertInternalType('array',$actual);
        $this->assertArrayHasKey("photo",$actual);
        
    }
    
    public function tearDown()
    {
        parent::tearDown();
    }
    
}