@extends('layouts/app')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Report</h3>
                                
                            </div>
                            <div class="col-12" style="text-align: right;" >
                                <a onclick="printDiv('printableArea')" class="btn btn-default"><i
                                        class="fas fa-print"></i> PDF</a>
                                        <a class="btn btn-default export_to_excel" onclick="exportdetail()"><i
                                        class="fas fa-print"></i>EXCEL</a>
                                        <div style="text-align: left;">
                                        <label>Starting Date</label>
                                        <input type="date" required id="sdate">
                                         <label class="ml-3">Ending Date</label>
                                        <input type="date" required id="edate">
                                            <input class="btn btn-primary" onclick="updatetable();" type="submit" value="submit">
                                        </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body" id="printableArea">
                            <table id="example2" class="table table-bordered table-hover text-center">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Expense Category</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                    
                                </tbody>
                          
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>

    </section>

@endsection
@section('js')
    <script>
       function updatetable()
       {
        var sdata = $("#sdate").val();
        var edata = $("#edate").val();
        if(sdata == "" && edata == ""){
            alert('please enter dates');
          
        }
        else{

            $.ajax({
                url: "{{url('reportupdate/')}}",
                type: 'POST',
                header: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]')},
                data: {
                    "_token": "{{ csrf_token() }}",
                    "startdate" : sdata,
                    "enddate" : edata
                },
                statusCode:{
                200: function (response) {
                    var html = "";
                    
                    if(response.length > 0)
                    {
                        $.each(response, (index, value) =>{
                            html += `<tr><td>${value.id}</td><td>${value.date}</td><td>${value.expense}</td><td>${value.category}</td></tr>`;
                            });
                            $('table tbody').append(html)
                    }
                    else
                    {
                        html += `<tr><td colspan="4">data Not found</td></tr>`; 
                            $('table tbody').append(html)
                    }
                }
                },
                error: function (error) {
                    console.log(error);
                }
                });
        }
       }

       function exportdetail()
       {
            var sdata = $("#sdate").val();
        var edata = $("#edate").val();
        $.ajax({
            url: "{{url('exportdata/')}}",
            type: 'POST',
            header: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]')},
            data: {
                "_token": "{{ csrf_token() }}",
                "startdate" : sdata,
                "enddate" : edata
            },
            statusCode:{
            200: function (response) {
                
            }
            },
            error: function (error) {
                console.log(error);
            }
            });
       }

    </script>

@endsection
