<?php

namespace App\repositories\contracts;

use Illuminate\Database\Eloquent\Collection;

interface MessageRepositoryContract{
    public function all():Collection;
}
