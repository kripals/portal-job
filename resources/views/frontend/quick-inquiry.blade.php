<!-- Say Hello -->
<div class="sidebar-widgets">

    <div class="ur-detail-wrap">
        <div class="ur-detail-wrap-header">
            <h4>Get In Touch</h4>
        </div>
        <div class="ur-detail-wrap-body">
            <form action="{{route('contact.inquiry')}}" method="post" data-parsley-validate="">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email_address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" name="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>
<!-- /Say Hello -->
