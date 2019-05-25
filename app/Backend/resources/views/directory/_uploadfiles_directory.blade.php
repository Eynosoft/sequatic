<div class="row folder-section-row">  
    @if($files && count($files) > 0)
    @foreach($files as $directorys)
    <div class="col-md-2 col-sm-3 col-xs-4 xs-half">
        <div class="folder_name">
            <?php $extension = \File::extension($directorys->file_path); ?>
            @if($extension == 'jpg'|| $extension == 'jpeg' || $extension ==  'png')
            <image src="{{asset('public').$directorys->file_path}}" />
            <p>{{$directorys->file_title}}</p>
            @endif
            @if($extension == 'docx')
            <image src="{{asset('public/images/word_icon.png')}}" />
            <p>{{$directorys->file_title}}</p>
            @endif
            @if($extension == 'pdf')
            <image src="{{asset('public/images/pdf_icon.png')}}" />
            <p>{{$directorys->file_title}}</p>
            @endif
            @if($extension == 'doc')
            <image src="{{asset('public/images/doc_icon.png')}}" />
            <p>{{$directorys->file_title}}</p>
            @endif
            @if($extension == 'xlsx')
            <image src="{{asset('public/imagesexcel_icon.png')}}" />
            <p>{{$directorys->file_title}}</p>
            @endif
            <div class="dropdown">
                <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="javascript:void(0)" onclick="showFileRenameModal({{$directorys}})" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit(rename)</a></li>
                     @if($extension == 'jpg'|| $extension == 'jpeg' || $extension ==  'png')
                    <li><a href="javascript:void(0)" onclick="viewFiles({{$directorys}})" ><i class="fa fa-eye" aria-hidden="true"></i>View</a></li>
                     @endif
                     @if($extension == 'doc' || $extension == 'xlsx' || $extension ==  'docx')
                     <li><a target="_blank" href="{{$directorys->file_path}}" ><i class="fa fa-eye" aria-hidden="true"></i>View</a></li>
                     @endif
                    <li><a href="javascript:void(0)" onclick="DeleteFilse({{$directorys->id}})" ><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <span>No files found</span>
    @endif
</div>


<div class="modal md-effect-1" id="view_file_model"  tabindex="-1"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal"><img src="{{asset('public/images/cancle.png')}}"></a>
            <div class="modal-padding">
                <image src="{{asset('public/images/excel_icon.png')}}" id='uploadfileview' height="450" width="650" class="img-responsive"/>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-style file_rename" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h3 class="heading">File Rename </h3>
                <form id="file-rename-form" name="file-rename-form" action="javascript:fileRename()">
                    <input type="hidden" class="form-control directory_id" name="directory_id">
                    <input type="hidden" class="form-control rename_file_id" name="id">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>File Name :</label>
                        <input type="text" class="form-control file_title" name="file_title">
                         <div class="input-filename-error-validation" style="padding-left: 0px;">
                    </div>
                    <div class="text-center">
                        <button type="submit"  class="btn btn-secondary blue-btn" >Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

{!! JsValidator::formRequest('App\Backend\Http\Requests\createDirectoryRequest','#create-directory-form') !!}
<script>
    function viewFiles(file){
        $('#view_file_model').modal('show');
            var ext = file.file_path.substr((file.file_path.lastIndexOf('.') + 1));
                if (ext == 'jpg' || ext == 'jpeg' || ext == 'peng'){
            $('#uploadfileview').attr('src', "{{asset('public')}}"+file.file_path);
                } else{
                    return false;
                }
            }

    function DeleteFilse(id) {
        swal({
            title: 'Are you sure?',
                text: "You want to delete this file directorys!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'blue-btn',
                cancelButtonClass: 'gray-btn',
                buttonsStyling: false
            }).then(function () {
                processDelete(id);
                    }, function (dismiss) {
                        if (dismiss === 'cancel') {
                            swal('Cancelled', 'Your record is safe :)', 'error')
                        }
                     })
                  }
      function processDelete(id){
                if (url == 'undefined' || url == '' || url == null) {
                var url = '{{url("backend/directory/delete-files")}}/' + id;
                }
                $.ajax({
                url: url,
                        type: 'post',
                        data: {'_token':'{{csrf_token()}}'},
                        success: function (res) {
                        if (res.success){
                        swal('Success!', res.message, 'success');
                                loadFileDirectory();
                        } else{
                        swal('Error!', res.message, 'error');
                      }
                    }
                });
            }
            
      function showFileRenameModal(file_name){
            $('.file_title').val(file_name.file_title);           
            $('.directory_id').val(file_name.directory_id);           
            $('.rename_file_id').val(file_name.id);           
            $('.file_rename').modal('show');
        }         

      function fileRename(){
           $("#rename_btn_loader").html('<div class="loder text-center"><i class="fa fa-spin fa-spinner fa-3x color-pink"></i></div>');
          if (url == 'undefined' || url == '' || url == null) {
                var url = '{{url("backend/directory/file-rename")}}';
                }
                $.ajax({
                        url: url,
                        type: 'post',
                        data: $('#file-rename-form').serialize(),
                        dataType: 'json',
                        success: function (res) {
                          $("#rename_btn_loader").html('Submit');  
                         if (res.success){
                          $('.file_rename').modal('hide');
                          setTimeout(function(){loadFileDirectory();},1000)
                         }else{
                           $('.input-filename-error-validation').show().html(res.message);
                      }
                    },
                    beforeAjaxSend:function(){
                       
                    }
                });
            }
</script>
    