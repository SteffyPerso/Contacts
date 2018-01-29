<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
	protected $fillable = ['prenom','nom','date_naissance','email','telephone','service','adresse','cp','ville'];
}
