<?php

namespace App\Helpers;

 abstract class BaseDTO
{
     public function __construct(array $data = [])
     {
         foreach ($data as $key => $value) {
             if (property_exists($this, $key)) {
                 $this->{$key} = $value;
             }
         }
     }

     public function toArray()
     {
         return get_object_vars($this);
     }
}
