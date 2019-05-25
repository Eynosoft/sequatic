
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
                <th>Request Country</th>
                <th>Status</th>
                <th>Last Contact Date</th>
                <th style="width:200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($inquiries) && count($inquiries) > 0)
            @foreach($inquiries as $inq)
            <tr class="">
                <td>{{$inq->inquiry_number}}</td>
                <td>{{$inq->created_at->format('m/d/Y')}}</td>
                <td>{{$inq->first_name}} {{$inq->last_name}}</td>
                <td>{{$inq->email}}</td>
                <td>{{$inq->mobile}}</td>
                <td>{{$inq->company_name ? $inq->company_name : '-' }}</td>
                <td>{{!empty($inq->country['country_name']) ? $inq->country['country_name'] : '-'}}</td>
                <td>{{$inq->quote_inquiry_status ? $inq->quote_inquiry_status : '-' }}</td>
                <td>02/15/2017</td>

                <td>
                    <ul class="list-inline">
                        <li>
                            @foreach($inq->detail as $detail)
                                
                                @if($detail->quote_id == $inq->id)
                                    <a href="{{url('/backend/inquiry-detail/detail-inquiry').'/'.$inq->id}}">
                                        <div class="action_icon">
                                            <button type="button" class="btn btn-xs" data-toggle="tooltip" title="View More">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button> 
                                        </div>
                                    </a>
                                    @break
                                @endif
                            @endforeach
                        </li>

                        <li>
                            <div class="select">
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Action<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" onclick="toggleInquiryStatus({{$inq->id}}, 'deleted', 'trash')">Trash(Junk)</a></li>
                                        
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
        {!! $inquiries->render('backend::pagination.bootstrap-4') !!}
    </div>
</div>


<script type="text/javascript">
            $().ready(function () {
                $(".pagination li a").on('click', function (e) {
                    e.preventDefault();
                    var $this = $(this);
                    var pageLink = $this.attr('href');
                    loadQuoteInquiry(pageLink);
                });
            });
            function toggleInquiryStatus(id, status, type) {
            swal({
            title: 'Are you sure?',
                    text: "You want to move this inquiry to trash!",
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
            processToggelStatus(id, status, type);
            }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
            swal('Cancelled', 'Your record is safe :)', 'error')
            }
            })
            }
    function processToggelStatus(id, status, type){

        var url = '{{url("backend/inquiry/toggle-status")}}';
            $.ajax({
                url: url,
                type: 'post',
                data: {'id':id, 'status':status, 'type':type, '_token':'{{csrf_token()}}'},
                dataType: 'json',
                success: function (res) {
                if (res.success){
                swal('Success!', res.message, 'success');
                } else{
                swal('Error!', res.message, 'error');
                }
                var pageLink = '{{$inquiries->url($inquiries->currentPage())}}';
                        loadQuoteInquiry(pageLink);
                        //loadGeneralInquiryStatics();
                }
            });
    }
</script>
<?php

    