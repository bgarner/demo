<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(GroupsTableSeeder::class);
        // $this->call(RolesTableSeeder::class);
        // $this->call(ComponentsTableSeeder::class);
        // $this->call(ResourceTypeTableSeeder::class);
        // $this->call(ResourcesTableSeeder::class);
        // $this->call(GroupRolesPivotSeeder::class);
        // $this->call(RoleResourcesPivotSeeder::class);
        // $this->call(RoleComponentPivotSeeder::class);
        // $this->call(TaskStatusTypesSeeder::class);
        // $this->call(TaskStoreStatusTypesSeeder::class);
        // $this->call(VideoTableSeeder::class);
        // $this->call(PlaylistTableSeeder::class);
        // $this->call(FeatureCommunicationTypeTableSeeder::class);
        // $this->call(FeatureTableSeeder::class);
        // $this->call(StoreComponentTableSeeder::class);
        // $this->call(AnalyticsAssetTypesTableSeeder::class);
        // $this->call(StoreTableSeeder::class);
        // $this->call(DistrictTableSeeder::class);
        // $this->call(RegionTableSeeder::class);
        // $this->call(DistrictStorePivotSeeder::class);
        // $this->call(DistrictRegionPivotSeeder::class);
        // $this->call(BannerStorePivotSeeder::class);
        // $this->call(CommunicationTypeBannerTableSeeder::class);
        // $this->call(FeatureBannerTableSeeder::class);
        // $this->call(UrgentNoticeBannerTableSeeder::class);
        // $this->call(BannerTableBannerClassSeeder::class);
        // $this->call(EventTypeBannerTableSeeder::class);
        // $this->call(BannerTableBannerClassSeeder::class);
        // $this->call(ComponentDeletablePropertySeeder::class);
        // $this->call(FormStatusCodeSeeder::class);
        // $this->call(FormTableSeeder::class);

        
        // $this->call(FormGroupAndRolesSeeder::class);
        // $this->call(FormPermissionTableSeeder::class);
        $this->call(BusinessUnitTypesTableSeeder::class);

    }
}
