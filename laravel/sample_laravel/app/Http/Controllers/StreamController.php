<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Carbon\Carbon;

class StreamController extends Controller
{
    /**
     * The stream source.
     *
     * @return \Illuminate\Http\Response
     */
    public function stream()
    {
        session_write_close();
        set_time_limit(300);
        return response()->stream(function() {
            if (ob_get_level() == 0) {ob_start();}
            while (true) {
                if (connection_aborted() || connection_status() != CONNECTION_NORMAL) {
                    break;
                }
                $storedMessages = \Cache::rememberForever('stored_messages', function () {
                    return Message::where('created_at', '>=', Carbon::now()->sub(5000, 'milliseconds')->format('Y-m-d H:i:s.u'))->get();
                });
                if (!$storedMessages->isEmpty()) {
                    \Cache::forget('stored_messages');
                    echo "event: ping\n", "data: " . json_encode($storedMessages), "\n\n";
                    break;
                }
                ob_flush();
                flush();
                usleep( 5000 * 1000 ); // 5秒のスリープ
                clearstatcache();
            }
            ob_end_flush();
        }, 200, [
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/event-stream',
            'Connection' => 'keep-alive',
        ]);
    }

    /**
     * store message
     *
     * @return \Illuminate\Http\Response
     */
    public function storeMessage()
    {
        $message = new Message();
        $message->message = "time: " . Carbon::now()->format('Y-m-d H:i:s');
        $message->save();
        \Cache::forget('stored_messages');
        return response()->json($message, 201);
    }
}
