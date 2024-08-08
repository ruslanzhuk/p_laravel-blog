<?php

namespace App\Http\Controllers;
use Tonysm\TurboLaravel\Http\MultiplePendingTurboStreamResponse;

class JakisController
{
    public function store() : MultiplePendingTurboStreamResponse
    {
        $klaymore = $_POST['klaymore'];

        return response("Hellow World! I entered \"$klaymore\"");
        /*return response()->turboStream([
            response()->turboStream()->replace(dom_id('klaymore', $_POST[`klaymore`])->view())
        ]);*/
    }
}
