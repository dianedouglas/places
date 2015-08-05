<?php

class Place
{
  private $name;

  function __construct($new_place_name)
  {
    $this->name = $new_place_name;
  }

  function setName($new_name)
  {
    $this->name = $new_name;
  }

  function getName()
  {
    return $this->name;
  }

  function save()
  {
    array_push($_SESSION['list_of_places'], $this);
  }

  static function getAll()
  {
      return $_SESSION['list_of_places'];
  }

  static function deleteAll()
  {
      $_SESSION['list_of_places'] = array();
  }
}
