<?php

namespace App\Services\Contact;

class ContactService
{
    public function submitContactForm(array $data)
    {
        // ملاحظة: مفيش جدول contacts في الداتابيز حاليًا،
        // فالرسالة بترجع نجاح بس من غير تخزين فعلي.
        // TODO: لو احتجنا نخزنها بعدين، هنعمل Migration + Model لجدول contacts.

        // Simulating processing the contact form
        return true;
    }
}
