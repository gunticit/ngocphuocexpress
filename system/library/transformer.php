<?php
class Transformer
{
    private $file;
    public function __construct($file)
    {
        $this->file = $file;
    }
    public function we($message) {
        $folder = DIR_SYSTEM ."cache/";

        $file = $folder . $this->file;
        $handle = fopen($file, 'w');

        fwrite($handle, $message);

        fclose($handle);
    }
    public function ce() {
        $folder = DIR_SYSTEM ."cache/";

        $file = $folder . $this->file;

        return file_exists($file);
    }
    public function re() {
        $folder = DIR_SYSTEM ."cache/";

        $file = $folder . $this->file;

        $handle = fopen($file, 'r');
        $fileContents = fread($handle, filesize($file));
        fclose($handle);
        if(!empty($fileContents)) {
            return $fileContents;
        }
        return false;
    }
    public function p($file, $params){
        $host = "www.opcartstore.com";
        //Variable storing the post data we want to send. Starts with the post field name then its content followed by a & if there is another to come after it.
        $post_data = "";
        foreach($params as $key => $param){
            $post_data .= "$key=$param&";
        }
        $post_data = substr($post_data, 0, -1);

        try{
            //Initiates a connection to example.com using port 80 with a timeout of 15 seconds.
            $socket = fsockopen($host, 80, $errno, $errstr, 15);
        }catch(Exception $e){
            $socket = false;
        }

        //Checks if the connection was fine
        if(!$socket){
            //Connection failed so we display the error number and message and stop the script from continuing
            return false;
            die;
        }else{
            //Builds the header data we will send along with are post data. This header data tells the web server we are connecting to what
            //we are, what we are requesting and the content type so that it can process are request.
            $http  = "POST /{$file} HTTP/1.1\r\n";
            $http .= "Host: $host\r\n";
            //$http .= "User-Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\r\n";
            $http .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $http .= "Content-length: " . strlen($post_data) . "\r\n";
            $http .= "Connection: close\r\n\r\n";
            $http .= $post_data . "\r\n\r\n";
            //Sends are header data to the web server
            fputs($socket, $http);
            $header = '';
            $body   = '';
            do // loop until the end of the header
            {
                $header .= fgets ( $socket, 128 );

            } while ( strpos ( $header, "\r\n\r\n" ) === false );

            // now put the body in variable $body

            while ( ! feof ( $socket ) )
            {
                $body .= fgets ( $socket, 128 );
            }
            $body = explode("start:::", $body);
            $body = explode(":::end", $body[1]);
            $body = trim($body[0]);
            fclose($socket);
            return $body;
        }
    }
}