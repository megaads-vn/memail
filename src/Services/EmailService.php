<?php

namespace Megaads\Memail\Services;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class EmailService extends BaseController
{
    public static function send($option)
    {
        $subject = config('mail.config-send-email.default.subject', '');
        if (isset($option['subject'])) {
            $subject = $option['subject'];
        }
        $listTypeConfig = config('mail.config-send-email.groups', []);
        if (isset($option['type']) && array_key_exists($option['type'], $listTypeConfig)) {
            $listMailTo = $listTypeConfig[$option['type']];
        } else {
            $listMailTo = isset($option['to']) ? $option['to'] : config('mail.config-send-email.default.to', []);
        }
        $name = isset($option['name']) ? $option['name'] : config('mail.config-send-email.default.name', '');
        $data = [
            'subject' => $subject,
            'name' => $name
        ];
        foreach ($listMailTo as $email) {
            $data['to'] = $email;
            if (isset($option['view'])) {
                Mail::send($option['view'], ['dataEmail' => isset($option['data']) ? $option['data'] : ''], function ($m) use ($data) {
                    $m->from(env('MAIL_USERNAME'), $data['name']);
                    $m->to($data['to']);
                    $m->subject($data['subject']);
                });
            } else if (isset($option['content'])) {
                Mail::raw($option['content'], function ($m) use ($data) {
                    $m->from(env('MAIL_USERNAME'), $data['name']);
                    $m->to($data['to']);
                    $m->subject($data['subject']);
                });
            }

        }
    }
}