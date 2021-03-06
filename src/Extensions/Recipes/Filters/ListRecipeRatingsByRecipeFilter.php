<?php

namespace Extensions\Recipes\Filters;

use Components\Blogs\Models\BlogComment;
use Extensions\Recipes\Models\Recipe;
use Extensions\Recipes\Models\RecipeRating;
use Gossamer\Horus\Filters\AbstractCachableFilter;
use Gossamer\Horus\Filters\FilterChain;
use Gossamer\Horus\Http\HttpRequest;
use Gossamer\Horus\Http\HttpResponse;

class ListRecipeRatingsByRecipeFilter extends AbstractCachableFilter
{

    public function execute(HttpRequest &$request, HttpResponse &$response, FilterChain &$chain) {
        $blog = $request->getImplicitParameter('Components\\Blogs\\Models\\Blog');

        $recipe = Recipe::where('blogs_id', $blog->id)->first();

        $ratings = RecipeRating::where('recipes_id', $recipe->id)
            ->join('users', 'users.id','recipe_ratings.created_by')->get();

        $request->setAttribute('recipe', $recipe);
        $request->setAttribute('ratings', $ratings);

        parent::execute($request, $response, $chain); // TODO: Change the autogenerated stub
    }

}
