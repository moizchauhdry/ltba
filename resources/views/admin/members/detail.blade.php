@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Members</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('members.index')}}"
                            class="btn btn-dark">Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">View Member</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <th>Member #</th>
                            </div>
                            <div class="col-md-6">
                                <td><b>{{ $member->mem_no }}</b></td>
                            </div>
                        </div>
                        <fieldset class="border p-4 mb-4" id="partner">
                            <legend class="w-auto">General Information</legend>
                            <div class="row">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $member->name }}</td>
                                        <th>Father Name</th>
                                        <td>{{ $member->father_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>{{ $member->gender }}</td>
                                        <th>CNIC No</th>
                                        <td>{{ $member->cnic_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Contact No</th>
                                        <td>{{ $member->contact_no }}</td>
                                        <th>Date Of Birth</th>
                                        <td>{{ $member->birth_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Qualification</th>
                                        <td>{{ $member->qualification }}</td>
                                        <th>City</th>
                                        <td>{{ $member->city  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Office Address</th>
                                        <td>{{ $member->office_address }}</td>
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
                                        <th>Select Membership</th>
                                        <td>{{ $member->mem  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Membership Reg Date</th>
                                        <td>{{ $member->mem_reg_date }}</td>
                                        <th>Membership Fee Paid</th>
                                        @if($member->mem_fee_submission_date != null)
                                            <td><span class="badge badge-primary">Yes</span></td>
                                        @else
                                            <td>'<span class="badge badge-danger">No</span></td>
                                        @endif
                                    </tr>
                                    @if($member->mem_fee_submission_date != null)
                                        <tr>
                                            <th>Fee Submission Date</th>
                                            <td>{{ $member->mem_fee_submission_date }}</td>
                                            <th>Remarks</th>
                                            <td>{{ $member->remarks }}</td>
                                        </tr>
                                    @endif
                                </table>

                            </div>
                        </fieldset>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>

                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
