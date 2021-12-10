<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Data Company</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('company.update', $company->id)}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" name="id" value="PUT">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="hidden" name="id" value="{{$company->id}}">
                <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}"
                    placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $company->email }}" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="preview"></label> 
                <div class="post-review">
                    <img src="{{$company->logo?asset('logo/'.$company->logo):null}}" class="img-responsive" onerror="this.src='{{(asset('assets/images/company.png'))}}'" width="100px">
                </div>
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control post-input" id="logo" name="logo" value="{{ $company->logo }}"
                    placeholder="Upload Logo">
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" name="website" value="{{ $company->website }}"
                    placeholder="Enter website">
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary update-form">Submit</button>
            </div>
    </form>
</div>
<script src="{{ asset('js/apps.js') }}"></script>