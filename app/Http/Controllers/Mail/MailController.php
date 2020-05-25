<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Message;
use Illuminate\Http\JsonResponse;

use Throwable;
class MailController extends Controller
{
    public function send(Request $request)
    {
        try {

//            $subject = (new Contact)->cleaning_str(request('form.subject', 'Без темы'));
//            $emailMessage = (new Contact)->cleaning_str(request('form.message', ''));
            $sender = auth()->user()->email;

//            $contacts = Contact::getUserContacts()->whereIn('id', $request->contacts)->get();

//            foreach ($contacts as $contact) {
//                Mail::to($contact->email)
//                    ->send(new Message($emailMessage, $subject, $sender));
//                (new CallLog())->prepareToCreate($contact->id);
//            }
            Mail::to('maksimserbinin9119@gmail.com')
                ->send(new Message('$emailMessage', '$subject', $sender));

            return response()->json('ok', 200);


        } catch (Throwable $e) {
            return response()->json($e->getMessage(), 417);
        }
    }
}
