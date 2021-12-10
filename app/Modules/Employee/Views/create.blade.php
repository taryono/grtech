<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add Data Employee</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('employee.store')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        @csrf 
      <div class="card-body">
        <div class="form-group">
          <label for="first_name">First Name</label> 
          <input type="text" class="form-control" id="first_name" name="first_name" value="{{old('first_name')}}" placeholder="Enter First Name" required>
        </div>
        <div class="form-group">
          <label for="last_name">Last Name</label>
          <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name')}}" placeholder="Last Name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Email">
        </div>
        <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" placeholder="Phone">
        </div>
        <div class="form-group">
            <label for="company_id">Company</label>
            <select name="company_id" class="form-control">
                @foreach (App\Models\Company::select('name','id')->get() as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
          </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary submit-form">Submit</button>
      </div>
    </form>
  </div>