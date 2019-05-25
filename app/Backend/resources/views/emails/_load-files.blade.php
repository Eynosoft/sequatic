<div class="row ">
    <div class="folder-section-row clearfix">
    @if(!empty($inquiry) && isset($inquiry['directory']) && count($inquiry['directory']) > 0)
    @foreach($inquiry['directory'] as $dir)
    <div class="folder_heading clearfix">
     <h3> {{$dir['directory_name'] }}</h3>
    </div>
    @if(isset($dir['files']) && count($dir['files']) > 0)
<!--    <div class="col-md-3 col-sm-6 col-xs-12">-->
    @foreach($dir['files'] as $file)
    
    <div class="col-md-2 col-sm-3 col-xs-6">
        <div class="file_name">
            <?php $extension = \File::extension($file->file_path); ?>
            @if($extension == 'jpg'|| $extension == 'jpeg' || $extension ==  'png')
            <input type="checkbox" class="attach-files" name="attach-files[]" value="{{$file->file_path}}" data-id="{{$file->file_title}}" id="{{$file->id}}">
            <label for="{{$file->id}}">
                <image src="{{asset('public/'.$file->file_path)}}" height="80" width="80"/>
                <span>{{$file->file_title}}</span>
            </label> 
            @endif
            @if($extension == 'docx')
            <input type="checkbox" class="attach-files" name="attach-files[]" value="{{$file->file_path}}" data-id="{{$file->file_title}}" id="{{$file->id}}">
            <label for="{{$file->id}}">
            <image src="{{asset('public/images/word_icon.png')}}" height="80" width="80"/>
            <span>{{$file->file_title}}</span>
            </label>
            @endif
            @if($extension == 'doc')
             <input type="checkbox" class="attach-files" name="attach-files[]" value="{{$file->file_path}}" data-id="{{$file->file_title}}" id="{{$file->id}}">
             <label for="{{$file->id}}">
            <image src="{{asset('public/images/doc_icon.png')}}" height="80" width="80"/>
            <span>{{$file->file_title}}</span>
           </label>
            @endif
            @if($extension == 'xlsx')
             <input type="checkbox" class="attach-files" name="attach-files[]" value="{{$file->file_path}}" data-id="{{$file->file_title}}" id="{{$file->id}}">
             <label for="{{$file->id}}">
            <image src="{{asset('public/images/excel_icon.png')}}" height="80" width="80"/>
            <span>{{$file->file_title}}</span>
           </label>
            @endif
            @if($extension == 'pdf')
             <input type="checkbox" class="attach-files" name="attach-files[]" value="{{$file->file_path}}" data-id="{{$file->file_title}}" id="{{$file->id}}">
             <label for="{{$file->id}}">
            <image src="{{asset('public/images/pdf_icon.png')}}" height="80" width="80"/>
            <span>{{$file->file_title}}</span> 
           </label>
            @endif
        </div>
    </div>
    
    @endforeach
<!--    </div>-->
    <div class="clearfix"></div>
    @endif
    @endforeach
    
    @else
    <span>No files found</span>
    @endif
    </div>
</div>
<input type="button" class="btn btn-info" value="Attach" id="attach-files-in-mail"/>
<Script>
 $(function(){
      $('#attach-files-in-mail').click(function(){
        var val = [];
        var str = '';
        $(':checkbox:checked').each(function(i){
          //val[i] = $(this).val();
          //console.log(val[i]);
          str += "<div class='col-md-4 col-sm-6'><div class='attatch_file'><a href='"+$(this).val()+"'>"+$(this).data('id')+"</a><span onclick='remove(this);'><i class='fa fa-times' aria-hidden='true'></i><span></div></div>";
        });
        $('#attachments-all').append(str);
        $('#myModalAttachment').modal('hide');
      });
    });
 function remove(el){
 $(el).parent('div').parent('div').remove();
 }   
</script>