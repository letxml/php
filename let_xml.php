<?php

/**
 * @param array|string $url
 * @param null $callback
 * @param false $associative
 * @return false|mixed|string
 *
 * @throws Exception
 */
function let_xml($url, $callback = null, $associative = false)
{
    if (empty($url)){
        throw new Exception("Url: $url is empty");
    }
//    var_dump($url);

    $urls = [];
    if (!is_array($url)){
        $urls[] = $url;
    } else {
        $urls = $url;
    }

    $file = '';
    foreach($urls as $url_item){
        if (!file_exists($url_item)) {
            throw new Exception("Url: $url_item not exist");
        }
        $file .= file_get_contents($url_item, true);
        echo $url_item;
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