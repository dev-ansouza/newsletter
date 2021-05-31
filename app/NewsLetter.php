<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model {

    protected $table = 'newsletters';

    protected $fillable = ['titulo', 'text', 'user_id', 'created_at', 'updated_at'];
}
