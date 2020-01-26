<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Calculator</title>
        <link rel="stylesheet" href="styles/index.css">
    </head>
    <body>
        <?php
        error_reporting(E_ALL);

        define('APP_PATH', realpath('..'));

        /**
         * Include composer autoloader
         */
        require APP_PATH . '/vendor/autoload.php';

        /**
         * Read the configuration
         */
        $config = require APP_PATH . '/config/app.php';
        
        /**
         * Read the routes table
         */
        $routes = require APP_PATH . '/config/router.php';
        
        $app = new Calculator\Application\Handler($config, $routes);

        /**
         * call Calculator's Application for handle request
         */
        echo $app->handle();

        ?>
        
        <script type="text/javascript" src="scripts/index.js"></script>
    </body>
</html>
