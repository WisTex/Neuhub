
<div class="card">
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                      <li class="nav-item">
<a class="nav-link{{if $smarty.server.SCRIPT_URL == "/apps" or $smarty.server.SCRIPT_URL == "/apps/"}} active{{/if}}" href="/apps">
                          Installed Apps
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link{{if $smarty.server.SCRIPT_URL == "/apps/available" or $smarty.server.SCRIPT_URL == "/apps/available/"}} active{{/if}}" href="/apps/available">
                          Available Apps
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link{{if $smarty.server.SCRIPT_URL == "/apps/edit" or $smarty.server.SCRIPT_URL == "/apps/edit/"}} active{{/if}}" href="/apps/edit">
                          Manage Apps
                        </a>
                      </li>
					  <!--
                      <li class="nav-item">
                        <a class="nav-link" href="/appman">
                          Create Apps
                        </a>
                      </li>
					  -->
					  <!--
                      <li class="nav-item ms-auto">
                        <a class="nav-link" href="#">
                         
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                        </a>
                      </li>
					  -->
                    </ul>
                  </div>
                  <div class="card-body">
                    

					  <div class="generic-content-wrapper">
					  <div class="section-title-wrapper clearfix">
						  {{if $authed}}
							  {{if $create}}
								  <a href="appman" class="float-end btn btn-success btn-sm"><i class="fa fa-pencil-square-o"></i>&nbsp;{{$create}}</a>
							  {{elseif $manage}}
								  <a href="apps/edit{{if $cat.0}}/?f=&cat={{$cat.0}}{{/if}}" class="float-end btn btn-primary btn-sm">{{$manage}}</a>
							  {{/if}}
						  {{/if}}

						  

						  <h2 class="mb-3">{{if $smarty.server.SCRIPT_URL == "/apps/edit" or $smarty.server.SCRIPT_URL == "/apps/edit/"}}Manage {{/if}}{{$title}}{{if $cat.0}} - {{$cat.0}}{{/if}}</h2>

							

							{{if $smarty.server.SCRIPT_URL == "/apps" or $smarty.server.SCRIPT_URL == "/apps/"}}
								<p class="text-secondary">Applications currently installed on your channel. You access your apps from this page and select which applications appear in your navigation.</p>
							{{/if}}

							{{if $smarty.server.SCRIPT_URL == "/apps/available" or $smarty.server.SCRIPT_URL == "/apps/available/"}}
								<p class="text-secondary">All applications available on this server. You can install or update applications from this page.</p>
							{{/if}}

							{{if $smarty.server.SCRIPT_URL == "/apps/edit" or $smarty.server.SCRIPT_URL == "/apps/edit/"}}
								<p class="text-secondary">You can remove applications you no longer want. Advanced users can also edit the details about applications.</p>
							{{/if}}
							
					  </div>
					  <div class="clearfix section-content-wrapper-np">
						  {{foreach $apps as $ap}}
							  {{$ap}}
						  {{/foreach}}
					  </div>
				  </div>
				  {{if $smarty.server.SCRIPT_URL == "/apps" or $smarty.server.SCRIPT_URL == "/apps/"}}
				  <hr>
				  <p class="text-secondary"><b>Location of Apps in Navigation</b>: On a large screen, pinned apps will appear in the quick access section of the top navigation bar, 
				  and starred apps will appear in the left sidebar and in the Apps menu on the top navigation bar. 
								On mobile, pinned apps will appear in the bottom quick access menu, and starred apps will appear in the top menu. Other themes may located your apps elsewhere.</p>
				  {{/if}}
                  </div>
                </div>





