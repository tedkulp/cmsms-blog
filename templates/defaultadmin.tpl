{admin_tabs}

	{tab_headers active=$selected_tab}

		{tab_header name="writepost" text=$cms_mapi_module->lang('writepost')}
		{tab_header name="manageposts" text=$cms_mapi_module->lang('manageposts')}
	
	{/tab_headers}

	{tab_content name="writepost"}
	
		{$writepost}
	
	{/tab_content}	
	
	{tab_content name="manageposts"}
	
		{$manageposts}
	
	{/tab_content}

{/admin_tabs}
