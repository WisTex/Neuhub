<!-- Site Info -->
<div class="generic-content-wrapper-styled">

    <h2>{{$title}}</h2>

        <div class="card mb-5">
            <div class="card-stamp">
                <div class="card-stamp-icon bg-blue">                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-affiliate-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M18.5 3a2.5 2.5 0 1 1 -.912 4.828l-4.556 4.555a5.475 5.475 0 0 1 .936 3.714l2.624 .787a2.5 2.5 0 1 1 -.575 1.916l-2.623 -.788a5.5 5.5 0 0 1 -10.39 -2.29l-.004 -.222l.004 -.221a5.5 5.5 0 0 1 2.984 -4.673l-.788 -2.624a2.498 2.498 0 0 1 -2.194 -2.304l-.006 -.178l.005 -.164a2.5 2.5 0 1 1 4.111 2.071l.787 2.625a5.475 5.475 0 0 1 3.714 .936l4.555 -4.556a2.487 2.487 0 0 1 -.167 -.748l-.005 -.164l.005 -.164a2.5 2.5 0 0 1 2.495 -2.336z" stroke-width="0" fill="currentColor"></path>
                    </svg>
                </div>
            </div>
            <div class="card-body">

                <h3>{{$sitenametxt}}</h3> <div>{{$sitename}}</div>

                <br/>

                <h3>{{$headline}}</h3>

                <div>{{if $site_about}}{{$site_about}}{{else}}--{{/if}}</div>
                <br>
                <h3>{{$admin_headline}}</h3>
    
                <div>{{if $admin_about}}{{$admin_about}}{{else}}--{{/if}}</div>

                {{* 
                <!-- Links to terms of service disabled here since our theme allows you to define an alternative link
                and there is no way to detect that in this template. -->
                <br><br>
                <div><a href="help/TermsOfService">{{$terms}}</a></div>
                *}}

            </div>
        </div>

    <h2>{{$prj_header}}</h2>

    <div class="card mb-5">
        <div class="card-stamp">
            <div class="card-stamp-icon bg-purple">
    
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-code" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M7 8l-4 4l4 4"></path>
                    <path d="M17 8l4 4l-4 4"></path>
                    <path d="M14 4l-4 16"></path>
                </svg>
            </div>
        </div>



        <div class="card-body">

            <h3>Hubzilla</h3>

            <div>{{$prj_name}} ({{$z_server_role}})</div>

            {{if $prj_version}}
                <div>{{$prj_version}}</div>
            {{/if}}

            <div>{{$prj_linktxt}}: <a href="{{$prj_link}}" target="_blank">{{$prj_link}}</a></div>

            <div>{{$prj_srctxt}}: <a href="{{$prj_src}}" target="_blank">{{$prj_src}}</a></div>

            <br>

            <h3>Neuhub</h3>

            <div>This website uses themes, addons, and widgets from Neuhub.</div>
            <div>Version 2.5</div>
            <div>Project homepage: <a href="https://neuhub.org" target="_blank">https://neuhub.org</a>
            <div>Repository: <a href="https://github.com/WisTex/Neuhub" target="_blank">https://github.com/WisTex/Neuhub</a></div>
            <hr>
            <h3>Technologies &amp; Protocols</h3>

            <ul>
                <li><div>{{$prj_transport}}: ({{$transport_link}}).</div></li>
                <li><div>Remote authentication provided by: OpenWebAuth (<a href="https://magicsignon.org" target="_blank">https://magicsignon.org</a>).</div></li>

                {{if $additional_fed}}
                    <li><div>{{$additional_text}} {{$additional_fed}}</div></li>
                {{/if}}
            </ul>
            
            <div>For more information on how these technologies work together, visit <a href="https://federatedhub.org">FederatedHub.org</a>.</div>
        </div>
    </div>
</div>
<!-- Site Info End -->