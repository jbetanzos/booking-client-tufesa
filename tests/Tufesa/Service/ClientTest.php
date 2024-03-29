<?php

namespace Tufesa\Service;

use Guzzle\Http\Client as GuzzleClient;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function test_schedule_factory_return_an_instance_of_schedule()
    {
        $response = new \Guzzle\Http\Message\Response(200);
        $response->setBody('{"_id":"1.0","_Response":{"_revAuth":null,"resultField":{"_id":"00","_message":"Consulta Exitosa"},"dataField":[{"_line":"TUFES","_point":null,"_schedules":[{"_id":866940,"_departure_date":"20140716","_departure_time":"08:00","_arrival_date":"20140716","_arrival_time":"22:40","_service":"PLUS","_category":[{"_id":"C","_value":"1214.00","_remain":42},{"_id":"I","_value":"607.00","_remain":2},{"_id":"M","_value":"607.00","_remain":20},{"_id":"E","_value":"971.00","_remain":42},{"_id":"P","_value":"971.00","_remain":10}]},{"_id":865850,"_departure_date":"20140716","_departure_time":"09:00","_arrival_date":"20140716","_arrival_time":"23:30","_service":"PLUS","_category":[{"_id":"C","_value":"1214.00","_remain":40},{"_id":"I","_value":"607.00","_remain":2},{"_id":"M","_value":"607.00","_remain":20},{"_id":"E","_value":"971.00","_remain":40},{"_id":"P","_value":"971.00","_remain":10}]},{"_id":866948,"_departure_date":"20140716","_departure_time":"14:30","_arrival_date":"20140717","_arrival_time":"05:30","_service":"PLUS","_category":[{"_id":"C","_value":"1214.00","_remain":35},{"_id":"I","_value":"607.00","_remain":2},{"_id":"M","_value":"607.00","_remain":20},{"_id":"E","_value":"971.00","_remain":35},{"_id":"P","_value":"971.00","_remain":10}]},{"_id":865860,"_departure_date":"20140716","_departure_time":"19:00","_arrival_date":"20140717","_arrival_time":"09:40","_service":"PLUS","_category":[{"_id":"C","_value":"1214.00","_remain":42},{"_id":"I","_value":"607.00","_remain":2},{"_id":"M","_value":"607.00","_remain":20},{"_id":"E","_value":"971.00","_remain":42},{"_id":"P","_value":"971.00","_remain":10}]},{"_id":873811,"_departure_date":"20140716","_departure_time":"22:00","_arrival_date":"20140717","_arrival_time":"12:45","_service":"PLUS","_category":[{"_id":"C","_value":"1214.00","_remain":36},{"_id":"I","_value":"607.00","_remain":2},{"_id":"M","_value":"607.00","_remain":20},{"_id":"E","_value":"971.00","_remain":36},{"_id":"P","_value":"971.00","_remain":10}]},{"_id":873824,"_departure_date":"20140716","_departure_time":"23:59","_arrival_date":"20140717","_arrival_time":"15:00","_service":"PLUS","_category":[{"_id":"C","_value":"1214.00","_remain":40},{"_id":"I","_value":"607.00","_remain":2},{"_id":"M","_value":"607.00","_remain":20},{"_id":"E","_value":"971.00","_remain":40},{"_id":"P","_value":"971.00","_remain":10}]},{"_id":865857,"_departure_date":"20140716","_departure_time":"23:59","_arrival_date":"20140717","_arrival_time":"15:00","_service":"PLUS","_category":[{"_id":"C","_value":"1214.00","_remain":0},{"_id":"I","_value":"607.00","_remain":0},{"_id":"M","_value":"607.00","_remain":0},{"_id":"E","_value":"971.00","_remain":0},{"_id":"P","_value":"971.00","_remain":0}]}],"_row":null,"_total_trans":null,"_auth":null,"_ticket":null}]},"_Request":null}');

        $plugin = new \Guzzle\Plugin\Mock\MockPlugin();
        $plugin->addResponse($response);
        $guzzleClient = new GuzzleClient();
        $guzzleClient->addSubscriber($plugin);

        $tufesaClient = new Client($guzzleClient);

        $from = "GDL";
        $to = "OBR";
        $date = new \DateTime("tomorrow");

        $schedules = $tufesaClient->getSchedules($from, $to, $date);

        foreach ($schedules as $schedule) {
            $this->assertInstanceOf('Tufesa\Service\Type\Schedule', $schedule);
        }
    }

    public function test_seat_map_factory_should_return_an_instance_of_seat_map()
    {
        $response = new \Guzzle\Http\Message\Response(200);
        $response->setBody('{"_id":"1.0","_Response":{"_revAuth":null,"resultField":{"_id":"00","_message":"Mensaje Exitoso"},"dataField":[{"_line":"TUFES","_point":null,"_schedules":null,"_row":[{"_seat":[{"_id":4,"_available":true},{"_id":8,"_available":true},{"_id":12,"_available":true},{"_id":16,"_available":true},{"_id":20,"_available":true},{"_id":24,"_available":true},{"_id":28,"_available":true},{"_id":32,"_available":true},{"_id":36,"_available":true},{"_id":40,"_available":true}]},{"_seat":[{"_id":3,"_available":true},{"_id":7,"_available":true},{"_id":11,"_available":true},{"_id":15,"_available":true},{"_id":19,"_available":true},{"_id":23,"_available":true},{"_id":27,"_available":true},{"_id":31,"_available":true},{"_id":35,"_available":true},{"_id":39,"_available":true}]},{"_seat":[{"_id":2,"_available":true},{"_id":6,"_available":true},{"_id":10,"_available":true},{"_id":14,"_available":true},{"_id":18,"_available":true},{"_id":22,"_available":true},{"_id":26,"_available":true},{"_id":30,"_available":true},{"_id":34,"_available":true},{"_id":38,"_available":true}]},{"_seat":[{"_id":1,"_available":true},{"_id":5,"_available":true},{"_id":9,"_available":true},{"_id":13,"_available":true},{"_id":17,"_available":true},{"_id":21,"_available":true},{"_id":25,"_available":true},{"_id":29,"_available":true},{"_id":33,"_available":true},{"_id":37,"_available":true}]}],"_total_trans":null,"_auth":null,"_ticket":null}]},"_Request":null}');

        $plugin = new \Guzzle\Plugin\Mock\MockPlugin();
        $plugin->addResponse($response);
        $guzzleClient = new GuzzleClient();
        $guzzleClient->addSubscriber($plugin);

        $tufesaClient = new Client($guzzleClient);

        $from = "GDL";
        $to = "OBR";
        $schedule = 866926;

        $seatMap = $tufesaClient->getSeatMap($from, $to, $schedule);
        $this->assertInstanceOf('Tufesa\Service\Type\SeatMap', $seatMap);
    }
}
