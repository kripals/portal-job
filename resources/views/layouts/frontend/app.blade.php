<!doctype html>
<html lang="en">
@include('layouts.frontend.head')
<body>
<div class="Loader"></div>
<div class="wrapper">
@yield('content')
@include('layouts.frontend.footer')
</div>
<!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            facebook: "433822004201393", // Facebook page ID
            whatsapp: "+977 980-2088552", // WhatsApp number
            call_to_action: "Message us", // Call to action
            button_color: "#03a84e", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "facebook,whatsapp", // Order of buttons
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->
</body>
</html>
