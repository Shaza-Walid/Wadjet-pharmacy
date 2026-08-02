<?php

namespace App\Services\AvailabilityRequest;

use App\Models\AvailabilityRequest;
use Illuminate\Validation\ValidationException;

class AvailabilityRequestService
{
    public function getAllRequests()
    {
        return AvailabilityRequest::with('product')->get();
    }

    public function createRequest(array $data)
    {
        return AvailabilityRequest::create([
            ...$data,
            'status' => 'pending',
            'pending' => true,
        ]);
    }

    public function updateRequestStatus(string $id, array $data)
    {
        $availabilityRequest = AvailabilityRequest::find($id);

        if (!$availabilityRequest) {
            return null;
        }

        $availabilityRequest->status = $data['status'];
        $availabilityRequest->pending = $data['status'] === 'pending';
        $availabilityRequest->save();

        return $availabilityRequest;
    }

    public function deleteRequest(string $id)
    {
        $availabilityRequest = AvailabilityRequest::find($id);

        if (!$availabilityRequest) {
            return false;
        }

        $availabilityRequest->delete();
        return true;
    }
}
