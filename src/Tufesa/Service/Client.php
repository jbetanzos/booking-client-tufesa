<?php

namespace Tufesa\Service;

use Tufesa\Service\Factory\ScheduleFactory;
use Tufesa\Service\Factory\SeatMapFactory;
use Guzzle\Http\Client as GuzzleClient;
use Tufesa\Service\Type\SeatMap;

class Client
{
    protected $guzzleClient;

    public function __construct(GuzzleClient $client)
    {
         $this->guzzleClient = $client;
    }

    public function getGuzzleClient()
    {
        return $this->guzzleClient;
    }

    public function getSchedules($from, $to, \DateTime $date)
    {
        $params = [
            "from" => $from,
            "to" => $to,
            "date" => $date->format("Ymd")
        ];

        $request = $this->guzzleClient->get("schedules?" . http_build_query($params));
        $response = $request->send();
        $resource = $response->json();

        if ($resource["_Response"]["resultField"]["_id"] != "00") {
            throw new \Exception($resource["_Response"]["resultField"]["_message"]);
        }

        return ScheduleFactory::create($resource["_Response"]["dataField"][0]["_schedules"]);
    }

    public function getSeatMap($from, $to, $schedule)
    {
        $params = [
            "from" => $from,
            "to" => $to,
            "schedule" => $schedule
        ];

        $request = $this->guzzleClient->get("seats?" . http_build_query($params));
        $response = $request->send();
        $resource = $response->json();

        if ($resource["_Response"]["resultField"]["_id"] != "00") {
            throw new \Exception($resource["_Response"]["resultField"]["_message"]);
        }

        $rows = $resource["_Response"]["dataField"][0]["_row"];

        return SeatMapFactory::create($rows);
    }
}
