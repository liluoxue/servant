@extends('layouts.app')

@section('content')
{{-- <div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>文件上传</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_file_upload.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_file_upload.html#">选项1</a>
                            </li>
                            <li><a href="form_file_upload.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form id="my-awesome-dropzone" class="dropzone dz-clickable" action="{{route('up')}}">
                        <div class="dropzone-previews"></div>
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                          </div>
                        <button type="submit" class="btn btn-primary pull-right">提交</button>
                    <div class="dz-default dz-message"><span>Drop files here to upload</span></div></form>
                    <div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> --}}
你好，{{$dorm->dormname}}宿舍
{{$mission->fname}}
叽里呱啦叽里呱啦

<form method="post" action="{{route('up')}}" enctype="multipart/form-data" >    
    <input type="file" name="picture">
    备注：<input type="text" name="content"/>
    <input type="hidden" name="dorm" value="{{$dorm->dormname}}"/>
    <input type="hidden" name="fname" value="{{$mission->fname}}"/>
    <input type="hidden" name="mid" value="{{$mission->id}}"/>
    {{ csrf_field() }}
    <button type="submit"> 提交 </button>
</form>
<script>

</script>



@stop