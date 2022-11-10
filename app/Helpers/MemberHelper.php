<?php

use App\Biometric;

if (!function_exists('getMemberStatus')) {
    function getMemberStatus($member)
    {
        if ($member->mem_status == 1) {
            $status = '<span class="badge badge-success mr-1">Active</span>';
        } else if ($member->mem_status == 2) {
            $status = '<span class="badge badge-danger mr-1">In-active</span>';
        } else if ($member->mem_status == 3) {
            $status = '<span class="badge badge-danger mr-1">Suspended</span>';
        } else if ($member->mem_status == 4) {
            $status = '<span class="badge badge-primary mr-1">Late</span>';
        } else {
            $status = '<span class="badge badge-primary mr-1">Pending</span>';
        }

        $biometric = Biometric::where('member_no', $member->mem_no)->first();
        if (isset($biometric)) {
            $status .= '<span class="badge badge-success mr-1">Biometric Done</span>';
            if ($biometric->veri == 'Y') {
                $status .= '<span class="badge badge-success mr-1">Biometric Verified</span>';
            } else {
                $status .= '<span class="badge badge-danger mr-1">Biometric Not Verified</span>';
            }
        } else {
            $status .= '<span class="badge badge-primary mr-1">Biometric Pending</span>';
        }

        return $status;
    }
}
