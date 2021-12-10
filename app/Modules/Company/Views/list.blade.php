    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Companies</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                              <div class="col-2">
                                <h3 class="card-title">List Employees</h3>
                              </div>
                              <div class="col-9">
                                
                              </div>
                              <div class="col-1">
                                <a href="{{route('company.create')}}" class="edit btn btn-block btn-primary btn-sm col-xs-3" data-toggle="modal" data-target="#modal-detail" data-title="Add Company">Add </a>                   
                              </div>
                            </div>
                          </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="company" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Index</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Logo</th>
                                        <th>Website</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content --> 