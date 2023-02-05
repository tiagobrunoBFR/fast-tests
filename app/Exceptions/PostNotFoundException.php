<?php

namespace App\Exceptions;

class PostNotFoundException extends \Exception
{
   public function render(){
       return response()->json(['error' => 'Post not found'], 404);
   }
}
