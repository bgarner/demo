<?php

use Illuminate\Database\Seeder;

class HelpSectionTableSeeder extends Seeder
{
    
    private $helpSections = [

    	[
    		'parent_view' => 'site.dashboard.index',
    		'section'     => 'help_dashboard_search',
    		'title'		  => 'Search',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.dashboard.index',
    		'section'     => 'help_dashboard_featuredTile',
    		'title'		  => 'Featured Tiles',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.dashboard.index',
    		'section'     => 'help_dashboard_featuredVideo',
    		'title'		  => 'Featured Video',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.dashboard.index',
    		'section'     => 'help_dashboard_quicklinks',
    		'title'		  => 'Quick Links',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.dashboard.index',
    		'section'     => 'help_dashboard_latestCommunication',
    		'title'		  => 'Latest Communication',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.dashboard.index',
    		'section'     => 'help_dashboard_recentUploads',
    		'title'		  => 'Recent Uploads',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.dashboard.index',
    		'section'     => 'help_dashboard_bannerSwitch',
    		'title'		  => 'Banner Switch',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.dashboard.index',
    		'section'     => 'help_dashboard_notifications',
    		'title'		  => 'Notifications',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

    	//----------------------------------------------

    	[
    		'parent_view' => 'site.urgentnotices.index',
    		'section'     => 'help_urgentnotice_overall',
    		'title'		  => 'Urgent Notices',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

    	//----------------------------------------------

    	[
    		'parent_view' => 'site.calendar.index',
    		'section'     => 'help_calendar_overall',
    		'title'		  => 'Calendar',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

    	//----------------------------------------------

    	[
    		'parent_view' => 'site.calendar.productlaunch.index',
    		'section'     => 'help_productlaunch_overall',
    		'title'		  => 'Product Launch',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

    	//----------------------------------------------

    	[
    		'parent_view' => 'site.communications.index',
    		'section'     => 'help_communication_overall',
    		'title'		  => 'Communications',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

        [
            'parent_view' => 'site.communications.index',
            'section'     => 'help_communication_category',
            'title'       => 'Category Communications',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
            'status'      => 'on'
        ],

    	[
    		'parent_view' => 'site.communications.index',
    		'section'     => 'help_communication_archives',
    		'title'		  => 'Archived Communications',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

    	[
    		'parent_view' => 'site.communications.index',
    		'section'     => 'help_communication_categorycount',
    		'title'		  => 'Communication Categories',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

    	//----------------------------------------------

    	[
    		'parent_view' => 'site.alerts.index',
    		'section'     => 'help_alert_overall',
    		'title'		  => 'Alerts',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
        [
            'parent_view' => 'site.alerts.index',
            'section'     => 'help_alert_category',
            'title'       => 'Category Alerts',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
            'status'      => 'on'
        ],

        [
            'parent_view' => 'site.alerts.index',
            'section'     => 'help_alert_categorycount',
            'title'       => 'Alert Categories',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
            'status'      => 'on'
        ],
    	[
    		'parent_view' => 'site.alerts.index',
    		'section'     => 'help_alert_archives',
    		'title'		  => 'Archived Alerts',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

    	//------------------------------------------------

    	[
    		'parent_view' => 'site.tasks.index',
    		'section'     => 'help_task_overall',
    		'title'		  => 'Tasks',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
        [
            'parent_view' => 'site.tasks.index',
            'section'     => 'help_task_tasklist',
            'title'       => 'Task List',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
            'status'      => 'on'
        ],
    	[
    		'parent_view' => 'site.tasks.index',
    		'section'     => 'help_task_dueToday',
    		'title'		  => 'Tasks Due Today',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.tasks.index',
    		'section'     => 'help_task_upcoming',
    		'title'		  => 'Upcoming Tasks',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.tasks.index',
    		'section'     => 'help_task_complete',
    		'title'		  => 'Completed Tasks',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.tasks.index',
    		'section'     => 'help_task_managerTask',
    		'title'		  => 'Manager Tasks',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

    	//----------------------------------------------

    	[
    		'parent_view' => 'site.documents.index',
    		'section'     => 'help_document_overall',
    		'title'		  => 'Library',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.documents.index',
    		'section'     => 'help_document_folders',
    		'title'		  => 'Folders',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.documents.index',
    		'section'     => 'help_document_documents',
    		'title'		  => 'Documents',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.documents.index',
    		'section'     => 'help_document_archives',
    		'title'		  => 'Archived Documents',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

    	//-----------------------------------------------

    	[
    		'parent_view' => 'site.video.index',
    		'section'     => 'help_video_featured',
    		'title'		  => 'Featured Video',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.video.index',
    		'section'     => 'help_video_playlists',
    		'title'		  => 'Latest Playlists',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.video.index',
    		'section'     => 'help_video_trending',
    		'title'		  => 'Trending Videos',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
        [
            'parent_view' => 'site.video.index',
            'section'     => 'help_video_mostRecent',
            'title'       => 'Most Recent Videos',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
            'status'      => 'on'
        ],

    	//---------------------------------------------------

    	
    	[
    		'parent_view' => 'site.community.audit',
    		'section'     => 'help_communitydonation_overall',
    		'title'		  => 'Community Donation',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.community.audit',
    		'section'     => 'help_communitydonation_newDonation',
    		'title'		  => 'New Donations',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.community.audit',
    		'section'     => 'help_communitydonation_pastDonations',
    		'title'		  => 'Past Donations',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],


    	//-------------------------------------------------------

    	[
    		'parent_view' => 'site.tools.flashsale.index',
    		'section'     => 'help_flashsale_domSaleDates',
    		'title'		  => 'Flash Sale',
    		'description' => 'Overall + Dates + Sorting + Searching',
    		'status'      => 'on'
    	],

    	//-------------------------------------------------------

    	[
    		'parent_view' => 'site.tools.dirtynodes.index',
    		'section'     => 'help_dirtynodes_overall',
    		'title'		  => 'Dirty Nodes',
    		'description' => 'Overall + Sorting + Searching + Cleaning',
    		'status'      => 'on'
    	],
    	

    	//-------------------------------------------------------

    	[
    		'parent_view' => 'site.tools.productdelivery.index',
    		'section'     => 'help_productdeliveries_overall',
    		'title'		  => 'Product Deliveries',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

    	//--------------------------------------------------------

    	[
    		'parent_view' => 'site.form.formlist.index',
    		'section'     => 'help_formlist_overall',
    		'title'		  => 'Forms',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.form.formlist.index',
    		'section'     => 'help_formlist_productrequest',
    		'title'		  => 'Product Request Form',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],
    	[
    		'parent_view' => 'site.form.formlist.index',
    		'section'     => 'help_formlist_subsequentForms',
    		'title'		  => 'Upcoming Forms',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],


    	//------------------------------------------------------

    	[
    		'parent_view' => 'site.form.productrequestform.index',
    		'section'     => 'help_productrequests_overall',
    		'title'		  => 'Product Requests',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

    	//------------------------------------------------------

    	[
    		'parent_view' => 'site.form.productrequestform.view',
    		'section'     => 'help_productrequest_requestDetails',
    		'title'		  => 'Product Request Details',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	],

    	//-----------------------------------------------------
    	[
    		'parent_view' => 'site.form.productrequestform.createOrUpdate',
    		'section'     => 'help_productrequest_newRequest',
    		'title'		  => 'New Request',
    		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus voluptas reiciendis, labore veniam harum quidem. Facere maxime esse vitae corrupti, minus necessitatibus voluptate itaque, aspernatur, dolorem ea at officiis sit!',
    		'status'      => 'on'
    	]





    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach($this->helpSections as $helpSection){
    		\DB::table('help_section')->insert($helpSection);	
    	}
        
    }
}
