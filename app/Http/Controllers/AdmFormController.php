<?php

namespace App\Http\Controllers;

use App\Adm\Services\AdmFormService;
use App\Models\AdmForm;
use App\Models\AdmFormItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdmFormController extends Controller
{
    public function form(Request $request, $link_hash)
    {
        $gRecaptchaResponse = $request->get('g-recaptcha-response');

        if($gRecaptchaResponse) {
            $ip = $request->ip();
            $recaptchaStatus = AdmFormService::checkRecaptcha3($gRecaptchaResponse, $ip);

            if(!$recaptchaStatus) {
                return back()->with('adm_form_err', 'error');
            }
        }

        $admForm = AdmFormService::byHash($link_hash);

        if(!$admForm) {
            return back()->with('adm_form_err', 'error');
        }

        $admFields = $admForm->fields();

        $itemData = [];

        foreach ($admFields as $admFieldName) {
            $itemData[$admFieldName] = $request->get($admFieldName);
        }

        $item = AdmFormItem::query()->create([
            'adm_form_id' => $admForm->id,
            'payload' => $itemData,
        ]);

        if($admForm->send_notify) {
            AdmFormService::sendEmailForItem($item);
        }

        return back()->with('adm_form_success', 'Sent. Thank you!');
    }
}
