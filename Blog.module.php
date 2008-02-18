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
}

# vim:ts=4 sw=4 noet
?>