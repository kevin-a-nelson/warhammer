<?php

namespace App\Console\Commands;

use App\Models\Ability;
use App\Models\Category;
use App\Models\Minature;
use App\Models\Weapon;
use App\Models\Rule;
use Illuminate\Console\Command;
use Storage;

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

        $minature = $models[0];

        $newMinature = Minature::create([
            'newRecruitId' => $minature['id'],
            'name' => $minature['name'],
            'from' => $minature['from'],
            'cost' => $minature['cost'],
            'movement' => $minature['stats']['characteristics'][0]['$text'],
            'toughness' => $minature['stats']['characteristics'][1]['$text'],
            'armor_save' => $minature['stats']['characteristics'][2]['$text'],
            'wounds' => $minature['stats']['characteristics'][3]['$text'],
            'leadership' => $minature['stats']['characteristics'][4]['$text'],
            'objective_control' => $minature['stats']['characteristics'][5]['$text'],
        ]);

        // dd($newMinature->id);

        foreach($minature['abilities'] as $ability) {
            $newAbility = Ability::create([
                'newRecruitId' => $ability['id'],
                'name' => $ability['name'],
                'description' => $ability["characteristics"][0]['$text'],
                'from' => $ability['from'],
            ]);

            $newMinature->abilities()->attach($newAbility->id, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach($minature['weapons'] as $weapon) {
            $newWeapon = Weapon::create([
                'newRecruitId' => $weapon['profiles'][0]['id'],
                'name' => $weapon['profiles'][0]['name'],
                'typeId' => $weapon['profiles'][0]['typeId'],
                'typeName' => $weapon['profiles'][0]['typeName'],
                'from' => $weapon['profiles'][0]['from'],
                'range' => $weapon['profiles'][0]['characteristics'][0]['$text'],
                'attack' => $weapon['profiles'][0]['characteristics'][0]['$text'],
                'combat_skill' => $weapon['profiles'][0]['characteristics'][0]['$text'],
                'strength' => $weapon['profiles'][0]['characteristics'][0]['$text'],
                'armor_penetration' => $weapon['profiles'][0]['characteristics'][0]['$text'],
                'damage' => $weapon['profiles'][0]['characteristics'][0]['$text'],
            ]);

            $newMinature->weapons()->attach($newWeapon->id, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach($minature['categories'] as $category) {
            $newCategory = Category::create([
                'newRecruitId' => $category['id'],
                'name' => $category['name'],
                'primary' => $category['primary'],
            ]);

            $newMinature->categories()->attach($newCategory->id, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach($minature['rules'] as $rule) {
            $newRule = Rule::create([
                'description' => $rule['description'],
                'newRecruitId' => $rule['id'],
                'name' => $rule['name'],
                'page' => $rule['page'] ?? null,
            ]);

            $newMinature->rules()->attach($newRule->id, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // $minature->save();

        // $myfile = fopen("app/Console/Commands/test.json", "w");
        // fwrite($myfile, json_encode($models));
        // fclose($myfile);
    }
}
