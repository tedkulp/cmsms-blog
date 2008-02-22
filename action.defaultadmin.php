<?php
if (!isset($gCms)) die("Can't call actions directly!");

//Set for the new blog posting
$blog_post = new BlogPost();
$blog_post->author_id = CmsLogin::get_current_user()->id;

if (isset($params['submitpost']) || isset($params['submitpublish']))
{
	$blog_post->update_parameters($params['blog_post']);
	
	if (isset($params['post_date_Month']))
	{
		$blog_post->post_date = new CmsDateTime(mktime($params['post_date_Hour'], $params['post_date_Minute'], $params['post_date_Second'], $params['post_date_Month'], $params['post_date_Day'], $params['post_date_Year']));
	}
	
	if (isset($params['submitpublish']))
	{
		$blog_post->status = 'publish';
	}

	if ($blog_post->save())
	{
		//$this->redirect($id, 'defaultadmin', $return_id);
		$this->blog_post = new BlogPost();
		$blog_post->author_id = CmsLogin::get_current_user()->id;
	}
}

$smarty->assign('selected_tab', coalesce_key($params, 'selected_tab', 'writepost'));
$smarty->assign('form_action', 'defaultadmin');
$smarty->assign('blog_post', $blog_post);
$smarty->assign('post_date_prefix', $id . 'post_date_');

$smarty->assign('posts', cms_orm('BlogPost')->find_all(array('order' => 'id desc')));

$smarty->assign('writepost', $this->process_template('editpost.tpl', $id, $return_id));
$smarty->assign('manageposts', $this->process_template('listposts.tpl', $id, $return_id));
echo $this->process_template('defaultadmin.tpl', $id, $return_id);

# vim:ts=4 sw=4 noet
?>