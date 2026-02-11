<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use Illuminate\Http\Response;

final class InviteAcceptanceController
{
    public function __invoke(string $invite): Response
    {
        return response("Invite {$invite} accepted");
    }
}
