@extends('layouts/app')
@section('content')
<div class="content">
    <div class="container">
            <div>
                <h1>Add Expense</h1>
            </div>

        <form action="{{route('add.store')}}" class="mt-3" id="expense" method="POST">
                            @csrf

  <div class="form-group">
    <label for="EnterAmount">Enter Amount(₹)</label>
    <input input type="number" value="" class="form-control" id="expenseamount" name="expenseamount" placeholder="Enter Amount">
  </div>
  <div class="form-group">
    <label for="expensedate">Date</label>
    <input type="date" class="form-control col-sm-12" value=""
                                name="expensedate" id="expensedate" required> 
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Category</label>
    <select class="form-control" name="expensecategory" id="exampleFormControlSelect1">
         @foreach ($data as $category)                                    
             <option value="{{$category->name}}">{{$category->name}}</option>
         @endforeach     
    </select>
  </div>
  <div class="form-group">
    <label for="Enter Description">Description</label>
        <div>
            <textarea placeholder="Enter description" class="form-control col-sm-12" name="expensedescription"></textarea>
        </div>
  </div>
  <button type="submit" name="add" class="btn btn-primary">Submit</button>
</form>
    </div>
</div>
@endsection