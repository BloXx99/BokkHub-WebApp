<?php

function display($value){
    if($value == NULL){
      return "Not given";
    }
    else{
      return strval($value);
    }
  }


  function IsAdmin($value){
    if($value == 0){
      return "User";
    }
    if($value == 1){
        return "Admin";
    }
  }


  function proposition($value){
    if($value == 0){
      return "Book";
    }
    if($value == 1){
        return "Author";
    }
  }

  function description($value){

    if($value == null){
      return "Description not provided";
    }
    else{
      return $value;
    }
  }


?>