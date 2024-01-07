<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
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
        } catch (GuzzleException $e) {
            return redirect()->route('dashboard')
                ->withErrors($e->getMessage());
        }

    }

    /**
     * @return mixed
     */
    public function viewMessages(): mixed
    {

        $client = new Client();
        $headers = [
            'Authorization' => 'Bearer xoxb-5007610574999-5045913626272-QyBhuj1O06PtM7yqj7CkE13B'
        ];

        $request = new GuzzleRequest('GET', 'https://slack.com/api/conversations.history?channel=C050N0KL0NP', $headers);
        $response = $client->sendAsync($request)->wait();

        return $response->getBody();

    }

}
