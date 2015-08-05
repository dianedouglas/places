<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Place.php";

    $app = new Silex\Application();

    session_start();
    if (empty($_SESSION['list_of_places'])) {
        $_SESSION['list_of_places'] = array();
    }

    $app->get("/", function() {

        $output = "";

        if (!empty(Place::getAll())) {
            $output .= "
                <h1>Places I've been</h1>
                <p>Here are all your places:</p>
            ";

            foreach (Place::getAll() as $place) {
                $output = $output . "<p>" . $place->getName() . "</p>";
            }
        }

        $output .= "
                      <form action='/places' method='post'>
                          <label for='name'>Place Name</label>
                          <input id='name' name='name' type='text'>

                          <button type='submit'>Add Place</button>
                      </form>
                  ";

        $output .= "
                      <form action='/delete_places' method='post'>
                          <button type='submit'>Clear</button>
                      </form>
                    ";

        return $output;
    });

    $app->post("/places", function() {
      $place = new Place($_POST['name']);
      $place->save();
      return "
          <h1>You added a new place!</h1>
          <p>" . $place->getName() . "</p>
          <p><a href='/'>View your list of all places.</a></p>
      ";

    });

    $app->post("/delete_places", function() {

      Place::deleteAll();

      return "
          <h1>List cleared!</h1>
          <p><a href='/'>Home</a></p>
      ";

    });

    return $app;
?>
