<?php

class HtmlElement
{
    private $attributes = [];

    private $tag;

    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }
    }

    public function html($innerHTML = '')
    {
        $html = "<{$this->tag}";

        foreach ($this->attributes as $key => $value) {
            $html .= ' ' . $key . '="' . $value . '"';
        }

        $html .= '>';
        $html .= $innerHTML;
        $html .= "</{$this->tag}>";

        return $html;
    }
}

$article = new HtmlElement('article');

$article->id = 'main';
$article->class = 'light';

// show the attributes
echo $article->class . "<br />"; // light
echo $article->id; // main

?>