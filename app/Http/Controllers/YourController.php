<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use Illuminate\Support\Facades\Log;


class YourController extends Controller
{
    public function getHtmlPage(Request $request)
    {
        Log::info("zaxodit v html");
        $token = $request->session()->token(); 
        $token = csrf_token();        
        return view("formPage");        
    }

    public function validatePhone(Request $request)
    {
        // Получаем номер телефона из POST запроса
        $phoneNumber = $request->input('phoneNumber');
        Log::info("zaxodit v validate phofe");
        Log::info("Phone validation", ['phoneNumber' => $phoneNumber]);
        if ($phoneNumber[0] !== "+") {
            return response()->json(['success' => false, "message" => "Номер должен начинаться с +"]);
        }
        if (strlen($phoneNumber) < 6) {
            return response()->json(['success' => false, "message"=> "Вы ввели не полный номер"]);
        }    
        if (!preg_match('/^\+?\d+$/', $phoneNumber)) {
            return response()->json(['success' => false, 'message' => "Вы ввели недопустимы символы"]);
        }

        $phoneNumberUtil = PhoneNumberUtil::getInstance();

        try {
            $numberProto = $phoneNumberUtil->parse($phoneNumber, null);
            $isValid = $phoneNumberUtil->isValidNumber($numberProto);

            if ($isValid) {
                $country = $phoneNumberUtil->getRegionCodeForNumber($numberProto);
                return response()->json(['success' => true, 'message' => "Действительный номер из $country"]);
            } else {
                return response()->json(['success' => false, 'message' => "Недействительный номер"]);
            }
        } catch (NumberParseException $e) {
            Log::info("Phone validation", ['Error validate phone number' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => "Ошибка распознования! "]);
        }
    }
}