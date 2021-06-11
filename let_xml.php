<?php

/**
 * @param $url
 * @param null $callback
 * @param false $associative
 * @return false|mixed|string
 *
 * @throws Exception
 */
function let_xml($url, $callback = null, $associative = false)
{
    if (empty($url)){
        throw new Exception("Url: " . $url . " is empty");
    }

    $urls = [];
    if (!is_array($url)){
        $urls[] = $url;
    }

    $file = "";
    foreach($urls as $url){
        if (!file_exists($url)) {
            throw new Exception("Url: " . $url . " not exist");
        }
        $file .= file_get_contents($url, true);
    }

    if (is_callable($callback)) {
        return $callback($file);
    }

    return $file;
}


/**
 * Class LetJson
 */
class LetXml
{
    /** @var array|mixed */
    public $xml = [];

    /** @var string  */
    public $url = '';

    /**
     * LetJson constructor.
     * @param $url
     */
    function __construct($url)
    {
        $this->url = $url;
        $this->xml = let_xml($url);
    }

    /**
     * @return mixed
     */
    function first()
    {
        return $this->xml[0];
    }

    /**
     * @param $callback
     */
    function each($callback)
    {
        foreach ($this->xml as $item) {
            $callback($item);
        }
    }
}