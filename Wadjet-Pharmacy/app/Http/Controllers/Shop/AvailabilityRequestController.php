<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvailabilityRequest\StoreAvailabilityRequest;
use App\Services\AvailabilityRequest\AvailabilityRequestService;

class AvailabilityRequestController extends Controller
{
    public function __construct(
        protected readonly AvailabilityRequestService $availabilityRequestService
    ) {}

    public function store(StoreAvailabilityRequest $request)
    {
        $this->availabilityRequestService->createRequest($request->validated());

        return redirect()->back()->with('success', 'Availability request created successfully');
    }
}