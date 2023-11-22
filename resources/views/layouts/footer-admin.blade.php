

<footer class="main-footer text-sm bg-gradient-navy text-light">
        <strong>Copyright ©.
        <!-- <a href=""></a> -->
        </strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>  <a href="https://www.campcodes.com" target="blank"></a> </b>
        </div>
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <!-- <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
<script>
    $(document).ready(function(){
        window.viewer_modal = function($src = ''){
            start_loader()
            var t = $src.split('.')
            t = t[1]
            if(t =='mp4'){
                var view = $("<video src='"+$src+"' controls autoplay></video>")
            }else{
                var view = $("<img src='"+$src+"' />")
            }
            $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
            $('#viewer_modal .modal-content').append(view)
            $('#viewer_modal').modal({
                show:true,
                backdrop:'static',
                keyboard:false,
                focus:true
            })
            end_loader()

        }
        window.uni_modal = function($title = '' , $url='',$size=""){
            start_loader()
            $.ajax({
                url:$url,
                error:err=>{
                    console.log()
                    alert("An error occured")
                },
                success:function(resp){
                    if(resp){
                        $('#uni_modal .modal-title').html($title)
                        $('#uni_modal .modal-body').html(resp)
                        if($size != ''){
                            $('#uni_modal .modal-dialog').addClass($size+'  modal-dialog-centered')
                        }else{
                            $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered")
                        }
                        $('#uni_modal').modal({
                            show:true,
                            backdrop:'static',
                            keyboard:false,
                            focus:true
                        })
                        end_loader()
                    }
                }
            })
        }
        window._conf = function($msg='',$func='',$params = []){
            $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
            $('#confirm_modal .modal-body').html($msg)
            $('#confirm_modal').modal('show')
        }
    })
</script>
<script>
    $(document).ready(function() {
        $('.table').each(function() {
            // Get the desired sorting order from the data-sort-order attribute
            var sortOrder = $(this).data('sort-order') || 'asc';

            // Get the number of columns in the current table
            var numColumns = $(this).find('thead th').length;

            // Determine which columns should be non-orderable based on your criteria
            var nonOrderableColumns = [];
            // For example, make the last column non-orderable (change this based on your criteria)
            nonOrderableColumns.push(numColumns - 1);

            // Initialize DataTable for the current table
            var table = $(this).DataTable({
                columnDefs: nonOrderableColumns.map(function(index) {
                    return { orderable: false, targets: index };
                }),
                order: [0, sortOrder] // Set the initial sorting order based on the data-sort-order attribute
            });

            // Add classes to table cells (if needed)
            $('.dataTable td, .dataTable th', this).addClass('py-1 px-2 align-middle');

            // Debugging: Log some information about the table
            console.log('Table API:', table);
            console.log('Table data source:', table.ajax.json());

            // Debugging: Log column information
            table.columns().header().each(function(index) {
                console.log('Column ' + index + ' data source:', table.column(index).dataSrc());
            });
        });
    });
</script>


    <div class="daterangepicker ltr show-ranges opensright">
      <div class="ranges">
        <ul>
          <li data-range-key="Today">Today</li>
          <li data-range-key="Yesterday">Yesterday</li>
          <li data-range-key="Last 7 Days">Last 7 Days</li>
          <li data-range-key="Last 30 Days">Last 30 Days</li>
          <li data-range-key="This Month">This Month</li>
          <li data-range-key="Last Month">Last Month</li>
          <li data-range-key="Custom Range">Custom Range</li>
        </ul>
      </div>
      <div class="drp-calendar left">
        <div class="calendar-table"></div>
        <div class="calendar-time" style="display: none;"></div>
      </div>
      <div class="drp-calendar right">
        <div class="calendar-table"></div>
        <div class="calendar-time" style="display: none;"></div>
      </div>
      <div class="drp-buttons"><span class="drp-selected"></span><button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button><button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button> </div>
    </div>
    <div class="jqvmap-label" style="display: none; left: 1093.83px; top: 394.361px;">Idaho</div>
