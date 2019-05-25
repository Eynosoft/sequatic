
<div class="table-responsive">
    <table class="table table-striped table-responsive table-bordered admin_table" style="margin:0px">
        <thead>
            <tr>
                <th>Quote No.</th>
                <th>Inquiry Date</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company Name</th>
                <th>Last Contact Date</th>
                <th style="width:200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($inquiryDetail) && count($inquiryDetail) > 0)
            @foreach($inquiryDetail as $inq)
            <?php ?>
            <tr class="">
                <td>{{($inq->version_number < 10) ? $inq->inquiry->inquiry_number.'.0'.$inq->version_number : $inq->inquiry->inquiry_number.'.'.$inq->version_number }}</td>
                <td>{{$inq->inquiry->created_at->format('m/d/Y')}}</td>
                <td>{{$inq->inquiry->first_name}} {{$inq->inquiry->last_name}}</td>
                <td>{{$inq->inquiry->email}}</td>
                <td>{{$inq->inquiry->mobile}}</td>
                <td>{{$inq->inquiry->company_name}}</td>
                <td>15/02/2017</td>

                <td>
                    <ul class="list-inline">
                        <li>
                            <a href="{{url('/backend/inquiry/edit').'/'.$inq->inquiry->id.'/'.$inq->version_number}}">
                                <div class="action_icon">
                                    <button type="button" class="btn btn-xs" data-toggle="tooltip" title="View More">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button> 
                                </div>
                            </a>
                        </li>

                        <li>
                            <div class="select">
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Action<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" onclick="createCloneInquiry({{$inq->quote_id}})">Clone</a></li>

                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </td>   
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="11">
                    <div class="alert alert-info">No records found.</div>
                </td>
            </tr>
            @endif
        </tbody> 
    </table>
</div>
<div class="panel-footer clearfix text-right admin_pagination">
    <div class="dataTables_paginate paging_bootstrap">
        {!! $inquiryDetail->render('backend::pagination.bootstrap-4') !!}
    </div>
</div>
<script type="text/javascript">
            $().ready(function () {
                $(".pagination li a").on('click', function (e) {
                    e.preventDefault();
                    var $this = $(this);
                    var pageLink = $this.attr('href');
                    loadQuoteDetail(pageLink);
                });
            });
            function createCloneInquiry(id) {
            swal({
            title: 'Are you sure?',
                    text: "You want to create clone of this inquiry!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
            }).then(function () {
            processClone(id);
            }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
            swal('Cancelled', 'Your record is safe :)', 'error')
            }
            })
            }
            function processClone(id){

                var url = '{{url("backend/inquiry-detail/clone-quote")}}';
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {'id':id,'_token':'{{csrf_token()}}'},
                        dataType: 'json',
                        success: function (res) {
                        if (res.success){
                        swal('Success!', res.message, 'success');
                        loadQuoteDetail();
                        } else{
                        swal('Error!', res.message, 'error');
                        }
                            var pageLink = '{{$inquiryDetail->url($inquiryDetail->currentPage())}}';
                                loadQuoteDetail(pageLink);
                        }
                    });
            }
    
</script>
