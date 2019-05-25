@extends('backend::layouts.app')

@section('content')
<div class="admin_content admin-general-information">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="trash_heading">Trash Bin</h2>
            </div>
        </div>

        <section class="section_padding">

            <div class="panel panel-default">
                <div class=" col-lg-12 text-right search_bar">
                    <div class="row search_section">
<!--                        <div class="col-lg-7">
                            <div class="heading text-center">
                                <h3>Trash Inquiry</h3>
                            </div>
                        </div>-->
                        <div class="pull-right col-lg-4">
                            <form name="searchform" id="searchform">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 xs-full">
                                    <div class="form-group">
                                        <div class='input-group date datetimepicker'>
                                            <input type='text' name="created_at" class="form-control" placeholder="Date" />
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 xs-full">
                                    <div class="form-group">
                                        <input type="text" name="keyword" class="form-control" placeholder="keyword">
                                        {{csrf_field()}}
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-2 col-xs-2 xs-full text-center">
                                    <button class="search_btn" onclick="loadTrashInquiry(); return false;">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body" style="padding:0px" id="load-trash-inquiry">
                   
                </div>
            </div>
        </section>
    </div>
</div> 

<script type="text/javascript">
    $(document).ready(function () {
        loader = '<i class="fa fa-spinner fa-pulse fa-1 fa-fw margin-bottom"></i>';
        loadTrashInquiry();

        $(".datetimepicker").datetimepicker({
            format: "DD-MM-YYYY",
            // autoclose: true,
            //todayBtn: true,
            //pickerPosition: "bottom-left"
        });
        $('[data-toggle="tooltip"]').tooltip();
    });
    function loadTrashInquiry(url) {
        $('#load-trash-inquiry').html(loader);
        if (url == 'undefined' || url == '' || url == null) {
            url = '{{url("backend/load-trash-inquiry")}}';
        }
        $.ajax({
            url: url,
            type: 'post',
            data: $('#searchform').serialize(),
            dataType: 'json',
            success: function (res) {
                $('#load-trash-inquiry').html('');
                $('#load-trash-inquiry').html(res.html);
            }
        });
    };
</script>
@endsection

