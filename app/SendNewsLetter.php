<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SendNewsLetter extends Model {

	protected $table = 'sendnewsletters';

    protected $fillable = ['newsletter_id', 'people_id', 'user_id', 'created_at', 'updated_at'];
}
