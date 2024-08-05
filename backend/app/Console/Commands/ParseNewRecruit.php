<?php

namespace App\Console\Commands;

use Storage;
use Illuminate\Console\Command;

class ParseNewRecruit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-new-recruit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $json = file_get_contents("app/Console/Commands/spaceMarine.json");
        $json = json_decode($json, true);

        // dd(array_keys($json));

        $selections = $json["roster"]["forces"][0]["selections"];


        $models = [];

        foreach($selections as $selection) {

            $model = [];

            if($selection["type"] != "model") {
                continue;
            }

            $weapons = $selection["selections"];
            $categories = $selection["categories"];
            $rules = $selection["rules"];


            $cost = $selection["costs"][0]["value"];

            $abilities = [];
            $stats = [];


            $id = "";
            $name = "";
            $from = "";

            foreach($selection["profiles"] as $profile) {

                if($profile["typeName"] == "Abilities") {
                    $abilities[] = $profile;
                }

                if($profile["typeName"] == "Unit") {
                    $stats = $profile;

                    $id = $profile["id"];
                    $name = $profile["name"];
                    $from = $profile["from"];
                }
            }

            // dd(array_keys($selection));

            $model = [
                "id" => $id,
                "name" => $name,
                "from" => $from,
                "cost" => $cost,
                "stats" => $stats,
                "abilities" => $abilities,
                "weapons" => $weapons,  
                "categories" => $categories,
                "rules" => $rules
            ];

            $models[] = $model;
        }

        $myfile = fopen("app/Console/Commands/test.json", "w");
        fwrite($myfile, json_encode($models));
        fclose($myfile);
    }
}
