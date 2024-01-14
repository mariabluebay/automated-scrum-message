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

            $client->request(
                "POST",
                config('services.slack.webhook-url'),
                ['body' => json_encode($data)],
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

        $request = new GuzzleRequest('GET', 'https://slack.com/api/conversations.history?channel='.config('services.slack.channel-id'), $headers);

        $response = $client->sendAsync($request)->wait();

        return $response->getBody();

    }

    /**
     * @return mixed
     */
    public function modify(Request $request): mixed
    {
        $request->validate([
            'text' => 'required|string',
            'action' => 'required|string',
        ]);

        $client = new Client();
        $data['channel'] = config('services.slack.channel-id');
        $data['text'] = $request->text;
        $data['ts'] = $request->ts;
        $headers = [
            "Content-Type" => "application/json; charset=utf-8",
            'Authorization' => 'Bearer '.config('services.slack.bot-token')
        ];
        $action = $request->action === 'edit' ? 'chat.update' : 'chat.delete';


        $request = new GuzzleRequest(
            'POST',
            config('services.slack.api-url') . $action,
            $headers,
            json_encode($data)
        );

        $response = $client->sendAsync($request)->wait();

        return $response->getBody();
    }

}
