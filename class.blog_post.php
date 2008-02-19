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

class BlogPost extends CmsObjectRelationalMapping
{
	var $table = 'blog_posts';

	function __construct()
	{
		parent::__construct();
	}
	
	function setup()
	{
		$this->create_belongs_to_association('author', 'CmsUser', 'author_id');
	}
	
	function split_content()
	{
		return preg_split("/<!--\ ?more\ ?-->/i", $this->content);
	}
	
	function has_more()
	{
		return $this->summary != '' || count($this->split_content()) > 1;
	}
	
	function summary()
	{
		$result = '';

		if ($this->summary != '')
		{
			$result = $this->summary;
		}
		else
		{
			$parts = $this->split_content();
			$result = $parts[0];
		}
		
		return $result;
	}
	
	function validate()
	{
		$this->validate_not_blank('title', lang('nofieldgiven',array(lang('title'))));
		$this->validate_not_blank('content', lang('nofieldgiven',array(lang('content'))));
		if ($this->title != '')
			$this->validate_not_blank('slug', lang('nofieldgiven',array('slug')));
	}
	
	function before_validation()
	{
		//if this is the first save of this post, generate a decent slug
		if ($this->slug == '')
		{
			$this->slug = munge_string_to_url($this->title, true);
			$this->url = $this->post_date->format('Y') . '/' . $this->post_date->format('m') . '/' . $this->post_date->format('d') . '/' . $this->slug;
		}
	}
}

# vim:ts=4 sw=4 noet
?>