<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;

class BroadcastController extends Controller
{
    public function send(Request $request)
    {
        try {
            $broadcastConfig = config('broadcasting.connections.pusher');
            $pusherKey = $broadcastConfig['key'];
            $pusherSecret = $broadcastConfig['secret'];
            $pusherId = $broadcastConfig['app_id'];
            $options = $broadcastConfig['options'];
            $pusher = new Pusher($pusherKey, $pusherSecret, $pusherId, $options);
            $response = $pusher->trigger('test-pusher', 'my-event', $request->all());
            return [
              'code' => 200,
              'data' => $response
            ];
        } catch (\Exception $exception) {
            return [
                'code' => $exception->getCode(),
                'error' => $exception->getMessage()
            ];
        }
    }
}
