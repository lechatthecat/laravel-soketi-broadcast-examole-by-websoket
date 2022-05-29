<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
        session_commit();
        return response()->stream(function() {
            set_time_limit(300);
            $id = mt_rand(100000,999999); 
            $lastMessage = Message::latest('id')->first(); 
            $now = Carbon::now()->format('Y-m-d H:i:s.u');
            $lastMessage = is_null($lastMessage) ? $now : Carbon::parse($lastMessage->created_at)->format('Y-m-d H:i:s.u');
            session_write_close(); 
            session_commit();
            if (ob_get_level() == 0) {ob_start();}
            for ($i=0;$i<300;$i++) {
                Log::debug("$id: loop $i");
                if (connection_aborted() || connection_status() != CONNECTION_NORMAL) {
                    break;
                }
                $storedMessages = \Cache::rememberForever('stored_messages', function () use ($lastMessage) {
                    return Message::where('created_at', '>', $lastMessage)->get();
                });
                if (!$storedMessages->isEmpty()) {
                    \Cache::forget('stored_messages');
                    $lastMessage = Carbon::parse($storedMessages->last()->created_at)->format('Y-m-d H:i:s.u');
                    echo "event: message\n", "data: " . json_encode($storedMessages), "\n\n";
                }
                echo "\n\n";
                ob_flush();
                flush();
                sleep(1);
            }
            ob_end_flush();
        }, 200, [
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/event-stream',
            'Connection' => 'keep-alive',
            'X-Accel-Buffering' => 'no',
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
