
@extends('backend::layouts.app')

@section('content')
<div class=admin_content admin-general-information">
    <div class="container-fluid"> 
        <section class="section_padding">

            <div class="panel panel-default">
                <div class=" col-lg-12 text-right search_bar">
                    <div class="row search_section">
                        <div class="col-lg-7">
                            <div class="heading text-center">
                                <h3>Quote Inquiry</h3>
                            </div>
                        </div>
                        <div class="pull-right col-lg-5">
                            <form name="searchform" id="searchform">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <div class='input-group date datetimepicker'>
                                            <input type='text' name="created_at" class="form-control" placeholder="Date" />
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="keyword" class="form-control" placeholder="keyword">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <select class="selectpicker form-control" name="lead_value">
                                            <option value="">All</option>
                                            <option value="Hot">Hot</option>
                                            <option value="Warm">Warm</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Cold">Cold</option>
                                        </select>
                                        {{csrf_field()}}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-3 text-center">
                                    <button class="search_btn" onclick="loadQuoteInquiry(); return false;">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body table-data-load" style="padding:0px" id="load-quote-inquiry">
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
                                    <th>Lead Value</th>
                                    <th>Request Country</th>

                                    <th>Last Contact Date</th>
                                    <th style="width:200px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($inquiryDetail) && count($inquiryDetail) > 0)
                                @foreach($inquiryDetail as $inq)
                                <?php?>
                                <tr class="">
                                    <td>{{$inq->quote_id}}</td>
                                    <td>{{$inq->inquiry->created_at->format('d/m/Y')}}</td>
                                    <td>{{$inq->inquiry->first_name}} {{$inq->inquiry->last_name}}</td>
                                    <td>{{$inq->inquiry->email}}</td>
                                    <td>{{$inq->inquiry->mobile}}</td>
                                    <td>{{$inq->inquiry->company_name}}</td>
                                    <td>{{$inq->inquiry->lead_value ? $inq->inquiry->lead_value : '-' }}</td>
                                    <td>{{$inq->inquiry->country['country_name']}}</td>

                                    <td>15/02/2017</td>

                                    <td>
                                        <ul class="list-inline">
                                            <li>
                                                <a href="{{url('/backend/inquiry/edit').'/'.$inq->inquiry->id}}">
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
                                                            <li><a href="#" onclick="createCloneInquiryStatus({{$inq->inquiry->id}}, 'deleted', 'trash')">Clone</a></li>

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


                </div>
            </div>
        </section>
    </div>
</div> 

<div class="modal fade modal-style transfer-sales" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h3 class="heading">Inquiry has been transferred to Sales Manager</h3>
                <p>General Inquiry is Successfully Transfered to Sales Manager</p>
                <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-style inquiry-solve" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h3 class="heading">Inquiry has been solved</h3>
                <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-style trash-bin" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h3 class="heading">inquiry has been transferred to trash bin! </h3>
                <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
@endsection
