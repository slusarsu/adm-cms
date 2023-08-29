<?php

namespace App\Http\Controllers;

use App\Adm\Services\AdmFormService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $model = $request->get('model');
        $recordId = $request->get('record_id');
        $parentId = $request->get('parent_id');
        $content = $request->input('content');
        $email = $request->input('email');

        if(!$model || !$recordId || !$email) {
            return back()->with('comment_error', 'No comment has been added.');
        }

        $gRecaptchaResponse = $request->get('g-recaptcha-response');

        if($gRecaptchaResponse) {
            $ip = $request->ip();
            $recaptchaStatus = AdmFormService::checkRecaptcha3($gRecaptchaResponse, $ip);

            if(!$recaptchaStatus) {
                return back()->with('comment_error', 'No comment has been added.');
            }
        }

        $record = $model::query()->where('id', $recordId)->first();
        $record->comments()->create([
            'content' => $content,
            'email' => $email,
            'parent_id' => $parentId,
            'ip' => $request->ip(),
        ]);

        return back()->with('comment_success', 'Comment added. We will check and publish it.');
    }
}
