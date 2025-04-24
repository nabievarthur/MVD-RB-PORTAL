<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;

class NewsPolicy
{

    public function create(User $user): bool
    {
        return $user->isModerator() || $user->isAdmin();
    }

    public function update(User $user, News $news): bool
    {
        return $user->isAdmin() || ($user->isModerator() && $user->id === $news->user_id);
    }

    public function delete(User $user, News $news): bool
    {
        return $user->isAdmin() || ($user->isModerator() && $user->id === $news->user_id);
    }


}
