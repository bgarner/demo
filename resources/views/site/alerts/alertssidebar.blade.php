                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            {{-- <a class="btn btn-block btn-primary compose-mail" href="mail_compose.html">Compose Mail</a> --}}
                            <div class="space-25"></div>
                            {{-- <h5>Folders</h5> --}}
                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li>
                                    <a class="alert_category_link" href="/{{ Request::segment(1) }}/alerts?"> <i class="fa fa-bell "></i>{{ trans('lang.label.all_alerts') }}
                                    @if($alertCount > 0)
                                    <span class="label label-inverse pull-right">{{ $alertCount }}</span>
                                    @endif
                                    </a>
                                </li>

                            </ul>
                            <h5>{{ trans('Categories') }}</h5>
                            <ul class="category-list" style="padding: 0">
                            @foreach($alertTypes as $at)

                                <li><a class="alert_category_link" href="/{{ Request::segment(1) }}/alerts?type={{ $at->id }}"> <span class="label label pull-right">{{ $at->count }}</span> {{ $at->name }}</a></li>

                            @endforeach
                            </ul>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
