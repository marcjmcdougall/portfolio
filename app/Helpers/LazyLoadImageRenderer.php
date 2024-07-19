<?php

namespace App\Helpers;

use League\CommonMark\Node\Node;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Renderer\ChildNodeRendererInterface;

class LazyLoadImageRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        // \Log::info('LazyLoadImageRenderer called.');

        if ( ( $node instanceof Image ) ) {
            $attrs = $node->data->get('attributes');
            $attrs['src'] = '';
            $attrs['alt'] = $node->getTitle() ?? '';
            $attrs['loading'] = 'lazy';
            $attrs['class'] = 'lazy';
            $attrs['data-src'] = $node->getUrl() ?? '';

            // \Log::info('LazyLoadImageRenderer called for image: ' . $node->getUrl());

            return new HtmlElement('img', $attrs, '', true);
        }

        // \Log::info('Node is not an instance of Image. Node type: ' . get_class($node));

        return null;
    }
}