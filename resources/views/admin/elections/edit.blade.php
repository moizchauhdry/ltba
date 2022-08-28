@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__('Manage Election')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('elections.index')}}" class="btn btn-dark">Back</a></li>
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
                        <h3 class="card-title">Edit Election</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="#" id="update_elections_form" method="POST"> @csrf
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Name <span class="required-star">*</span></label>
                                    <input type="text" maxlength="100" class="form-control" name="name"
                                        placeholder="Enter Election Name" value="{{ $election->name }}" required>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label">Start Date<span
                                            class="required-star">*</span></label>
                                    <div class="input-group date" id="edit_start_date" data-target-input="nearest">
                                        <input type="text" name="start_date"
                                            class="form-control datetimepicker-input" data-target="#edit_start_date"
                                            value="{{ $election->start_date }}" placeholder="Enter Start Date" required />
                                        <div class="input-group-append" data-target="#edit_start_date"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container row">
                                    <div class="col-md-12">
                                        @if($election->end_date != null)
                                            <input type="checkbox" class="election_end" name="election_end_checkbox" checked
                                                id="election_end_checkbox" value="1" onchange="electionEnd()">
                                        @else
                                            <input type="checkbox" class="election_end" name="election_end_checkbox"
                                                id="election_end_checkbox" value="0" onchange="electionEnd()">
                                        @endif

                                        <label class="create-group">Election End?</label>
                                    </div>
                                </div>
                                <div class="col-md-12" id="election_end_section" style="display:none">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="control-label">End Date<span
                                                    class="required-star">*</span></label>
                                            <div class="input-group date" id="edit_end_date" data-target-input="nearest">
                                                <input type="text" name="end_date"
                                                    class="form-control datetimepicker-input" data-target="#edit_end_date"
                                                    value="{{ $election->end_date }}" placeholder="Enter End Date"/>
                                                <div class="input-group-append" data-target="#edit_end_date"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
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
@section('scripts')
<script src="{{asset('public/js/app.js')}}"></script>
<script>
    function electionEnd() {
        if($('.election_end').is(":checked")){
            $("#election_end_section").show();
            $('#end_date').prop('required',true);
        }   
        else {
            $("#election_end_section").hide();
            $('#end_date').prop('required',false);
        }
    }
    //ELECTION UPDATE FORM AJAX SCRIPTS
    jQuery(document).ready(function () {
        App.init();
    });

    $(document).ready(function(){
        if($('.election_end').is(":checked")){
            $("#election_end_section").show();
        }

      $("#update_elections_form").on("submit", function(event){
          event.preventDefault();
          $('span.text-success').remove();
          $('span.invalid-feedback').remove();
          $('input.is-invalid').removeClass('is-invalid');
          var formData = new FormData(this);
          $.ajax({
            method: "POST",
            data: formData,
            url: '{{route('elections.update',$election->id)}}',
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function(){
                $(".custom-loader").removeClass('hidden');
            },
            success: function (response) {
                if (response.status == 1) {
                    window.location.href = '{{route('elections.index')}}';
                }
            },
            error : function (errors) {
                errorsGet(errors.responseJSON.errors)
                $(".custom-loader").addClass('hidden');
                $("#error_message").removeClass('hidden');
            }
          });
      });
    });
</script>
@endsection