<?php

namespace tests\Database;

use Gossamer\Core\MVC\AbstractModel;
use Illuminate\Database\Eloquent\Model;
use tests\Database\Seeds\Blogs\BlogCategoriesSeedData;
use tests\Database\Seeds\Blogs\BlogCommentsSeedData;
use tests\Database\Seeds\Blogs\BlogsSeedData;
use tests\Database\Seeds\Dashboard\SettingGroupsSeedData;
use tests\Database\Seeds\Dashboard\SettingsSeedData;
use tests\Database\Seeds\Recipes\RecipeCategoriesSeedData;
use tests\Database\Seeds\Recipes\RecipeRatingsSeedData;
use tests\Database\Seeds\Recipes\RecipesRecipeCategoriesSeedData;
use tests\Database\Seeds\Recipes\RecipesSeedData;
use tests\Database\Seeds\Users\UsersSeedData;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder
{


    public function execute()
    {
        $seeds
            = [
            new SettingGroupsSeedData(),
            new SettingsSeedData(),
            new BlogCategoriesSeedData(),
            new BlogsSeedData(),
            new BlogCommentsSeedData(),
            new UsersSeedData(),
            new RecipesSeedData(),
            new RecipeCategoriesSeedData(),
            new RecipesRecipeCategoriesSeedData(),
            new RecipeRatingsSeedData()
        ];
        //disable foreign key check for this connection before running seeders

        AbstractModel::query('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($seeds as $seed) {
            $data = $seed->getData();
            $seed->getClass()::query()->insert($data);
        }

        //re-enable foreign key checks now that we're completed with all seeding
        AbstractModel::query('SET FOREIGN_KEY_CHECKS=1;');
    }
}
