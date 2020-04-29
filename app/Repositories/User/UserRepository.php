<?php

namespace App\Repositories\User;

use App\Repositories\ModelRepository;
use App\Http\Models\User;
use App\Http\Models\Book;
use App\Http\Models\Location;
use Illuminate\Support\Str;

class UserRepository extends ModelRepository implements UserRepoInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getBooksFromUser($slug, $keywords)
    {
        $data = [
            'slug' => $slug,
        ];
        $user = $this->findByAttrGetOne($data);
        $books = $user->books()->where('name', 'LIKE', "%{$keywords}%")
            ->orderBy('name')->paginate(config('const.take'));

        return $books;
    }

    public function checkFollow(User $user, $user_id)
    {
        return $user->followed()->wherePivot('follower_id', $user_id)->exists();
    }

    public function follow($id, $user_id)
    {
        $user = $this->findById($id);
        $user->followed()->attach($user_id);
    }

    public function unfollow($id, $user_id)
    {
        $user = $this->findById($id);
        $user->followed()->detach($user_id);
    }

    public function update($id, $data = [])
    {
        $user = $this->findById($id);
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->user_slug = Str::slug($data['name']);
        $user->email = $data['email'];
        $user->phone_number = $data['phone_number'];
        $user->role_id = $data['role_id'];
        $locations = Location::where('user_id', $id)->get();
        foreach ($locations as $key => $location) {
            $location->apartment_number = $data['apartment_number'][$key];
            $location->street = $data['street'][$key];
            $location->ward = $data['ward'][$key];
            $location->district = $data['district'][$key];
            $location->city = $data['city'][$key];
            $location->save();
            $user->locations()->save($location);
        }
        $user->save();
    }
}
