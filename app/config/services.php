<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
}, true);

/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);
            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_',
                'compileAlways' => $config->debug
//              Causes following bug: exception 'Phalcon\\Mvc\\View\\Exception' with message 'Compiled template file /{path}/{filename}.volt.php does not exist'
//              'stat' => $config->debug,
            ));

            /**
             * Allow users to easily add styles
             * Syntax: Hello, my {u}name{u} is {b}luke{b} i am {i}18 years old{i}
             * @param string $string
             * @return string
             */
            $volt->getCompiler()->addFilter('style', function($parameters) {
                return "\\Paradoxis\\Filter::style($parameters)";
            });

            /**
             * Limit a string
             * @param string $string
             * @param int $length
             * @return string
             */
            $volt->getCompiler()->addFunction('limit', function($parameters) {
                return "\\Paradoxis\\Filter::limit($parameters)";
            });

            /**
             * Strtotime compatability
             * @param array $parameters
             */
            $volt->getCompiler()->addFunction('strtotime', function($parameters) {
                return "strtotime($parameters)";
            });

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    return new DbAdapter(array(
        'host'         => $config->database->host,
        'username'     => $config->database->username,
        'password'     => $config->database->password,
        'dbname'     => $config->database->dbname,
        "charset"     => "utf8"
    ));
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter();
    $session->start();
    return $session;
});

/**
 * We need to share the configuration
 * @var object
 */
$di->setShared('config', $config);

/**
 * We're going to register a new router
 * @see http://docs.phalconphp.com/en/latest/reference/routing.html
 */
$di->set('router', function () {

    // Here tell the router to not using default routes
    $router = new \Phalcon\Mvc\Router(false);

    // Quick links
    $router->add('/', 'Index::index');
    $router->add('/contact', 'Index::contact');
    $router->add('/diensten', 'Index::diensten');

    // Team
    $router->add('/team', [
        'controller' => 'Team',
        'action' => 'index'
    ]);
    $router->add('/team/{member:[a-z]+}', [
        'controller' => 'Team',
        'action' => 'member'
    ]);

    // Blog
    $router->add('/blog', [
        'controller' => 'Blog',
        'action' => 'index'
    ]);
    $router->add('/blog/page/{page:([0-9]+)}', [
        'controller' => 'Blog',
        'action' => 'index'
    ]);
    $router->add('/blog/search', [
        'controller' => 'Blog',
        'action' => 'search'
    ]);
    $router->add('/blog/search/page/{page:([0-9]+)}', [
        'controller' => 'Blog',
        'action' => 'search'
    ]);
    $router->add('/blog/post/{year:([0-9]{4})}/{month:([0-9]{2})}/{day:([0-9]{2})}/{title}', [
        'controller' => 'Blog',
        'action' => 'post'
    ]);


    // Admin (login, logout)
    $router->add('/admin', [
        'controller' => 'Admin',
        'action' => 'index'
    ]);
    $router->add('/admin/logout', [
        'controller' => 'Admin',
        'action' => 'logout'
    ]);


    // Moderator - add / edit own posts
    // Admin - add posts and assign to others, edit any post
    $router->add('/admin/blog', [
        'controller' => 'Admin',
        'action' => 'blog'
    ]);
    $router->add('/admin/blog/{start:[0-9]+}', [
        'controller' => 'Admin',
        'action' => 'blog'
    ]);
    $router->add('/admin/blog/new', [
        'controller' => 'Admin',
        'action' => 'blogNew'
    ]);
    $router->add('/admin/blog/edit/{id:[0-9]+}', [
        'controller' => 'Admin',
        'action' => 'blogEdit'
    ]);
    $router->add('/admin/blog/delete/{id:[0-9]+}', [
        'controller' => 'Admin',
        'action' => 'blogDelete'
    ]);


    // Admin - edit pages
    $router->add('/admin/pages', [
        'controller' => 'Admin',
        'action' => 'page'
    ]);
    $router->add('/admin/pages/edit/{page:[a-z]+}/{section:[a-z]+}', [
        'controller' => 'Admin',
        'action' => 'pageEdit'
    ]);


    // Test
    $router->add("/test", "Index::test");

    // 404 page
    $router->notFound([
        'controller' => 'Index',
        'action'=> 'notFound'
    ]);

    return $router;
});
