<?php

namespace App\Services;

use App\Models\Ability;
use App\Models\Category;
use App\Models\Minature;
use App\Models\Weapon;
use App\Models\MinatureWeapon;
use App\Models\Rule;

class ParseNewRecruitService
{
    public static function parse($json, $board_id)
    {
        $json = json_decode($json, true);

        $selections = $json["roster"]["forces"][0]["selections"];


        $models = [];

        foreach ($selections as $selection) {

            $model = [];

            if ($selection["type"] != "model" && $selection["type"] != "unit") {
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

            foreach ($selection["profiles"] as $profile) {

                if ($profile["typeName"] == "Abilities") {
                    $abilities[] = $profile;
                }

                if ($profile["typeName"] == "Unit") {
                    $stats = $profile;

                    $id = $profile["id"];
                    $name = $profile["name"];
                    $from = $profile["from"];
                }
            }

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

        $xCord = 0;
        $yCord = 0;

        foreach ($models as $minature) {

            $newMinature = Minature::firstOrCreate([
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
                'size' => rand(50, 100),
            ]);

            $newMinature->boards()->syncWithoutDetaching([$board_id => [
                'xCord' => $xCord,
                'yCord' => $yCord,
                'created_at' => now(),
                'updated_at' => now(),
            ]]);

            $xCord += 100;
            $yCord += 100;

            foreach ($minature['abilities'] as $ability) {


                $newAbility = Ability::firstOrCreate([
                    'newRecruitId' => $ability['id'],
                    'name' => $ability['name'],
                    'description' => $ability["characteristics"][0]['$text'],
                    'from' => $ability['from'],
                ]);

                $newMinature->abilities()->syncWithoutDetaching([$newAbility->id => [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]]);
            }

            foreach ($minature['weapons'] as $weapon) {

                $newWeapon = Weapon::firstOrCreate([
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

                MinatureWeapon::firstOrCreate([
                    'minature_id' => $newMinature->id,
                    'weapon_id' => $newWeapon->id,
                    'board_id' => $board_id,
                ]);
            }

            foreach ($minature['categories'] as $category) {

                $newCategory = Category::firstOrCreate([
                    'newRecruitId' => $category['id'],
                    'name' => $category['name'],
                    'primary' => $category['primary'],
                ]);

                $newMinature->categories()->syncWithoutDetaching([$newCategory->id => [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]]);
            }

            foreach ($minature['rules'] as $rule) {

                $newRule = Rule::firstOrCreate([
                    'description' => $rule['description'],
                    'newRecruitId' => $rule['id'],
                    'name' => $rule['name'],
                    'page' => $rule['page'] ?? null,
                ]);

                $newMinature->rules()->syncWithoutDetaching([$newRule->id => [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]]);
            }
        }
    }
}