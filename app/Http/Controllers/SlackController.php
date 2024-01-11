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
            $data['username'] = 'SCRUM_API';

            $formData = json_encode($data);
//display error
//            return redirect()->route('welcome')
//                ->withErrors(new Exception('error'));

            $client->request(
                "POST",
                config('services.slack.webhook-url'),
                ['body' => $formData],
            );

            return redirect()->route('welcome');

        } catch (Exception $e) {
            return redirect()->route('welcome')
                ->withErrors($e->getMessage());
        } catch (GuzzleException $e) {
            return redirect()->route('welcome')
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
            'Authorization' => 'Bearer '.config('services.slack.bot-token')
        ];

        $request = new GuzzleRequest('GET', 'https://slack.com/api/conversations.history?channel='.config('services.slack.channel'), $headers);
        $response = $client->sendAsync($request)->wait();

        return $response->getBody();

    }

}
