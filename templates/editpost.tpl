{validation_errors for=$blog_post}

{mod_form action=$form_action}
	
	<p>
		{mod_label name="blog_post[title]" value="title" translate=true}:<br />
		{mod_textbox name="blog_post[title]" value=$blog_post->title size="40"}
	</p>
	
	<p>
		{mod_label name="blog_post[content]" value="post" translate=true}:<br />
		{mod_textarea name="blog_post[content]" value=$blog_post->content cols="40" rows="10" wysiwyg=true}
	</p>
	
	<p>
		<fieldset>
			<legend>{$cms_mapi_module->lang('categories')}</legend>
			{foreach from=$categories item='one_category'}
				{assign var=category_id value=$one_category->id}
				{assign var=category_name value=$one_category->name}
				{mod_checkbox name="blog_post[category][$category_id]" selected=$blog_post->in_category($category_id)} {$category_name}<br />
			{/foreach}
		</fieldset>
	</p>
	
	<p>
		{mod_label name="blog_post[summary]" value="optional_summary" translate=true}:<br />
		{mod_textarea name="blog_post[summary]" value=$blog_post->summary cols="40" rows="4" wysiwyg=false}
	</p>
	
	<p>
		{mod_label name="blog_post[status]" value="status" translate=true}:<br />
		{mod_dropdown name="blog_post[status]" items=$cms_mapi_module->get_statuses() selected_value=$blog_post->status}
	</p>
	
	<p>
		{mod_label name='post_date_Month' value='postdate' translate=true}:<br />
		{html_select_date prefix=$post_date_prefix time=$blog_post->post_date->timestamp() start_year=2000 end_year=2020} {html_select_time prefix=$post_date_prefix time=$blog_post->post_date->timestamp()}
	</p>
	
	<p>
		{mod_hidden name="blog_post[author_id]" value=$blog_post->author_id}
		{mod_submit name="submitpost" value=submit translate=true} 
		{if $blog_post->id gt 0}
			{mod_hidden name="blog_post_id" value=$blog_post->id}
			{mod_submit name="cancelpost" value=cancel translate=true} 
		{/if}
		{mod_submit name="submitpublish" value=publish translate=true}
	</p>

{/mod_form}
