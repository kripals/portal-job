<!DOCTYPE html>
<html>
<head>
    <title>{{$candidate->user->full_name}} - Curriculum Vitae</title>

    <meta name="viewport" content="width=device-width"/>
    <meta name="description" content="The Curriculum Vitae of "{{$candidate->user->full_name}}"."/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- <meta charset="UTF-8"> -->

    {{--    <link type="text/css" rel="stylesheet" href="style.css">--}}
    <link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style>
        html, body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, abbr, address, cite, code, del, dfn, em, img, ins, kbd, q, samp, small, strong, sub, sup, var, b, i, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary, time, mark, audio, video {
            border: 0;
            font: inherit;
            font-size: 100%;
            margin: 0;
            padding: 0;
            vertical-align: baseline;
        }

        article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {
            display: block;
        }

        /*html, body {background: #181818; font-family: 'Lato', helvetica, arial, sans-serif; font-size: 16px; color: #222;}*/

        .clear {
            clear: both;
        }

        p {
            font-size: 1em;
            line-height: 1.4em;
            margin-bottom: 20px;
            color: #444;
        }

        #cv {
            width: 100%;
            max-width: 800px;
            /*background: #f3f3f3;*/
            margin: 30px auto;
        }

        .mainDetails {
            padding: 25px 35px;
            border-bottom: 2px solid #03a84e;
            /*background: #ededed;*/
        }

        #name h1 {
            font-size: 2em;
            font-weight: 700;
            font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
            margin-bottom: -6px;
        }

        #name h2 {
            font-size: 2em;
            margin-left: 2px;
            font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
        }

        #mainArea {
            padding: 0 40px;
        }

        #headshot {
            width: 12.5%;
            float: left;
            margin-right: 30px;
        }

        #headshot img {
            width: 100%;
            height: auto;
            -webkit-border-radius: 50px;
            border-radius: 50px;
        }

        #name {
            float: left;
        }

        #contactDetails {
            float: right;
        }

        #contactDetails ul {
            list-style-type: none;
            font-size: 0.9em;
            margin-top: 2px;
        }

        #contactDetails ul li {
            margin-bottom: 3px;
            color: #444;
        }

        #contactDetails ul li a, a[href^=tel] {
            color: #444;
            text-decoration: none;
            -webkit-transition: all .3s ease-in;
            -moz-transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -ms-transition: all .3s ease-in;
            transition: all .3s ease-in;
        }

        #contactDetails ul li a:hover {
            color: #03a84e;
        }


        section {
            border-top: 1px solid #dedede;
            padding: 20px 0 0;
        }

        section:first-child {
            border-top: 0;
        }

        section:last-child {
            padding: 20px 0 10px;
        }

        .sectionTitle {
            float: left;
            width: 25%;
        }

        .sectionContent {
            float: right;
            width: 72.5%;
        }

        .sectionTitle h1 {
            font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
            font-style: italic;
            font-size: 1.5em;
            color: #03a84e;
        }

        .sectionContent h2 {
            font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
            font-size: 1.5em;
            margin-bottom: -2px;
        }

        .subDetails {
            font-size: 0.8em;
            font-style: italic;
            margin-bottom: 3px;
        }

        .keySkills {
            list-style-type: none;
            /*-moz-column-count: 3;*/
            /*-webkit-column-count: 3;*/
            /*column-count: 3;*/
            margin-bottom: 20px;
            font-size: 1em;
            color: #444;
        }

        .keySkills ul li {
            margin-bottom: 3px;
        }

        @media all and (min-width: 602px) and (max-width: 800px) {
            #headshot {
                display: none;
            }

            .keySkills {
                -moz-column-count: 2;
                -webkit-column-count: 2;
                column-count: 2;
            }
        }

        @media all and (max-width: 601px) {
            #cv {
                width: 95%;
                margin: 10px auto;
                min-width: 280px;
            }

            #headshot {
                display: none;
            }

            #name, #contactDetails {
                float: none;
                width: 100%;
                text-align: center;
            }

            .sectionTitle, .sectionContent {
                float: none;
                width: 100%;
            }

            .sectionTitle {
                margin-left: -2px;
                font-size: 1.25em;
            }

            .keySkills {
                -moz-column-count: 2;
                -webkit-column-count: 2;
                column-count: 2;
            }
        }

        @media all and (max-width: 480px) {
            .mainDetails {
                padding: 15px 15px;
            }

            section {
                padding: 15px 0 0;
            }

            #mainArea {
                padding: 0 25px;
            }


            .keySkills {
                -moz-column-count: 1;
                -webkit-column-count: 1;
                column-count: 1;
            }

            #name h1 {
                line-height: .8em;
                margin-bottom: 4px;
            }
        }

        @media print {
            #cv {
                width: 100%;
            }
        }

        @-webkit-keyframes reset {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 0;
            }
        }

        @-webkit-keyframes fade-in {
            0% {
                opacity: 0;
            }
            40% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @-moz-keyframes reset {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 0;
            }
        }

        @-moz-keyframes fade-in {
            0% {
                opacity: 0;
            }
            40% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes reset {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 0;
            }
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
            }
            40% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .instaFade {
            -webkit-animation-name: reset, fade-in;
            -webkit-animation-duration: 1.5s;
            -webkit-animation-timing-function: ease-in;

            -moz-animation-name: reset, fade-in;
            -moz-animation-duration: 1.5s;
            -moz-animation-timing-function: ease-in;

            animation-name: reset, fade-in;
            animation-duration: 1.5s;
            animation-timing-function: ease-in;
        }

        .quickFade {
            -webkit-animation-name: reset, fade-in;
            -webkit-animation-duration: 2.5s;
            -webkit-animation-timing-function: ease-in;

            -moz-animation-name: reset, fade-in;
            -moz-animation-duration: 2.5s;
            -moz-animation-timing-function: ease-in;

            animation-name: reset, fade-in;
            animation-duration: 2.5s;
            animation-timing-function: ease-in;
        }

        .delayOne {
            -webkit-animation-delay: 0, .5s;
            -moz-animation-delay: 0, .5s;
            animation-delay: 0, .5s;
        }

        .delayTwo {
            -webkit-animation-delay: 0, 1s;
            -moz-animation-delay: 0, 1s;
            animation-delay: 0, 1s;
        }

        .delayThree {
            -webkit-animation-delay: 0, 1.5s;
            -moz-animation-delay: 0, 1.5s;
            animation-delay: 0, 1.5s;
        }

        .delayFour {
            -webkit-animation-delay: 0, 2s;
            -moz-animation-delay: 0, 2s;
            animation-delay: 0, 2s;
        }

        .delayFive {
            -webkit-animation-delay: 0, 2.5s;
            -moz-animation-delay: 0, 2.5s;
            animation-delay: 0, 2.5s;
        }

        .subDetails span {
            padding: 0px 20px;
        }
    </style>
</head>

<body id="top">
<div id="cv" class="instaFade">
    <div class="mainDetails">
        @if(!empty($candidate->user->avatar))
            <div id="headshot" class="quickFade">
                <img src="{{public_path('uploads/user/thumb/'.$candidate->user->avatar)}}"
                     alt="{{$candidate->user->full_name}}"/>
            </div>
        @endif


        <div id="name">
            <h1 class="quickFade delayTwo">{{$candidate->user->full_name}}</h1>
            <h2 class="quickFade delayThree">{{$candidate->category->name}}</h2>
        </div>

        <div id="contactDetails" class="quickFade delayFour">
            <ul>
                <li>Email: <a href="{{$candidate->user->email}}" target="_blank">{{$candidate->user->email}}</a></li>
                @if(!empty($candidate->filter_contact_details))
                @foreach($candidate->filter_contact_details as $contact_details)
                    {{--                    {{dd($contact_details)}}--}}
                    <li>Phone: {{ $contact_details['detail_value'] }}@if(!empty($contact_details['detail_value']))
                            ({{ $contact_details['detail_key'] }})@endif</li>
                @endforeach
            @endif
            </ul>
        </div>
        <div class="clear"></div>
    </div>

    <div id="mainArea" class="quickFade delayFive">
        <section>
            <article>
                <div class="sectionTitle">
                    <h1>Personal Information</h1>
                </div>
                <div class="sectionContent" id="contactDetails">
                    <table>
                        <tr>
                            <td><span>Gender:</span></td>
                            <td>{{ucwords($candidate->gender)?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td><span>Nationality:</span></td>
                            <td>{{ucwords($candidate->nationality)?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td><span>Religion:</span></td>
                            <td>{{ucwords($candidate->religion)?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td><span>Marital Status:</span></td>
                            <td>{{ucwords($candidate->marital_status)?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td><span>Permanent Address:</span></td>
                            <td>@if(!empty($candidate->filter_permanent_address)){{$candidate->filter_permanent_address}}@else {{'N/A'}} @endif</td>
                        </tr>
                        <tr>
                            <td><span>Current Address:</span></td>
                            <td>@if(!empty($candidate->current_address)){{$candidate->filter_current_address}}@else {{'N/A'}} @endif</td>
                        </tr>
                        <tr>
                            <td><span>Date Of Birth:</span></td>
                            <td>{{$candidate->filter_dob ?? 'N/A'}}</td>
                        </tr>
                        @if($candidate->job_level)
                            <tr>
                                <td><span>Job Level:</span></td>
                                <td>{{ $candidate->job_level->title?? 'N/A' }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td><span>Available For:</span></td>
                            <td>
                                @if($candidate->job_types->isNotEmpty())
                                    @foreach($candidate->job_types as $job_type)
                                        {{ $job_type->title }}@if(!$loop->last),@endif
                                    @endforeach
                                @else
                                    {{'N/A'}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><span>Total Experience:</span></td>
                            <td>{{ $candidate->experience_text ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td><span>Preferred Location:</span></td>
                            <td>
                                @if($candidate->job_types->isNotEmpty())
                                    @foreach($candidate->preferred_locations as $preferred_location)
                                        {{$preferred_location->title}} @if(!$loop->last),@endif
                                    @endforeach
                                @else
                                    {{'N/A'}}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </article>
            <div class="clear"></div>
        </section>

        @if(!$candidate->experience->isEmpty())
            <section>
                <div class="sectionTitle">
                    <h1>Work Experience</h1>
                </div>
                <div class="sectionContent">
                    @foreach($candidate->experience as $experience)
                        <article>
                            <h2>{{$experience->job_title}} at {{ $experience->company_name  }}</h2>
                            <p class="subDetails">{{ ($experience->is_current == 'yes') ? 'Currently Working' : date('M Y',strtotime($experience->start_date)). ' - ' .date('M Y',strtotime($experience->end_date)) }}</p>
                            {!! $experience->description !!}
                        </article>
                    @endforeach
                </div>
                <div class="clear"></div>
            </section>
        @endif

        @if(!$candidate->education->isEmpty())
            <section>
                <div class="sectionTitle">
                    <h1>Education</h1>
                </div>

                <div class="sectionContent">
                    @foreach($candidate->education as $education)
                        <article>
                            <h2>{{$education->institute_name}} {{ !empty($education->board) ? '('.ucwords($education->board->title).')' : ''}}</h2>
                            <p class="subDetails">{{ $education->program_name }}</p>
                            <span
                                class="exp-jb-comp">
                                                                        @if($education->is_current == 'yes')
                                    {{'Currently Studying'}}
                                @elseif(!empty($education->passing_year))
                                    {{'Passing Year: '.$education->passing_year }}
                                @else
                                    {{'Passing Year: N/A'}}
                                @endif
                                                                    </span>
                            <br/>
                            <span
                                class="exp-jb-comp">
                                                                        @if($education->marks_type == 'cgpa')
                                    CGPA: {{$education->marks_obtained ?? 'N/A'}}
                                @elseif($education->marks_type == 'percent')
                                    @if(!empty($education->marks_obtained))
                                        {{$education->marks_obtained.'%'}}
                                    @else
                                        {{'Marks Obtained : N/A'}}
                                    @endif
                                @else
                                    {{'Marks Obtained : N/A'}}
                                @endif
                                                                    </span>
                        </article>
                    @endforeach
                </div>
                <div class="clear"></div>
            </section>
        @endif

        @if(!$candidate->training->isEmpty())
            <section>
                <div class="sectionTitle">
                    <h1>Trainings</h1>
                </div>

                <div class="sectionContent">
                    @foreach($candidate->training as $training)
                        <article>
                            <h2>{{$training->name}} at {{ $training->agency_name }}</h2>
                            <p class="subDetails">{{ prettyDate($training->start_date) }}
                                -{{ prettyDate($training->end_date) }} </p>
                        </article>
                    @endforeach
                </div>
                <div class="clear"></div>
            </section>
        @endif

        @if(!$candidate->known_skills->isEmpty() || !empty($candidate->interest))
            <section>
                <div class="sectionTitle">
                    <h1>Interests & Skills</h1>
                </div>

                <div class="sectionContent">
                    @if(!$candidate->known_skills->isEmpty())
                        <h4>Skills</h4>
                        <ul class="keySkills">
                            @foreach($candidate->known_skills as $skills)
                                <li>{{ $skills->title }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if(!empty($candidate->interest))
                        <h4>Interests</h4>
                        <ul class="keySkills">
                            @foreach(explode(',',$candidate->interest) as $interest)
                                <li>{{ $interest }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="clear"></div>
            </section>
        @endif

        @if(!$candidate->language->isEmpty())
            <section>
                <div class="sectionTitle">
                    <h1>Language</h1>
                </div>
                <div class="sectionContent">
                    @foreach($candidate->language as $language)
                        <article>
                            <h2>{{ ucwords($language->name)}}</h2>
                            <p class="subDetails">
                                <span> Reading: {{ ucwords($language->reading)}}</span>
                                <span> Writing: {{ ucwords($language->writing)}}</span><br/>
                                <span>Speaking: {{ ucwords($language->speaking)}}</span>
                                <span>Listening: {{ ucwords($language->listening)}}</span>
                            </p>
                        </article>
                    @endforeach
                </div>
                <div class="clear"></div>
            </section>
        @endif

        @if(!$candidate->social_medias->isEmpty())
            <section>
                <div class="sectionTitle">
                    <h1>Social Medias</h1>
                </div>

                <div class="sectionContent">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>Media</th>
                            <th>URL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($candidate->social_medias as $media)
                            <tr>
                                <td>{{ ucwords($media->media_key)}}</td>
                                <td><a href="{{ $media->media_value}}"
                                       target="_blank">{{ $media->media_value}}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="clear"></div>
            </section>
        @endif

        @if(!$candidate->reference->isEmpty())
            <section>
                <div class="sectionTitle">
                    <h1>References</h1>
                </div>

                <div class="sectionContent">
                    <ul class="keySkills">
                        @foreach($candidate->reference as $reference)
                            <article>
                                <h2>{{$reference->name}} at {{$reference->company_name}}</h2>
                                <p class="subDetails">
                                    <a href="mailto:{{ $reference->email }}">{{ $reference->email ?? '' }}</a><br/>
                                    <a href="tel:{{$reference->phone}}">{{$reference->phone ?? ''}}</a><br/>
                                    <a href="tel:{{$reference->phone2}}">{{$reference->phone2 ?? ''}}</a><br/>
                                </p>
                            </article>
                        @endforeach
                    </ul>
                </div>
                <div class="clear"></div>
            </section>
        @endif
    </div>
</div>
</body>
</html>
