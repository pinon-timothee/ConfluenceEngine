<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

//Routing
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RouteCollectionBuilder;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;

// Propel
use Propel\Runtime\Propel;
use Propel\Common\Config\ConfigurationManager;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\ActiveQuery\Criteria;

//Cache
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

//Yaml
use Symfony\Component\Yaml\Yaml;

//Filesystem
use Symfony\Component\Filesystem\Filesystem;

//Confluence
use CE\Model;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    protected $confluence_cache = null;
    protected $website_cache = null;

    public function getCacheDir()
    {
        return $this->getProjectDir().'/var/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        return $this->getProjectDir().'/var/log';
    }

    public function registerBundles()
    {
        $contents = require $this->getProjectDir().'/config/bundles.php';
        foreach ($contents as $class => $envs) {
            if (isset($envs['all']) || isset($envs[$this->environment])) {
                yield new $class();
            }
        }
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader)
    {
        $container->addResource(new FileResource($this->getProjectDir().'/config/bundles.php'));
        // Feel free to remove the "container.autowiring.strict_mode" parameter
        // if you are using symfony/dependency-injection 4.0+ as it's the default behavior
        $container->setParameter('container.autowiring.strict_mode', true);
        $container->setParameter('container.dumper.inline_class_loader', true);
        $confDir = $this->getProjectDir().'/config';

        $loader->load($confDir.'/{packages}/*'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/{packages}/'.$this->environment.'/**/*'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/{services}'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/{services}_'.$this->environment.self::CONFIG_EXTS, 'glob');

        $this->confluence_cache = new FilesystemAdapter('', 0, $this->getCacheDir());
        $container->set('confluence.cache', $this->website_cache);

        // service website

        unset($_SERVER['HTTP_HOST']);

        if (isset($_SERVER['HTTP_HOST'])) {

          $configManager = new ConfigurationManager(__DIR__.'/../config/packages/propel.yaml');
          $manager = new ConnectionManagerSingle();
          $manager->setConfiguration( $configManager->getConnectionParametersArray()[ 'default' ] );
          $manager->setName('default');
          $serviceContainer = Propel::getServiceContainer();
          $serviceContainer->setAdapterClass('default', 'mysql');
          $serviceContainer->setConnectionManager('default', $manager);
          $serviceContainer->setDefaultDatasource('default');

          $route_collection = new RouteCollection();
          $request_context = new RequestContext();

          $domains = Model\WebsiteDomainQuery::create()->joinWithWebsite()->find();
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
            $matches = $url_matcher->match('/'.$_SERVER['HTTP_HOST']);

            $this->website_cache = new FilesystemAdapter('', 0, $this->getProjectDir().'/var/cache/'.$this->environment.'/websites/'.$matches['_website_domain']->getWebsiteId());

            $container->setParameter('confluence.website.id', $matches['_website_domain']->getWebsiteId());
            $container->set('confluence.website', $matches['_website_domain']->getWebsite());
            $container->set('confluence.website.cache', $this->website_cache);
          }
          catch (ResourceNotFoundException $e) {}

        }
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $confDir = $this->getProjectDir().'/config';

        $routes->import($confDir.'/{routes}/*'.self::CONFIG_EXTS, '/', 'glob');
        $routes->import($confDir.'/{routes}/'.$this->environment.'/**/*'.self::CONFIG_EXTS, '/', 'glob');
        $routes->import($confDir.'/{routes}'.self::CONFIG_EXTS, '/', 'glob');

        // website
        if ($this->container->hasParameter('confluence.website.id')) {

          $cacheDir = $this->getProjectDir().'/var/cache/'.$this->environment.'/websites/'.$this->container->getParameter('confluence.website.id');
          $routesDir = $cacheDir.'/routes';

          // website bdd routes
          $item = $cache->getItem('confluence.routes');
          if (!$item->isHit()) {

            $website_routings_query = Model\WebsiteRoutingQuery::create();
            if ($this->container->hasParameter('confluence.website.id')) $website_routings->filterByWebsiteId($this->container->getParameter('confluence.website.id'));
            $website_routings = $website_routings_query->find();

            $routings = array();
            foreach ($website_routings as $key => $website_routing) {

              foreach ($website_routing->getWebsiteRoutingPaths() as $path_key => &$path) {

                $routing = array();

                if (preg_match('/^(https?:)?\/\/.*/', $path->getPath())) $routing['path'] = $path->getPath();
                else $routing['path'] = '/'.strtolower(str_replace('_', '-', $path->getCulture())).$path->getPath();

                $routing['defaults'] = ['segment_separators' => ['/']];
                $routing['utf8'] = true;
                $routing['host'] = Model\WebsiteDomainQuery::create()->filterByWebsiteId($website_routing->getWebsiteId())->select(['name'])->findOne();

                $routings[strtolower(str_replace('_', '-', $path->getCulture())).'_'.$key.'_'.$path_key] = $routing;
              }

            }

            $fileSystem = new Filesystem();
            if (false === $fileSystem->exists($routesDir)) $fileSystem->mkdir($routesDir);
            if (true === $fileSystem->exists($routesDir.'/website-routing.yml')) $fileSystem->remove($routesDir.'/website-routing.yml');
            $fileSystem->dumpFile($routesDir.'/website-routing.yml', Yaml::dump($routings));

            $item->set($routesDir.'/website-routing.yml');
            $this->website_cache->save($item);
          }
          // website bdd redirections

          // website import ressouces
          $routes->import($routesDir, '/', 'glob');

        }
        else {
          
        }
    }
}
