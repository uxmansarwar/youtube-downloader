<?php
// $api_key = "WM";
// $video_id = "asYxxtiWUyw";
// $url = "https://www.googleapis.com/youtube/v3/videos?id=" . $video_id . "&key=" . $api_key . "&part=snippet,contentDetails,statistics,status";
// $json = file_get_contents($url);
// $getData = json_decode( $json , true); 
// dbg($getData);
// foreach((array)$getData['items'] as $key => $gDat){
//     $title = $gDat['snippet']['title'];
// }
// // Output title
// echo $title;
// exit;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
function dbg($data = '')
{
    // var_dump($data);
    echo "<br /><pre>";
    print_r($data);
    echo "</pre><br />";
    // var_dump($data);
    echo 'Script execution Time is :::: ' . (microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) . '<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
    exit();
}

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

// $client = new \GuzzleHttp\Client();
// $feed = 'https://www.youtube.com';

// try {

//     $res = $client->get(
//         $feed,
//         [
//             'headers' => [
//                 'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.81 Safari/537.36',
//                 'Connection' => 'keep-alive',
//                 'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
//                 'Accept' => 'text/plain, */*',
//                 'X-Requested-With' => 'XMLHttpRequest',
//                 'Accept-Language' => 'en-US,en;q=0.8'
//             ]
//         ]
//     );
//     // echo $res->getBody();
//     echo $res->getStatusCode();
// } catch (\Exception $e) {
//     echo 'Exception: ' . $e->getMessage();
// }
// dbg();
// How can I get the query parameters that was used in the request (i.e. bar)









// use GuzzleHttp\Client;
// dbg();

// $body = 'AWSAccessKeyId=AKIAJFTQQL6UN7RO6WBQ&Action=GetMatchingProductForId&SellerId=AWWNSYIT4NM3&SignatureVersion=2&Timestamp=2017-05-06T17%3A43%3A36Z&Version=2011-10-01&Signature=wVax9gw0DfIfeL7s4Z2IZynwwryi0c6tIkfE7IQY1RI%3D&SignatureMethod=HmacSHA256&MarketplaceId=ATVPDKIKX0DER&IdType=UPC&IdList.Id.1=034264456730';

// $jar = new \GuzzleHttp\Cookie\CookieJar();

// $client = new Client([
//     'base_uri'=>'https://thriveglobal.com',
//     'cookies'=>$jar,
//     'headers'=>[
//         'User-Agent'=>'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.81 Safari/537.36',
//         'Host'=> 'thriveglobal.com',
//         'Connection'=>'keep-alive',
//         'Content-Length'=>'309',
//         'Origin'=>'https://thriveglobal.com',
//         'x-amazon-user-agent'=>'AmazonJavascriptScratchpad/1.0 (Language=Javascript)',
//         'Content-Type'=>'application/x-www-form-urlencoded; charset=UTF-8',
//         'Accept'=>'text/plain, */*',
//         'X-Requested-With'=>'XMLHttpRequest',
//         'Referer'=>'https://mws.amazonservices.com/scratchpad/index.html',
//         'Accept-Encoding'=>'gzip, deflate, br',
//         'Accept-Language'=>'en-US,en;q=0.8',
//         ]
//     ]);

// $response = $client->request('GET', 'https://thriveglobal.com');

// echo $response->getStatusCode();




///////////////////////////////
// $client = new GuzzleHttp\Client(['base_uri' => 'http://thriveglobal.com']);
// // $client = new GuzzleHttp\Client(['base_uri' => 'https://youtube.com', 'HTTP_USER_AGENT' => 'Mozilla/5.0']);

// // $res = $client->request('GET');

// $client->request(
//     'GET',
//     '/get',
//     [
//         'base_uri' => 'http://thriveglobal.com',
//         'headers' => [
//             'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.81 Safari/537.36'
//         ]
//     ]
// );
// echo $res->getStatusCode();



// dbg();

// $client = new \GuzzleHttp\Client();
// // $response = $client->request('GET', "thriveglobal.com");

// $response->getStatusCode(); // 200
// $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
// dbg($response->getBody()); // '{"id": 1420053, "name": "guzzle", ...}'























/** 
 * Muhammad Usman Sarwar
 * 
 * This Downloader class helps to download youtube video. 
 * 
 * @class       YouTubeDownloader 
 * @author      MuhammadUsmanSarwar 
 * @link        http://MuhammadUsmanSarwar.blogspot.com 
 * @license     http://MuhammadUsmanSarwar.blogspot.com 
 */
class YouTubeDownloader
{
    /* 
     * Video Id for the given url 
     */
    private $video_id;

    /* 
     * Video title for the given video 
     */
    private $video_title;

    /* 
     * Full URL of the video 
     */
    private $video_url;

    /* 
     * store the url pattern and corresponding downloader object 
     * @var array 
     */
    private $link_pattern = "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed)\/))([^\?&\"'>]+)/";

    public function __construct()
    {
    }
    public function setUrl($url)
    {
        $this->video_url = $url;
    }
    private function videoMetaData()
    {
// https://www.youtube.com/get_video_info?video_id=f7Gy_YtC-Xc&cpn=CouQulsSRICzWn5E&eurl&el=adunit
// https://www.youtube.com/get_video_info?video_id=f7Gy_YtC-Xc&asv=2
        // return file_get_contents("https://www.youtube.com/get_video_info?video_id=".$this->extractVideoId($this->video_url)."&cpn=CouQulsSRICzWn5E&eurl&el=adunit"); 

$api_key = "AIzaSyABug4jB1ahdAhVkvT1BnmxYeKm8o9qTWM";
$video_id = "asYxxtiWUyw";
$url = "https://www.googleapis.com/youtube/v3/videos?id=" . $video_id . "&key=" . $api_key . "&part=snippet,contentDetails,statistics,status";
$json = file_get_contents($url);
$getData = json_decode( $json , true); 
dbg($getData);









        $client = new \GuzzleHttp\Client();
        $feed = 'https://www.youtube.com';
        // $feed = "https://www.youtube.com/get_video_info?video_id=".$this->extractVideoId($this->video_url)."&el=adunit";

        try {

            $res = $client->get(
                $feed,
                [
                    'headers' => [
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.81 Safari/537.36',
                        'Connection' => 'keep-alive',
                        'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
                        'Accept' => 'text/plain, */*',
                        'X-Requested-With' => 'XMLHttpRequest',
                        'Accept-Language' => 'en-US,en;q=0.8'
                    ]
                ]
            );
            // echo $res->getBody();
            echo $res->getStatusCode();
        } catch (\Exception $e) {
            echo 'Exception: ' . $e->getMessage();
        }
    }

    /* 
     * Get video Id 
     * @param string 
     * return string 
     */
    private function extractVideoId($video_url)
    {
        //parse the url 
        $parsed_url = parse_url($video_url);
        if ($parsed_url["path"] == "youtube.com/watch") {
            $this->video_url = "https://www." . $video_url;
        } elseif ($parsed_url["path"] == "www.youtube.com/watch") {
            $this->video_url = "https://" . $video_url;
        }

        if (isset($parsed_url["query"])) {
            $query_string = $parsed_url["query"];
            //parse the string separated by '&' to array 
            parse_str($query_string, $query_arr);
            if (isset($query_arr["v"])) {
                return $query_arr["v"];
            }
        }
    }
    public function getDownloader($url)
    {

        if (preg_match($this->link_pattern, $url)) {
            return $this;
        }
        return false;
    }

    public function getVideoDownloadLink()
    {
        //parse the string separated by '&' to array 
        parse_str($this->videoMetaData(), $data);
        $videoData = json_decode($data['player_response'], true);
        $videoDetails = $videoData['videoDetails'];
        $streamingData = $videoData['streamingData'];
        $streamingDataFormats = $streamingData['formats'];

        //set video title 
        $this->video_title = $videoDetails["title"];

        //Get the youtube root link that contains video information 
        $final_stream_map_arr = array();

        //Create array containing the detail of video  
        foreach ($streamingDataFormats as $stream) {
            $stream_data = $stream;
            $stream_data["title"] = $this->video_title;
            $stream_data["mime"] = $stream_data["mimeType"];
            $mime_type = explode(";", $stream_data["mime"]);
            $stream_data["mime"] = $mime_type[0];
            $start = stripos($mime_type[0], "/");
            $format = ltrim(substr($mime_type[0], $start), "/");
            $stream_data["format"] = $format;
            unset($stream_data["mimeType"]);
            $final_stream_map_arr[] = $stream_data;
        }
        return $final_stream_map_arr;
    }

    /* 
     * Validate the given video url 
     * return bool 
     */
    public function hasVideo()
    {
        $valid = true;
        dbg($this->videoMetaData());
        parse_str($this->videoMetaData(), $data);
        if ($data["status"] == "fail") {
            $valid = false;
        }
        dbg($data);
        return $valid;
    }
}
