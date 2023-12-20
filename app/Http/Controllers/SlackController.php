<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
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

        try
        {
            $client = new Client();

            $data['channel'] = 'api';
            $data['text'] = $request->text;
            $data['username'] = 'SCRUMAPI';
            $data['icon_emojii'] = ':ghost:';

            $formData = json_encode($data);


            $client->request(
                "POST",
                'https://hooks.slack.com/services/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',
                ['body' => $formData],
            );

            return redirect()->route('dashboard')
                ->withSuccess('Message sent: ' . $request->text);

        } catch (Exception $e) {
            return redirect()->route('dashboard')
                ->withErrors($e->getMessage());
        }

    }

}
