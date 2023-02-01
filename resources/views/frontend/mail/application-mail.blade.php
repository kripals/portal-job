<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Legends Zone - Job Application Response</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <style type="text/css">
        a[x-apple-data-detectors] {
            color: inherit !important;
        }
    </style>

</head>
<body style="margin: 0; padding: 0;">
<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="padding: 20px 0 30px 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
                   style="border-collapse: collapse;">
                <tr>
                    <td align="center">
                        <img src="{{asset('resources/frontend/assets/img/logo10.png')}}" alt="Legends Zone" width="300"
                             height="200" style="display: block;"/>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                               style="border-collapse: collapse;">
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif;">
                                    <h1 style="font-size: 24px; margin: 0;">Dear {{$candidate->user->full_name}},</h1>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                    @if($status == 'shortlisted')
                                    <p style="margin: 0;">Congratulations, you have been <strong>shortlisted</strong> for the applied job for <strong>{{$job->title}}</strong> in <strong>{{$company->company_name}}</strong>.</p>
                                    <p style="margin: 0;">Following are the company details for follow up.</p>
                                    <table>
                                        <tr>
                                            <td>Address: </td>
                                            <td>{{$company->address}}</td>
                                        </tr>
                                        <tr>
                                            <td>Contact Number: </td>
                                            <td>
                                                @foreach($company->contact_details()->get() as $contact)
                                                    {{ $contact->detail_value }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email Address: </td>
                                            <td>{{$company->user->email}}</td>
                                        </tr>
                                    </table>
                                    @else
                                        <p style="margin: 0;">Sorry, you have not been selected for the applied job for <strong>{{$job->title}}</strong> in <strong>{{$company->company_name}}</strong>.</p>
                                        <p style="margin: 0;">you can apply for another jobs in our <a href="http://legendszone.com.np/job-list/nepal" target="_blank">portal</a>.</p>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#03a84e" style="padding: 30px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                               style="border-collapse: collapse;">
                            <tr>
                                <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                    <p style="margin: 0;">© <a href="http://legendszone.com.np" target="_blank" style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">Legends Zone</a>, Tachikhel,Lalitpur,Nepal<br/>
                                         <a href="mailto:info@legendszone.com.np" style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;"">info@legendszone.com.np</a><br/>
                                         <a href="tel:+977-9802088552" style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;"">+977-9802088552</a><br/>
                                    </p>
                                </td>
                                <td align="right">
                                    <table border="0" cellpadding="0" cellspacing="0"
                                           style="border-collapse: collapse;">
                                        <tr>
                                            <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                                <a href="https://www.facebook.com/legendszonejobportal" target="_blank">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </td>
                                            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                            <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                                <a href="https://www.instagram.com/legends_zone_jobs/" target="_blank">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            </td>
                                            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                            <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                                <a href="https://www.linkedin.com/in/legends-zone-job-portal-35bb2b1a5/" target="_blank">
                                                    <i class="fa fa-linkedin"></i>
                                                </a>
                                            </td>
                                            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                            <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                                <a href="https://www.youtube.com/channel/UCsSDOayeS03Yr3tIPoiwbxw" target="_blank">
                                                    <i class="fa fa-youtube"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
