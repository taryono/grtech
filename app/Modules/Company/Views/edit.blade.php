<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Data Company</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('company.update', $company->id)}}" method="POST">
        @csrf
        <input type="hidden" name="_method" name="id" value="PUT">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="hidden" name="id" value="{{$company->id}}">
                <input type="text" class="form-control" id="name" value="{{ $company->name }}"
                    placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="{{ $company->email }}" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="phone">Logo</label>
                <input type="file" class="form-control" id="logo" value="{{ $company->logo }}"
                    placeholder="Upload Logo">
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" value="{{ $company->website }}"
                    placeholder="Enter website">
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
    </form>
</div>
