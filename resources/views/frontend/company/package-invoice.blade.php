@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
    <div class="clearfix"></div>

    <!-- General Detail Start -->
    <section class="dashboard-wrap">
        <div class="container-fluid">
            <div class="row">

                @include('layouts.frontend.company.main-side')

                <!-- Content Wrap -->
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-body">
                        <div class="dashboard-caption">

                            <div class="dashboard-caption-header">
                                <h4><i class="ti-wallet"></i>Job Packages</h4>
                            </div>

                            <div class="dashboard-caption-wrap">
                                <form action="{{route('company.package.purchase')}}" method="post">
                                    @csrf
                                <div class="table-responsive">
                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th scope="col">Days</th>
                                            <th scope="col">Rs. Per Day</th>
                                            <th scope="col">No. of Job</th>
                                            <th scope="col">Duration</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{$packageDetail->quantity}}</td>
                                            <td>
                                                {{$packageDetail->rate}}
                                                <input type="hidden" value="{{$packageDetail->rate}}" id="job_rate">
                                                <input type="hidden" value="job" name="type" id="job_rate">
                                                <input type="hidden" value="{{$packageDetail->slug}}" name="package">
                                            </td>
                                            <td><input type="number" id="job_quantity" name="job_quantity" value="1" min="1"></td>
                                            <td>{{$packageDetail->expiry_text}}</td>
                                            <td id="varTotal">{{$packageDetail->rate}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" name="submit" value="submit" class="btn-savepreview"><i class="ti-angle-double-right"></i>Purchase</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- General Detail End -->
    @endsection

@section('page-specific-scripts')
    <script>
        $('#job_quantity').on('change',function () {
            var qnt = $(this).val();
            var rate = $('#job_rate').val();
            var total = $('#varTotal');
            total.empty().append(qnt*rate);
        });
    </script>
@endsection
