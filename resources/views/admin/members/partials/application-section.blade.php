    <fieldset class="border p-4 mb-4" id="partner">
        <legend class="">Application No</legend>
        <div class="row">
            <table>
                <tr>
                    <th>Member #</th>
                    <th><b>{{ $member->mem_no }}</b></th>
                
                    <th> <img class="custom-image-preview" src="{{ asset('storage/app/public/'.$member->image_url) }}"></th> 
                </tr>
            </table>
        </div>
        
    </fieldset>

    <fieldset class="border p-4 mb-4" id="partner">
        <legend class="w-auto">General Information</legend>
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td>{{ $member->name }}</td>
                </tr>
                <tr>
                    <th>Father Name</th>
                    <td>{{ $member->father_name }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ $member->gender }}</td>
                </tr>
                <tr>
                    <th>CNIC No</th>
                    <td>{{ $member->cnic_no }}</td>
                </tr>
                <tr>
                    <th>Contact No</th>
                    <td>{{ $member->contact_no }}</td>
                </tr>
                <tr>
                    <th>Date Of Birth</th>
                    <td>{{ $member->birth_date }}</td>
                </tr>
                <tr>
                    <th>Qualification</th>
                    <td>{{ $member->qualification }}</td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>{{ $member->city  }}</td>
                </tr>
                <tr>
                    <th>Office Address</th>
                    <td>{{ $member->office_address }}</td>
                </tr>
                <tr>
                    <th>Residential Address</th>
                    <td>{{ $member->residential_address  }}</td>
                </tr>
            </table>
        </div>
    </fieldset> 

    <fieldset class="border p-4 mb-4" id="partner">
        <legend class="w-auto">Member Information</legend>
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <th>Membership Based-on</th>
                    <td>{{ $member->membership_based_on }}</td>
                </tr>
                <tr>
                    <th>Select Membership</th>
                    <td>{{ $member->mem  }}</td>
                </tr>
                <tr>
                    <th>Membership Reg Date</th>
                    <td>{{ $member->mem_reg_date }}</td>
                </tr>
                <tr>
                    <th>Membership Fee Paid</th>
                    @if($member->mem_fee_submission_date != null)
                        <td>
                            <span class="badge badge-primary">Yes</span>
                        </td>
                    @else
                        <td>
                            <span class="badge badge-danger">No</span>
                        </td>
                    @endif
                </tr>
            </table>
        </div>
    </fieldset>
</div>