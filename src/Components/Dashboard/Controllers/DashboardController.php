<?php

namespace Components\Dashboard\Controllers;

use Gossamer\Core\MVC\AbstractController;
use Spatie\Async\Pool;

class DashboardController extends AbstractController
{

    public function index() {
        $pool = Pool::create();
        foreach (range(1, 5) as $i) {
            $pool[] = async(function () use ($i) {
                $output = $i * 2;
                return $output;
            })->then(function (int $output) {
                echo $output . "\n";
            });
        }
        await($pool);
    }
}
