<?php

namespace Tests\Unit\Http\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Models\User;
use App\Http\Models\Location;
use App\Http\Models\Book;
use App\Http\Models\Role;
use App\Http\Models\Comment;
use App\Http\Models\BorrowerRecord;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        $this->user = new User();
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->user);
        parent::tearDown();
    }

    public function test_table_name()
    {
        $this->assertEquals('users', $this->user->getTable());
    }

    public function test_fillable()
    {
        $this->assertEquals([
            'code',
            'name',
            'user_slug',
            'email',
            'phone_number',
            'username',
            'password',
            'role_id',
        ], $this->user->getFillable()
        );
    }

    public function hidden()
    {
        $this->assertEquals([
            'password',
            'remember_token',
        ], $this->user->getHidden()
        );
    }

    public function test_hasMany_locations()
    {
        $relation = $this->user->locations();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertInstanceOf(Location::class, $relation->getRelated());
        $this->assertEquals('user_id', $relation->getForeignKeyName());
    }

    public function test_hasMany_books()
    {
        $relation = $this->user->books();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertInstanceOf(Book::class, $relation->getRelated());
        $this->assertEquals('user_id', $relation->getForeignKeyName());
    }

    public function test_hasMany_comments()
    {
        $relation = $this->user->comments();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertInstanceOf(Comment::class, $relation->getRelated());
        $this->assertEquals('user_id', $relation->getForeignKeyName());
    }

    public function test_hasMany_borrowerRecords()
    {
        $relation = $this->user->borrowerRecords();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertInstanceOf(BorrowerRecord::class, $relation->getRelated());
        $this->assertEquals('user_id', $relation->getForeignKeyName());
    }

    public function test_belongsToMany_favoriteBooks()
    {
        $relation = $this->user->favoriteBooks();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('favorite_books', $relation->getTable());
        $this->assertEquals('user_id', $relation->getForeignPivotKeyName());
        $this->assertEquals('book_id', $relation->getRelatedPivotKeyName());
    }

    public function test_belongsTo_role()
    {
        $relation = $this->user->role();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertInstanceOf(Role::class, $relation->getRelated());
        $this->assertEquals('role_id', $relation->getForeignKeyName());
        $this->assertEquals($this->user->getKeyName(), $relation->getOwnerKeyName());
    }

    public function test_belongsToMany_following()
    {
        $relation = $this->user->following();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('followers', $relation->getTable());
        $this->assertEquals('follower_id', $relation->getForeignPivotKeyName());
        $this->assertEquals('followed_id', $relation->getRelatedPivotKeyName());
    }

    public function test_belongsToMany_followed()
    {
        $relation = $this->user->followed();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('followers', $relation->getTable());
        $this->assertEquals('followed_id', $relation->getForeignPivotKeyName());
        $this->assertEquals('follower_id', $relation->getRelatedPivotKeyName());
    }

    public function test_belongsToMany_publisher()
    {
        $relation = $this->user->publishers();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('books', $relation->getTable());
        $this->assertEquals('user_id', $relation->getForeignPivotKeyName());
        $this->assertEquals('publisher_id', $relation->getRelatedPivotKeyName());
    }


}
