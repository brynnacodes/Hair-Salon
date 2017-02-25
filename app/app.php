<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();

    $server = 'mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    $app->register(new Silex\Provider\TwigServiceProvider(), ["twig.path" => __DIR__."/../views"]);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get('/', function() use($app) {

        return $app["twig"]->render("homepage.html.twig", ['stylists' => Stylist::getAll(), 'clients' => Client::getAll()]);
    });

    $app->post('/add_stylist', function() use($app) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $new_stylist = new Stylist($name, $description);
        $new_stylist->save();
        return $app["twig"]->render("homepage.html.twig", ['stylists' => Stylist::getAll()]);
    });

    $app->post("/delete_stylists", function() use ($app) {
    Stylist::deleteAll();
    return $app->redirect('/');
    });

    $app->get('/stylists/{id}', function($id) use($app)  {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig', ['stylist' => $stylist, 'clients' => $stylist->getClients()]);
    });

    $app->post('/stylists/{id}', function($id) use($app) {
        $stylist = Stylist::find($id);
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $new_client = new Client($name, $phone, $id);
        $new_client->save();
        return $app['twig']->render('stylist.html.twig', ['stylist' => $stylist, 'clients' => $stylist->getClients()]);
    });

    $app->get('/stylists/{id}/edit', function($id) use($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig', ['stylist' => $stylist]);
    });

    $app->patch('/stylists/{id}', function($id) use($app) {
        $description = $_POST['description'];
        $stylist = Stylist::find($id);
        $stylist->updateDescription($description);
        return $app['twig']->render('stylist.html.twig', ['stylist' => $stylist, 'clients' => $stylist->getClients()]);
    });

    $app->delete('/stylists/{id}', function($id) use($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app->redirect('/');
    });

    $app->get('/clients/{id}/edit', function($id) use($app)  {
        $client = Client::find($id);
        return $app['twig']->render('client_edit.html.twig', ['client' => $client]);
    });

    $app->patch('/clients/{id}/edit', function($id) use($app) {
        $phone = $_POST['phone'];
        $client = Client::find($id);
        $client->updatePhone($phone);
        return $app->redirect('/');
    });

    $app->delete('/clients/{id}', function($id) use($app) {
        $client = Client::find($id);
        $client->delete();
        return $app->redirect('/');
    });

    $app->post("/delete_clients", function() use ($app) {
    Client::deleteAll();
    return $app->redirect('/');
    });

    return $app;
?>
