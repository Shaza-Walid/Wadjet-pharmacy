<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;

use App\Http\Requests\Contact\StoreContactRequest;
use App\Services\Contact\ContactService;

class ContactController extends Controller
{
    public function __construct(
        protected readonly ContactService $contactService
    ) {}

    /**
     * Handle a contact form submission.
     */
    public function store(StoreContactRequest $request)
    {
        $this->contactService->submitContactForm($request->validated());

        return redirect()->back()->with('success', 'Your message has been sent successfully');
    }
}