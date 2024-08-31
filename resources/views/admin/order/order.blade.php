@extends('admin.include.master')
@section('body')
<div style="background-color: #3498DB; width:100%;height:190px;">
    <div class="col-md-6">
    <h2 style="margin: 0; color: white; text-shadow: 2px 2px 4px #000000; padding: 12px 50px 0 100px;">Orders Information</h2>
    <h6 style="margin-top: 2px; padding: 0 50px 0 100px;">
        <ul class="breadcrumb" style="padding: 0; margin:0;">
            <li><a href="{{ route('dashboard') }}" style="color: white;">Dashboard</a></li>
            <li class="active">Orders</li>
        </ul>
    </h6>
</div>
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        {{-- <?php
        $productCount = $products->count();    
        ?> --}}
        <div class="table-header">
            All Products 
        </div>
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">S/N</th>
                        <th class="center">OrderId</th>
                        <th class="center">Name</th>
                        <th class="center">Email</th>
                        <th class="center">Phone</th>
                        <th class="center">productCode</th>
                        <th class="center">Address</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $sl=>$order)
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $order->orderId }}</td>
                                <td>{{ $order->name }}
                                </td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->productCode }}</td>
                                <td>{{ $order->address }}</td>
                                <td>
                                   
                                    
                                </td>
                            </tr>
                        @endforeach
                        </form>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@push('js')
    <!-- page specific plugin scripts -->
    <script src="{{ asset('admin-asset/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-asset/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(function($) {
            //initiate dataTables plugin
            var myTable = 
            $('#dynamic-table')
            .DataTable( {
                bAutoWidth: false,
                "aoColumns": [
                  { "bSortable": false },
                  null, null, null, null, null,null, 
                  { "bSortable": false }
                ],
                
            } );
        })
    </script>
    <script>
        function confirmAndSubmit(productId) {
            if (confirm('Are You Sure Delete This!')) {
                document.getElementById('delete-form-' + productId).submit();
            }
        }
    </script>
    @if (session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 5000,
            close: true,
            gravity: "bottom",
            position: "left",
            stopOnFocus: true,
            backgroundColor: "rgba(40, 167, 69, 0.9)"
        }).showToast();
    </script>
@endif
@endpush