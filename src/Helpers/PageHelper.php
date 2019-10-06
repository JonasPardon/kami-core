<?php

namespace JonasPardon\KamiCore\Helpers;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class PageHelper
{
    public static function parseToHtml($page)
    {
        $body = '';
        $blocks = '';

        if ($page['body']) {
            $body = self::parseMarkdownToHtml($page->body);
        }

        if (sizeof($page->blocks) > 0) {
            foreach($page->blocks as $i => $block) {
                $blocks .= self::parseBlockToHtml($block);
            }
        }

        $body = Str::replaceFirst('{{ blocks }}', $blocks, $body);

        return $body;
    }

    public static function parseMarkdownToHtml($data)
    {
        $parseDown = new \Parsedown();
        return new HtmlString($parseDown->text($data));
    }

    private static function parseBlockToHtml($block)
    {
        $returnString = '';
        $classLabel = str_replace(' ', '-', (Str::lower($block->label)));

        if ($block->type === 'textarea') {
            $returnString = self::parseMarkdownToHtml($block->content);
        }

        return "<div class='content-block content-block--{$classLabel}'>{$returnString}</div>";
    }
}
