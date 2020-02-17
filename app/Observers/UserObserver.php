<?php

namespace App\Observers;

class UserObserver
{
    public function creating($model)
    {
        $user = auth()->user();
        $model->user_id = $user->id;
    }
}
