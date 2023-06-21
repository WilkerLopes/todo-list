<?php
class Sanitize
{

  public function __construct($input)
  {
    if (is_array($input)) {
      return array_map('sanitizeInput', $input);
    }

    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
  }
}
