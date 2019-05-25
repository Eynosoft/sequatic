<div class="table-responsive">
    <table class="table table-striped table-responsive table-bordered admin_table" style="margin:0px">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Request Country</th>
                <th>Status</th>
                <th style="width:200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($salesrep) && count($salesrep) > 0)
            @foreach($salesrep as $key=>$rep)
            <tr class="">
                <td>{{++$key}}</td>
                <td>{{$rep->first_name}} {{$rep->last_name}}</td>
                <td>{{$rep->email}}</td>
                <td>{{($rep->mobile) ?$rep->mobile: '-' }}</td>
                <td>{{$rep->country['country_name']}}</td>
                <td>{{$rep->status}}</td>
                <td>
                    <ul class="list-inline">
<!--                            <li class="action_icon">
                                <button type="button" class="btn btn-xs" data-toggle="tooltip" title="View More">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>  
                            </li>-->
                            <li class="action_icon">
                                <a  href="javascript:void(0)" onclick="loadSalesRepEdit({{$rep->id}});" class="btn btn-xs" data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>  
                            </li>
                            <li class="action_icon">
                                <button onclick="toggleStatus({{$rep->id}},'deleted'); return false;" type="button" class="btn btn-xs" data-toggle="tooltip" title="Delete">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>  
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
        {!! $salesrep->render('backend::pagination.bootstrap-4') !!}
    </div>
</div>


<script type="text/javascript">
    $().ready(function () {
        $(".pagination li a").on('click', function (e) {
            e.preventDefault();
            var $this = $(this);
            var pageLink = $this.attr('href');
            loadSalesRep(pageLink);
        });
    });
    function toggleStatus(id, status) {
        swal({
            title: 'Are you sure?',
            text: "You want to delete this sales rep!",
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
            processToggelStatus(id, status);
        }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal('Cancelled', 'Your record is safe :)', 'error')
            }
        })
    }
    function processToggelStatus(id, status) {

        var url = '{{url("backend/sales-rep/toggle-status")}}';
        $.ajax({
            url: url,
            type: 'post',
            data: {'id': id, 'status': status,  '_token': '{{csrf_token()}}'},
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    swal('Success!', res.message, 'success');
                } else {
                    swal('Error!', res.message, 'error');
                }
                var pageLink = '{{$salesrep->url($salesrep->currentPage())}}';
                loadSalesRep(pageLink);
                loadSalesRepStatics();
            }
        });
    }
</script>
