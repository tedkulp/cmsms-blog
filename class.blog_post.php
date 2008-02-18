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
	
	function validate()
	{
		$this->validate_not_blank('title', lang('nofieldgiven',array(lang('title'))));
		$this->validate_not_blank('content', lang('nofieldgiven',array(lang('content'))));
		$this->validate_not_blank('slug', lang('nofieldgiven',array(lang('slug'))));
	}
	
	function before_validation()
	{
		//if this is the first save of this post, generate a decent slug
		if ($this->id < 1 && $this->slug == '')
		{
			$this->slug = munge_string_to_url($this->title, true);
		}
	}
}

# vim:ts=4 sw=4 noet
?>