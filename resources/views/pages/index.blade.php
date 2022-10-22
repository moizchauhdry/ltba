@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4"></div>
            <form action="" id="search_member_form" method="POST">@csrf
                <div class="col-md-12 radio-check">
                    <div class="form-group">
                        <label>
                            <input type="radio" name="search_member" value="1" id="search_member" required>
                            Seach By Member No
                        </label>
                        <label>
                            <input type="radio" name="search_member" value="2" id="search_member" required>
                            Seach By CNIC NO
                        </label>
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-12 search-box">
                    <div class="search-container">
                        <div class="search">
                            <div class="form-inline">
                                <div class="input-group" data-widget="sidebar-search" style="width:100% !important;">
                                    <input class="form-control" name="search_mem" type="search"
                                        placeholder="Search Member" aria-label="Search" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-sidebar" type="submit"><i
                                                class="fas fa-search fa-fw"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade show" id="modal-default" style="padding-right: 17px;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Membership</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div id="member_value">

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
            // $('input[name="search_type_mem_no"]').click(function () {
            //     if ($(this).is(":checked")) {
            //         $('input[name="search_type_cnic_no"]').removeAttr("checked")
            //         $('#cnic_no_search').val('');
            //         $('#mem_no_search').val('1');

            //     }
            // });

            // $('input[name="search_type_cnic_no"]').click(function () {
            //     if ($(this).is(":checked")) {
            //         $('input[name="search_type_mem_no"]').removeAttr("checked")
            //         $('#mem_no_search').val('');
            //         $('#cnic_no_search').val('2');

            //     }
            // });

            $("#search_member_form").on("submit", function(event){
                event.preventDefault();
                $('span.text-success').remove();
                $('span.invalid-feedback').remove();
                $('input.is-invalid').removeClass('is-invalid');
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: '{{route('searchMember')}}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function(){
                        $(".custom-loader").removeClass('hidden');
                    },
                    success: function (response) {
                        if (response.status == 1) {
                            var memberData = '';
                            $(".custom-loader").addClass('hidden');
                            $('#modal-default').modal('show');
                            memberData = '<div class="row"><div class="col-md-6"><th>Member #:</th></div><div class="col-md-6"><td><b>'+ response.member.mem_no +'</b></td></div><div class="col-md-4"><th>Name :</th></div><div class="col-md-6"><td><b>'+ response.member.name +'</b></td></div><div class="col-md-4"><th>Cnic No :</th></div><div class="col-md-6"><td><b>'+ response.member.cnic_no +'</b></td></div></div><div class="modal-footer justify-content-between"><a  href="javascript:void(0);"  onclick="nextPage('+ response.member.id +');" class="btn btn-primary" style="float:right;">Next</a></div>';
                            $('#member_value').append(memberData);
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

        function nextPage(mem_id)
        {
            $.ajax({
                method: "GET",
                url: '{{route('getMember')}}',
                data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                'mem_id': mem_id,
                },
                success: function (response) {
                    if (response.status == 1) {
                        var url = '{{ route("editMember", ":id") }}';
                        url = url.replace(':id', response.id);
                        window.location.href =  url;
                    }
                },
            });
        }
</script>
@endsection
