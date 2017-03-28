                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">

                            <div class="space-25"></div>

                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li>
                                    <a class="comm_category_link" href="/{{ Request::segment(1) }}/communication?"> <i class="fa fa-inbox "></i> All Messages 
                                    @if($communicationCount > 0)
                                    <span class="label label-inverse pull-right">{{ $communicationCount }}</span> 
                                    @endif
                                    </a>
                                </li>

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