<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvailabilityRequest\UpdateAvailabilityRequestStatus;
use App\Services\AvailabilityRequest\AvailabilityRequestService;

class AvailabilityRequestController extends Controller
{
    public function __construct(
        protected readonly AvailabilityRequestService $availabilityRequestService
    ) {}

    public function index()
    {
        $requests = $this->availabilityRequestService->getAllRequests();

        return view('admin.availability-requests.index', compact('requests'));
    }

    public function updateStatus(UpdateAvailabilityRequestStatus $request, string $id)
    {
        $availabilityRequest = $this->availabilityRequestService->updateRequestStatus($id, $request->validated());

        if (!$availabilityRequest) {
            return redirect()->back()->with('error', 'Request not found');
        }

        return redirect()->back()->with('success', 'Request status updated successfully');
    }

    public function destroy(string $id)
    {
        $deleted = $this->availabilityRequestService->deleteRequest($id);

        if (!$deleted) {
            return redirect()->back()->with('error', 'Request not found');
        }

        return redirect()->back()->with('success', 'Request deleted successfully');
    }
}