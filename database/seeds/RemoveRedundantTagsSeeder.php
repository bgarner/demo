<?php

use Illuminate\Database\Seeder;
use App\Models\Tag\ContentTag;

class RemoveRedundantTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //get unique tags 
    // 	$tags = \DB::select( 
				// 	\DB::raw( 
				// 		"select distinct(`name`) as name , group_concat(`id`) as old_ids from tags group by `name`"
				// 	) 
				// );

    // 	//create new tags table with unique tags
    // 	foreach ($tags as $tag) {
    // 		\DB::table('new_tags')->insert((array)$tag);
    // 	}


    	$new_tags = \DB::table('new_tags')->get();

    	foreach ($new_tags as $new_tag) {
    		$old_ids = explode(',', $new_tag->old_ids );
    		$new_id = $new_tag->id;

    		foreach ($old_ids as $old_id) {
    			
    			ContentTag::where('tag_id', $old_id)->get()
    					->each(function($contentTag) use($new_id) {
    						\DB::table('new_content_tag')->insert([
    							'content_id' => $contentTag->content_id,
    							'content_type' => $contentTag->content_type,
    							'tag_id' => $new_id	
    						]);
    					});
    					
    		}
    	}


    	//drop tags, content_tag
    	//rename new_tags to tags, new_content_tag to content_tag
        
    }
}
