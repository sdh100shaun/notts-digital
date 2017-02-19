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
        $this->parser = (new MeetupRequestParser(["group_photo"=>"group_photo","group_description"=>"description","name"=>"name","key"=>"key","test2"=>"test2","group_photo-stub"=>json_encode(["group_photo"=>["highres_link"=>""]])]))->setAttributes(["group_photo"=>"test1","group_description"=>"test2","name"=>"name from request","test3"=>["ss"=>"test"],"key"=>"Another test"]);
        parent::setUp();
    }
    
    public function testParserReadsRequestProperties()
    {
        $attributes = $this->parser->getAttributes();
        $this->assertInternalType("array",$attributes);
        $this->assertContains("group_photo",array_keys($attributes));
        
    }
    
    public function testGroupPropertiesSet()
    {
        $actual = $this->parser->toArray();
        $this->assertInternalType('array',$actual);
        var_dump($actual);
        $this->assertArrayHasKey("group_photo",$actual);
        
    }
    
    public function testReturnsBlankForUnknownKey()
    {
        $actual = $this->parser->toArray();
        $this->assertInternalType('array',$actual);
        $this->assertArrayHasKey("test2",$actual);
        $this->assertEquals("",$actual["test2"]);
        
    }
    
    
    public function tearDown()
    {
        parent::tearDown();
    }
    
}