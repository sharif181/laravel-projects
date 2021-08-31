<?php

namespace App\Http\Traits;

trait DataGetTrait
{
    public function getData($model){

        return $model::paginate(10);
    }
}


