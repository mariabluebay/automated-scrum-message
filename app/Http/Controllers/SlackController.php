<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SlackController extends Controller
{
    /**
     * Send the message to the channel.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function notify(Request $request): RedirectResponse
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        return redirect()->route('dashboard')
            ->withSuccess('Message sent: ' . $request->text);
    }
}
