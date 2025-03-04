<?php

namespace App\Extensions\CommonMark;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\Config\ConfigurationAwareInterface;
use League\Config\ConfigurationInterface;
use League\CommonMark\Util\HtmlElement;

class NewTabLinkExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        // Add an event listener to process links after parsing
        $environment->addEventListener(DocumentParsedEvent::class, [$this, 'processLinks']);
        
        // Register our custom link renderer (this will override the default one)
        $environment->addRenderer(Link::class, new NewTabLinkRenderer(), 10); // Higher priority to override default
    }
    
    /**
     * Process all links in the document
     */
    public function processLinks(DocumentParsedEvent $event): void
    {
        $document = $event->getDocument();
        $this->processNode($document);
    }
    
    /**
     * Recursively process each node in the document
     */
    private function processNode(Node $node): void
    {
        // Process children first (depth-first traversal)
        foreach ($node->children() as $child) {
            $this->processNode($child);
        }
        
        // If this is a link node, check if it needs to open in a new tab
        if ($node instanceof Link) {
            $label = $node->firstChild() ? $node->firstChild()->getLiteral() : null;
            
            // Check if the label ends with a caret
            if ($label && substr($label, -1) === '^') {
                // Remove the caret from the label
                $node->firstChild()->setLiteral(substr($label, 0, -1));
                
                // Set a custom attribute to indicate this link should open in a new tab
                $node->data->set('newTab', true);
            }
        }
    }
}

/**
 * Custom renderer for links that implements the NodeRendererInterface directly
 * instead of extending the final LinkRenderer class
 */
class NewTabLinkRenderer implements NodeRendererInterface, ConfigurationAwareInterface
{
    private $config;
    
    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->config = $configuration;
    }
    
    /**
     * @param Link $node
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        if (!($node instanceof Link)) {
            throw new \InvalidArgumentException('Incompatible node type: ' . \get_class($node));
        }

        $attrs = $node->data->get('attributes', []);
        
        // Handle URL
        $url = $node->getUrl();
        if ($url === '') {
            $attrs['href'] = '';
        } else {
            // Instead of using a specific helper method, we'll use the URL as-is
            // Laravel's Blade will automatically escape it when rendering
            $attrs['href'] = $url;
        }
        
        // Handle title
        if (($title = $node->getTitle()) !== null) {
            $attrs['title'] = $title;
        }
        
        // If this link should open in a new tab, add the target and rel attributes
        if ($node->data->has('newTab') && $node->data->get('newTab')) {
            $attrs['target'] = '_blank';
            $attrs['rel'] = 'noopener noreferrer';
        }
        
        return new HtmlElement('a', $attrs, $childRenderer->renderNodes($node->children()));
    }
}