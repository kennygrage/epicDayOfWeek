<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/DayCalc.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));


    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/view_result", function() use ($app) {
        $day = new DayCalc;
        $date = $_GET['date'];
        $day_of_week = $day->calcDay($date);
        $date_array = explode("-", $date);
        $month_array = array("1", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $month_number = intval($date_array[1]);
        $day_number = intval($date_array[2]);
        $year_number = intval($date_array[0]);
        $date_for_output = "$month_array[$month_number] $day_number, $year_number";

        return $app['twig']->render('result.html.twig', array('day' => $day_of_week, 'date' => $date_for_output));
    });
    return $app;
?>
