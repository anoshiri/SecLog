<?php

namespace App\Observers;

class TeamObserver
{
    public function creating($model)
    {
        $user = auth()->user();
        $model->team_id = $user->currentTeam()->id;
    }
}
