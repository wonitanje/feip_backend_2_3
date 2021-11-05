<?php

namespace App\Sanitizers;

use App\Sanitizers\TrimPhone;

class AppealSanitizer
{
  public static function sanitize(array $values): array
  {
    if (isset($values['phone'])) {
      $values['phone'] = TrimPhone::handle($values['phone']);
    }

    return $values;
  }
}
