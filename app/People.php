<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model {

	protected $table = 'peoples';

    protected $fillable = ['nome', 'email', 'user_id', 'created_at', 'updated_at'];
}
