    <div class="panel-box ">
        <div class="content-heading">
            <h3>Panels: </h3>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered  admin_table" style="margin:0px">
                <thead>
                    <tr>
                        <th>S.NO.</th>
                        <th>Panel No.</th>
                        <th>Panel Type</th>
                        <th>Panel Value</th>
                        <th>Installation Value</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(!empty($panels) && count($panels) > 0)
                    @foreach($panels as $key=>$panel)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>SS.021416.1.1</td>
                        <td>{{$panel->panel->panel_title}}</td>
                        <td>${{$panel->amount}}</td>
                        <!--<td style="width:75px"><input type="text" value="" class="form-control"></td>-->
                        <td>-</td>
                        <td>
                            <ul class="list-inline">
                                <li>
                                    <a href="3sided-l-shape-panel.php" data-toggle="tooltip" title="view more">
                                        <div class="action_icon">
                                            <button type="button" class="btn btn-xs">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" data-toggle="tooltip" title="edit">
                                        <div class="action_icon">
                                            <button type="button" class="btn btn-xs">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-info">No records found.</div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
