<?php // -*- mode:php; tab-width:4; indent-tabs-mode:t; c-basic-offset:4; -*-
#CMS - CMS Made Simple
#(c)2004-2008 by Ted Kulp (ted@cmsmadesimple.org)
#This project's homepage is: http://cmsmadesimple.org
#
#This program is free software; you can redistribute it and/or modify
#it under the terms of the GNU General Public License as published by
#the Free Software Foundation; either version 2 of the License, or
#(at your option) any later version.
#
#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#GNU General Public License for more details.
#You should have received a copy of the GNU General Public License
#along with this program; if not, write to the Free Software
#Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
#$Id$

class Blog extends CmsModuleBase
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_name()
	{
		return 'Blog';
	}
	
	function get_version()
	{
		return '0.1';
	}
	
	function is_plugin_module()
	{
		return true;
	}

	function has_admin()
	{
		return true;
	}
	
	function get_admin_description()
	{
		return $this->Lang('description');
	}

	function get_admin_section()
	{
		return 'content';
	}
	
	function setup()
	{
		$this->register_data_object('BlogPost');
		$this->register_data_object('BlogCategory');
		
		$this->register_module_plugin('blog');

		$this->register_route('/blog\/category\/(?P<category>[a-zA-Z\-_\ ]+)$/', array('action' => 'list_by_category'));		
		$this->register_route('/blog\/(?P<url>[0-9]{4}\/[0-9]{2}\/[0-9]{2}\/.*?)$/', array('action' => 'detail'));
		$this->register_route('/blog\/(?P<year>[0-9]{4})$/', array('action' => 'filter_list', 'month' => '-1', 'day' => '-1'));
		$this->register_route('/blog\/(?P<year>[0-9]{4})\/(?P<month>[0-9]{2})$/', array('action' => 'filter_list', 'day' => '-1'));
		$this->register_route('/blog\/(?P<year>[0-9]{4})\/(?P<month>[0-9]{2})\/(?P<day>[0-9]{2})$/', array('action' => 'filter_list'));
	}
	
	public function get_categories($add_any = false)
	{
		$result = array();
		if ($add_any)
		{
			$result[''] = $this->lang('any');
		}
		$categories = cms_orm('BlogCategory')->find_all(array('order' => 'name ASC'));
		if ($categories != null)
		{
			foreach ($categories as $one_category)
			{
				$result[$one_category->id] = $one_category->name;
			}
		}
		return $result;
	}
	
	public function get_statuses($add_any = false)
	{
		$result = array();
		if ($add_any)
		{
			$result[''] = $this->lang('any');
		}
		$result['draft'] = $this->lang('draft');
		$result['publish'] = $this->lang('published');
		return $result;
	}
	
	public function get_default_summary_template()
	{
		return '{foreach from=$posts item=entry}
		<h3><a href="{$entry->url}">{$entry->title}</a></h3>
		<small>
		  {$entry->post_date} 
		  {if $entry->author ne null}
		    {mod_lang string=by} {$entry->author->full_name()}
		  {/if}
		</small>

		<div>
		{$entry->get_summary_for_frontend()}
		</div>

		{if $entry->has_more() eq true}
		  <a href="{$entry->url}">{mod_lang string=hasmore} &gt;&gt;</a>
		{/if}

		{/foreach}';
	}
	
	public function get_default_detail_template()
	{
		return '{if $post ne null}
		<h3>{$post->title}</h3>
		<small>
		  {$post->post_date} 
		  {if $post->author ne null}
		    {mod_lang string=by} {$post->author->full_name()}
		  {/if}
		</small>

		<div>
		{$post->content}
		</div>

		<hr />

		<p>
		Comments Go Here
		</p>
		{else}
		{mod_lang string=postnotfound}
		{/if}';
	}
}

# vim:ts=4 sw=4 noet
?>