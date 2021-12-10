<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Data Company</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('company.store')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label> 
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                    placeholder="Enter Name" required focused>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="preview"></label> 
                <div class="post-review">
                    <img src="" class="img-responsive" onerror="this.src='{{(asset('assets/images/company.png'))}}'" width="100px">
                </div>
            </div>
            <div class="form-group">
                <label for="phone">Logo</label>
                <input type="file" class="form-control post-input" id="logo" name="logo" value="{{ old('logo') }}"
                    placeholder="Upload Logo">
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" name="website" id="website" value="{{ old('website') }}"
                    placeholder="Enter website">
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary submit-form">Submit</button>
            </div>
    </form>
</div>
<script src="{{ asset('js/apps.js') }}"></script>