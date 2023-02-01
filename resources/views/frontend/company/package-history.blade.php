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
                                <h4><i class="ti-wallet"></i>Purchase History</h4>
                            </div>

                            <div class="dashboard-caption-wrap">

{{--                                <a href="choose-package.html" class="btn-savepreview small-btn mrg-bot-30"><i class="ti-angle-double-right"></i>New Package</a>--}}

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Order</th>
                                            <th scope="col">Package</th>
                                            <th scope="col">Jobs Posting</th>
                                            <th scope="col">Duration</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($company->packages as $package)
                                        <tr>
                                            <th scope="row">#{{$package->pivot->order_id}}</th>
                                            <td>{{$package->title}}</td>
                                            <td>{{$package->pivot->quantity}}</td>
                                            <td>{{$package->expiry_text}}</td>
                                            <td><span data-toggle="tooltip" class="publish" title="" data-original-title="Active"><i class="ti-check-box"></i></span></td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" align="center">No Purchase has been made. <a href="{{route('company.package.list')}}">Explore our packages.</a></td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- General Detail End -->
    @endsection
