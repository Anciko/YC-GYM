<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\TrainingGroup;
use Illuminate\Support\Facades\DB;
use App\Events\TrainingMessageEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TrainingManagementController extends Controller
{
    //send message for mobile
    public function sendmessage(Request $request, $id)
    {

        $message = new Message();
        $message->training_group_id = $id;
        $message->text = $request->text == null ?  '👍' : $request->text;

        // Store Image
        $tmp = $request->file;

        $file = base64_decode($tmp);
        $file_name = $request->fileName;

        Storage::disk('public')->put(
            'trainer_message_media/' . $file_name,
            $file
        );
        $message->media = $file_name;
        $message->save();
        event(new TrainingMessageEvent($message, $file_name));
    }

    //chat show for mobile
    public function chatshow($id)
    {
        $chat_messages = DB::table('messages')->where('training_group_id', $id)->get();
        $group_chat = TrainingGroup::findOrFail($id);
        return response()
            ->json([
                'group_chat' => $group_chat,
                'chat_messages' => $chat_messages
            ]);
    }
}
