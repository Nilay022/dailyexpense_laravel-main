@extends('layouts/app')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                @php($ex = \Illuminate\Support\Facades\Auth::user()->expense_limit)
                @if($total >= $ex)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Your monthly Limit has cross!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Expense manage</h3>
                            <div class="col-12" style="text-align: right;">
                                <a onclick="printDiv('printableArea')" class="btn btn-default"><i
                                        class="fas fa-print"></i> Print</a>
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
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($expense))
                                @foreach ($expense as $e)
                                    <tr>
                                        <td> {{$e->id}}</td>
                                        <td> {{$e->date}}</td>
                                        <td> {{$e->expense}}</td>
                                        <td> {{$e->category}}</td>
                                        <td>
                                            <a data-toggle="modal" data-target="#addModal" class="text-primary" style="cursor: pointer;" onclick="update_expense({{$e->id}})">Edit</a>&nbsp;
                                            <a href="{{ route('delete', $e->id)}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr class="text-center">
                                    <td>NO DATA FOUND</td>
                                </tr>    
                                @endif
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('update')}}" class="mt-3" id="expense" method="POST">
                @csrf

        <input type="hidden" id="eid" name="id">        
         <div class="form-group">
    <label for="EnterAmount">Enter Amount(₹)</label>
    <input type="number"  class="form-control" id="expenseamount" name="expenseamount" placeholder="Enter Amount">
  </div>
  <div class="form-group">
    <label for="expensedate">Date</label>
    <input type="date" class="form-control col-sm-12" 
                                name="expensedate" id="expensedate" required> 
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Category</label>
    <select class="form-control" name="expensecategory" id="exampleFormControlSelect1">
         @foreach ($category as $data)                                    
             <option>{{$data->name}}</option>
         @endforeach     
    </select>
  </div>
  <div class="form-group">
    <label for="Enter Description">Description</label>
        <div>
            <input type="text" placeholder="Enter description" class="form-control" id="expensedescription" name="expensedescription"></input>
        </div>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>

            </form>
        </form>
      </div>
    </div>
  </div>
</div>
    </section>

@endsection
@section('js')
    <script>
        @if (session()->has('success'))
        swal.fire("Done!", "{{ session()->get('success') }}", "success");
        @elseif(session()->has('error'))
        swal.fire("Error!", "{{ session()->get('error') }}", "error");
        @endif

        function update_expense(id)
        {
            $.ajax({
                url: "{{url('updateexp/')}}/"+id,
                type: 'GET',
                statusCode:{

                    200: function (response) {
                        $('#eid').val(response.id);
                        $('#expenseamount').val(response.expense);
                        $('#expensedate').val(response.date);
                        $('#exampleFormControlSelect1').val(response.category);
                        $('#expensedescription').val(response.description);
                        $('#addModal').modal('show');
                    }
                },
            });
        }
    </script>

@endsection
