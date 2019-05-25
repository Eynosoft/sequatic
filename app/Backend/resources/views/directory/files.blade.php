@extends('backend::layouts.app')

@section('content')
<section class="admin-general-information file-page">
    <div class="container">
        <div class="info-main-box">
            <div class="folder_section">
                <div class="bottom-border row">
                    <div class="col-sm-6 col-xs-6 xs-full">
                        <div class="heading">
                            <h3>
                                Folder Name : <span>{{$directory_name}}</span>
                            </h3>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6 xs-full">
                        <div class="folder-icon">
                            <span class="btn btn-default btn-file"  >
                                <i class="fa fa-upload" aria-hidden="true"></i><span id="upload-text">Add New File</span>
                                <form id="upload-form" method="post" enctype="multipart/form-data">
                                    <input type="file" name="file" id="upload-button" onchange="uploadFile();">
                                    <input type="hidden" name="directory_id" value="{{($directory_id) ? $directory_id : ''}}">
                                    {{csrf_field()}}
                                </form>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="folder-box">
                    <div class="padding-box">
                        <div id="load-file-directory"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>

            function uploadFile() {
                if($('#upload-button').val()){
                 $("#upload-button").hide();
                 $("#upload-text").html('Uploading...');
                var formData = new FormData($('#upload-form')[0]);
                    var url = '{{url("backend/directory/upload-file")}}';
                    $.ajax({
                    url: url,
                            type: 'post',
                            data: formData,
                            dataType: 'json',
                            processData: false,
                            cache: false,
                            contentType: false,
                            success: function (res) {
                                if (res.success) {
                                swal('Success!', res.message, 'success');
                                        loadFileDirectory();
                                }
                            },
                            error: function (err) {
                                var obj = $.parseJSON(err.responseText);
                                if (obj.file) {
                                    swal('error!', obj.file[0], 'error');
                                } else {
                                    console.log(err);
                                }
                            },
                            complete: function(res){
                               $("#upload-button").show();
                               $("#upload-text").html('Add New File');
                            } 
                    });
                }
                return false;
            }

           $(document).ready(function () {
              loader = '<i class="fa fa-spinner fa-pulse fa-1 fa-fw margin-bottom"></i>';
             loadFileDirectory();
            });
            
            function loadFileDirectory(url) {
            var directory_id = {{$directory_id}};
                    $('#load-file-directory').html(loader);
                    if (url == 'undefined' || url == '' || url == null) {
                     url = '{{url("backend/directory/load-file-directory")}}/' + directory_id;
                        }
                        $.ajax({
                        url: url,
                                type: 'post',
                                data: {'_token':'{{csrf_token()}}'},
                                success: function (res) {
                                $('#load-file-directory').html('');
                                        $('#load-file-directory').html(res.html);
                                }
                        });
                }



</script>
@endsection