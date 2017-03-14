                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            {{-- <a class="btn btn-block btn-primary compose-mail" href="mail_compose.html">Compose Mail</a> --}}
                            <div class="space-25"></div>
                            {{-- <h5>Folders</h5> --}}
                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li>
                                    <a class="comm_category_link" href="/{{ Request::segment(1) }}/communication?"> <i class="fa fa-inbox "></i> All Messages 
                                    @if($communicationCount > 0)
                                    <span class="label label-inverse pull-right">{{ $communicationCount }}</span> 
                                    @endif
                                    </a>
                                </li>
{{--                                 <li><a href="mailbox.html"> <i class="fa fa-envelope-o"></i> Send Mail</a></li>
                                <li><a href="mailbox.html"> <i class="fa fa-certificate"></i> Important</a></li> --}}
{{--                                 <li><a href="mailbox.html"> <i class="fa fa-file-text-o"></i> Drafts <span class="label label-danger pull-right">2</span></a></li>
                                <li><a href="mailbox.html"> <i class="fa fa-trash-o"></i> Trash</a></li> --}}
                            </ul>
                            <h5>Categories</h5>
                            <ul class="category-list" style="padding: 0">
                            @foreach($communicationTypes as $c)

                                @if( $c->id != "1" && $c->id != "2")
                                <li><a class="comm_category_link" href="/{{ Request::segment(1) }}/communication?type={{ $c->id }}"> <span class="label label-{{ $c->colour }} pull-right">{{ $c->count }}</span> {{ $c->communication_type }}</a></li>
                                @endif 

                            @endforeach
                            </ul>
                                
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>