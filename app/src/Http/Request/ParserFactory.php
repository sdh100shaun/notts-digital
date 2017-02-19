<?php
/**
 * Created by PhpStorm.
 * User: shaunhare
 * Date: 13/02/2017
 * Time: 08:49
 */

namespace NottsDigital\Http\Request;


use NottsDigital\Adapter\MeetupAdapter;
use NottsDigital\Adapter\TitoAdapter;

class ParserFactory
{
    public function getGroupInfo($requestType,array $request):array
    {
        switch ($requestType)
        {
            case $requestType instanceof MeetupRequest:
            {
                $map = [
                    "name"=>"name",
                    "group_photo" =>"group_photo",
                    "description"=>"description"
                ];
                return (new MeetupRequestParser($map))->setAttributes($request)->toArray();
                break;
            }
            
            default:
            {
                return $request;
            }
        }
    }
}