<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.sales.orders.index.title')
    </x-slot:title>

    <!-- DataTables -->
  <link rel="stylesheet" href="/themes/manage/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/themes/manage/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/themes/manage/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="tables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Order ID</th>
                          <th>Status</th>
                          <th>Client</th>
                          <th>base_grand_total</th>
                          <th>Transaction Id</th>
                          <th>Payment Method</th>
                          <th>shipping_method</th>
                          <th>track_number</th>
                          <th>created_at</th>
                          <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>

                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- jQuery -->
<script src="/themes/manage/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/themes/manage/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="/themes/manage/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/themes/manage/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/themes/manage/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/themes/manage/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/themes/manage/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/themes/manage/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/themes/manage/AdminLTE/plugins/jszip/jszip.min.js"></script>
<script src="/themes/manage/AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/themes/manage/AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/themes/manage/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/themes/manage/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/themes/manage/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function () {
      $("#tables").DataTable({
        autoWidth: true,
        keys: true,
        ajax: {
          url: "{{ route('admin.sales.orders.index') }}",
          type: 'GET'
        },
        columns: [
          {
            data: 'increment_id'
          },
          {
            data: 'status'
          },
          {
            data: 'customer_email',
            render: function(data, type, row, meta) {
              return "<p>" + data + "</p>" + row['customer_first_name'] + ' ' +  row['customer_last_name'];
            }
          },
          {
            data: 'base_grand_total'
          },{
            data: 'transaction_id'
          },{
            data: 'method'
          },{
            data: 'shipping_method'
          },
          {
            data: 'track_number'
          },
          {
            data: 'created_at'
          },{
            data: 'oid',
            render: function(data, type, row, meta) {
              return '<a href="./orders/view/'+data+'">View</a>';
            }
          }
        ],
        lengthMenu: [
            [20, 50, 100],
            [20, 50, 100]
        ],
        order: [[8, 'desc']],
        processing: true,
        serverSide: true,
        
        






      });
    
    });
  </script>

</x-admin::layouts>

