<?php 
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
function dbg($data = '')
{
	// var_dump($data);
	echo "<br /><pre>";
	print_r($data);
	echo "</pre><br />";
	// var_dump($data);
	echo 'Script execution Time is :::: '.(microtime(true)-$_SERVER['REQUEST_TIME_FLOAT']).'<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
	exit();
}
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
class YouTubeDownloader { 
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
     
    public function __construct(){ 
         
    } 
    public function setUrl($url){ 
        $this->video_url = $url; 
    } 
    private function videoMetaData(){ 
        // return file_get_contents("https://www.youtube.com/get_video_info?video_id=".$this->extractVideoId($this->video_url)."&cpn=CouQulsSRICzWn5E&eurl&el=adunit"); 
        return file_get_contents("https://www.youtube.com/get_video_info?video_id=".$this->extractVideoId($this->video_url)."&cpn=CouQulsSRICzWn5E&eudrl&el=adunit"); 

// $client = new \GuzzleHttp\Client();
// $response = $client->request('GET', "thriveglobal.com");

//  $response->getStatusCode(); // 200
//  $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
// dbg($response->getBody()); // '{"id": 1420053, "name": "guzzle", ...}'

    } 
      
    /* 
     * Get video Id 
     * @param string 
     * return string 
     */ 
    private function extractVideoId($video_url){ 
        //parse the url 
        $parsed_url = parse_url($video_url); 
        if($parsed_url["path"] == "youtube.com/watch"){ 
            $this->video_url = "https://www.".$video_url; 
        }elseif($parsed_url["path"] == "www.youtube.com/watch"){ 
            $this->video_url = "https://".$video_url; 
        } 
         
        if(isset($parsed_url["query"])){ 
            $query_string = $parsed_url["query"]; 
            //parse the string separated by '&' to array 
            parse_str($query_string, $query_arr); 
            if(isset($query_arr["v"])){ 
                return $query_arr["v"]; 
            } 
        }    
    } 
    public function getDownloader($url){ 
        
        if(preg_match($this->link_pattern, $url)){ 
            return $this; 
        } 
        return false; 
    } 
    
    public function getVideoDownloadLink(){ 
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
        foreach($streamingDataFormats as $stream){ 
            $stream_data = $stream; 
            $stream_data["title"] = $this->video_title; 
            $stream_data["mime"] = $stream_data["mimeType"]; 
            $mime_type = explode(";", $stream_data["mime"]); 
            $stream_data["mime"] = $mime_type[0]; 
            $start = stripos($mime_type[0], "/"); 
            $format = ltrim(substr($mime_type[0], $start), "/"); 
            $stream_data["format"] = $format; 
            unset($stream_data["mimeType"]); 
            $final_stream_map_arr [] = $stream_data;          
        } 
        return $final_stream_map_arr; 
    } 
      
    /* 
     * Validate the given video url 
     * return bool 
     */ 
    public function hasVideo(){ 
        $valid = true; 
dbg($this->videoMetaData());
        parse_str($this->videoMetaData(), $data); 
        if($data["status"] == "fail"){ 
            $valid = false; 
        }  
dbg($data);
        return $valid; 
    } 
      
}