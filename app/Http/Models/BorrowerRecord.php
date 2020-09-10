<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowerRecord extends Model
{
    protected $table = 'borrower_records';
    protected $fillable = [
        'book_id',
        'user_id',
        'start_date',
        'end_date',
        'status',
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
