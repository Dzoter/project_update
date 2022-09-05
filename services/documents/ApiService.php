<?php

namespace app\services\documents;

use app\models\Documents;
use GuzzleHttp\Client;
use yii\helpers\Url;

class ApiService
{
    public $document;

    public function __construct(Documents $document)
    {
        $this->document = $document;
    }

    private function getCoordinateFromGoogle()
    {
        $address = urlencode(
            'UK '.$this->document->town.' '.$this->document->street.
            ' '.$this->document->property_number
        );

        $client = new Client();
        $response = $client->get(
            "https://maps.google.com/maps/api/geocode/json?address=$address&key=AIzaSyAuJZb0MGVPm1CP_QEk3mzTkx3y2rGNayk"
        );
        $status = $response->getStatusCode();
        if ($status === 200) {
            $htmlString = $response->getBody()->getContents();
            $data = json_decode($htmlString, true); // returns an array

            return $data['results'][0]['geometry']['location'];
        }


        return 'Сервер не отвечает';
    }

    public function getStaticMapsFromGoogle()
    {
        $coordinate = urlencode($this->getCoordinateFromGoogle()['lat'].' '.$this->getCoordinateFromGoogle()['lng']);


        $img = file_get_contents(
            "https://maps.googleapis.com/maps/api/staticmap?center=$coordinate&zoom=13&size=600x300&markers=color:blue%7Clabel:H%7C$coordinate&key=AIzaSyCDa4cdMIa-DFRWFRIQ0-wXXbuGmRUuO7o"
        );
        if (!file_exists(Url::to("uploadedImg/".$this->document->id))) {
            if (!mkdir($concurrentDirectory = Url::to("uploadedImg/".$this->document->id))
                && !is_dir(
                    $concurrentDirectory
                )
            ) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }
        file_put_contents(\yii\helpers\Url::to("uploadedImg/".$this->document->id."/mapsFromGoogle.jpg"), $img);

        return "uploadedImg/".$this->document->id."/mapsFromGoogle.jpg";
    }

    public function getRadon()
    {
        $address
            = $this->document->property_number.' '.$this->document->street.' '.
            $this->document->town;

        $url = 'https://mapapps2.bgs.ac.uk/geoindex/home.html?layer=BGSRadon&location='.$address;
        $response = file_get_contents(
            'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?screenshot=true&url='.urlencode($url)
            .'&key=AIzaSyBrIbeAXgccK5qrEeT5xhK_Ag9UVWFkkQk'
        );
        $googlePagespeedObject = json_decode($response, true);
        $screenshot = $googlePagespeedObject['lighthouseResult']['audits']['final-screenshot']['details']['data'];
        $screenshot = str_replace(array('_', '-'), array('/', '+'), $screenshot);
        file_put_contents(
            \yii\helpers\Url::to("uploadedImg/".$this->document->id."/screenshotFromGoogle.jpg"),
            file_get_contents
            (
                $screenshot
            )
        );

        return "uploadedImg/".$this->document->id."/screenshotFromGoogle.jpg";
    }

    public function getNearbySubways()
    {
        $coordinate = urlencode($this->getCoordinateFromGoogle()['lat'].','.$this->getCoordinateFromGoogle()['lng']);
        $url = 'https://maps.googleapis.com/maps/api/place/search/json?&language=en-GB&location='.$coordinate
            .'&radius=1000&sensor=false&types=subway_station|train_station&key=AIzaSyCDa4cdMIa-DFRWFRIQ0-wXXbuGmRUuO7o';
        $client = new Client();
        $response = $client->get(
            $url
        );
        $status = $response->getStatusCode();
        $stations = [];
        if ($status === 200) {
            $htmlString = $response->getBody()->getContents();
            $data = json_decode($htmlString, true); // returns an array
            foreach ($data['results'] as $station) {
                $stations[$station['name']] = [$station['geometry']['location']];
            }

            return $this->getDistance($coordinate, $stations);
        }

        return 'Сервер не отвечает';
    }

    private function getDistance($coordinate, array $stations)
    {
        $subwayDistance = [];

        foreach ($stations as $station => $stationInfo){
            $stationCoordinate = array_shift($stationInfo);
            $stationCoordinateEncode = urlencode($stationCoordinate['lat']. ',' . $stationCoordinate['lng']);

            $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?destinations='.$stationCoordinateEncode.'&origins='
                .$coordinate.'&units=imperial&key=AIzaSyA8phVaJbT-bPvMi8OcCqw3FEdssXq7xYs';
            $client = new Client();
            $response = $client->get(
                $url
            );
            $status = $response->getStatusCode();
            if ($status === 200) {
                $htmlString = $response->getBody()->getContents();
                $data = json_decode($htmlString, true); // returns an array

                $subwayDistance[] = [$station=>$data['rows'][0]['elements'][0]['distance']['text']];

            }
        }
        return $subwayDistance;

    }


    public static function getEnergySertificate()
    {
        $address = '28-30 Worship Street, London, EC2A 2AH';
        $url = 'https://find-energy-certificate.service.gov.uk/find-a-certificate/search-by-street-name-and-town?street_name=queens+gate&town=London';


        $client = new Client();
        $response = $client->get(
            $url
        );
        $html = $response->getBody()->getContents();

        $document = @\phpQuery::newDocument($html);

        $arrayToPromise = [];
        $arrayToHiddenInput = [];
        foreach ($document->find('.govuk-table__body .govuk-table__row') as $sertificate){
            $info = pq($sertificate);

            $header = $info->find('.govuk-table__header')->text();

            $rating = $info->find('.govuk-table__cell:eq(0)')->text();


            $date = $info->find('.govuk-table__cell span')->text();


            $expired = $info->find('.govuk-table__cell strong')->text();

            $arrayToPromise['show'][] = $header.$rating.$date.$expired;

            $arrayToPromise['hidden'][] = $rating.'::'.$expired;

        }


       return $arrayToPromise;



    }
}

