<?php

namespace App\Repositories\User;

use App\Http\Models\User;

interface UserRepoInterface
{
    public function getBooksFromUser($slug, $keywords);
    public function checkFollow(User $user, $user_id);
    public function follow($id, $user_id);
    public function unfollow($id, $user_id);
    public function getNonAdminUser();
    public function getLatestUsers();
}
