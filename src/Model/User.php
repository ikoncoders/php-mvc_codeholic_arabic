<?php 

namespace Ikonc\PhpMvc\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;
class User extends Eloquent
{
    protected $fillable =[
        'username','full_name','email'
    ];

    public $timestamp = [];
}