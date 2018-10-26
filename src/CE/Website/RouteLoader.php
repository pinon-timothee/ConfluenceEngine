<?php

namespace CE\Website;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\HttpFoundation\RequestStack;

//Cache
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

//Routing
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;

//Confluence
use CE\Model;

class RouteLoader extends Loader
{
    protected $request_stack = null;
    protected $cache = null;

    public function __construct(RequestStack $request_stack, FilesystemAdapter $cache)
    {
      $this->request_stack = $request_stack;
      $this->cache = $cache;
      $this->host = $this->request_stack->getCurrentRequest()->getHost();
    }

    public function load($resource, $type = null)
    {
      $item = $this->cache->getItem($this->host);
      if (!$item->isHit()) {
        $route_collection = new RouteCollection();
        $request_context = new RequestContext();

        $domains = Model\WebsiteDomainQuery::create()->find();
        foreach ($domains as $domain) {
          $route = new Route($domain->getName(), array(), array(), array('utf8' => true));
          $compiledRoute = $route->compile();
          $variables = $compiledRoute->getVariables();
          $variables = array_flip($variables);
          $route->addRequirements(array_map(function($val) { return $val = '[.a-zA-Z0-9_\/-]+'; }, $variables) );
          $route->addDefaults(array(
              '_website_domain' => &$domain,
              '_host' => $domain->getName(),
              '_variables' => $variables,
              '_variables_counter' => count($variables),
              '_name' => $domain->getId()
          ));
          $route_collection->add($domain->getId(), $route);
        }

        $url_matcher = new UrlMatcher($route_collection, $request_context);
        $url_generator = new UrlGenerator($route_collection, $request_context);

        try {
          $matches = $url_matcher->match('/'.$this->host);

          var_dump('test');
          exit;
        }
        catch (ResourceNotFoundException $e) {
          return $routes = new RouteCollection();
        }

      }

    }

    public function supports($resource, $type = null)
    {
        return 'website' === $type;
    }
}
