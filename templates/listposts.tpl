{mod_form action='defaultadmin'}
  <p>
    {mod_lang string='category'}: {mod_dropdown name='current_category' values=$cms_mapi_module->get_categories(true) selected_value=$current_category}
    {mod_lang string='status'}: {mod_dropdown name='current_status' values=$cms_mapi_module->get_statuses(true) selected_value=$current_status}
	{mod_hidden name='selected_tab' value='manageposts'}
    {mod_submit name='submit_filter' value='filter' translate=true}
  </p>
{/mod_form}

{if count($posts) > 0}
  <table cellspacing="0" class="pagetable">
  	<thead>
  		<tr>
  			<th>{mod_lang string='title'}</th>
  			<th>{mod_lang string='postdate'}</th>
  			<th>{mod_lang string='category'}</th>
  			<th>{mod_lang string='author'}</th>
			<th>{mod_lang string='status'}</th>
  			<th class="pageicon">&nbsp;</th>
  			<th class="pageicon">&nbsp;</th>
  		</tr>
  	</thead>
  	<tbody>
    	{foreach from=$posts item=entry}
    		<tr class="{cycle values='row1,row2' advance=false name='post'}" onmouseover="this.className='{cycle values='row1,row2' advance=false name='article'}hover';" onmouseout="this.className='{cycle values='row1,row2' name='post'}';">
    			<td>{$entry->title}</td>
    			<td>{$entry->create_date}</td>
    			<td>Categories w/ Links</td>
				<td>Author</td>
				<td>{mod_lang string=$entry->status}</td>
    			<td>{mod_link action='editpost' value='editpost' blog_post_id=$entry->id theme_image='icons/system/edit.gif' translate=true}</td>
    			<td>{mod_link action='deletepost' value='deletepost' blog_post_id=$entry->id theme_image='icons/system/delete.gif' translate=true}</td>
    		</tr>
    	{/foreach}
  	</tbody>
  </table>
{else}
	<p><strong>{tr}noposts{/tr}</strong></p>
{/if}
