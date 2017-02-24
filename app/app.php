<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $server = 'mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    $app->register(new Silex\Provider\TwigServiceProvider(), ["twig.path" => __DIR__."/../views"]);

    $app->get('/', function() use($app) {

        return $app["twig"]->render("homepage.html.twig", ['stylists' => Stylist::getAll()]);
    });

    $app->post('add_stylist', function() use($app) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $new_stylist = new Stylist($name, $description);
        $new_stylist->save();
        return $app->redirect('/');
    });

    $app->get('/stylists/{id}', function($id) use($app)  {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig', ['stylist' => $stylist]);
    });

    return $app;
?>
