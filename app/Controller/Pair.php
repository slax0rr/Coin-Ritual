<?php
namespace Controller;

use \Exception;
use \View\AddPair;
use \Model\Warrior;
use \Model\Pair as PairModel;

class Pair
{
    public function view()
    {
        $data = ["warriorList" => (new Warrior())->getAll()];
        new AddPair($data, ["cache" => false]);
    }

    public function present()
    {
        new \View\Present([], ["cache" => false]);
    }

    public function add_post()
    {
        if (isset($_POST["warrior1"]) && $_POST["warrior1"] === "0"
            && isset($_POST["warrior2"]) && $_POST["warrior2"] === "0") {
            header("HTTP/1.1 500 Internal Server Error");
            throw new Exception("Warriors were not chosen");
        }
        if ($_POST["warrior1"] === $_POST["warrior2"]) {
            header("HTTP/1.1 500 Internal Server Error");
            throw new Exception("Needs different warriors!");
        }
        $pair = new PairModel();
        $id = $pair->add($_POST["warrior1"], $_POST["warrior2"]);

        echo json_encode(["insertedId" => $id, "warriors" => [$_POST["warrior1"], $_POST["warrior2"]]]);
    }
}
