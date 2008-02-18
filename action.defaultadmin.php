<?php
if (!isset($gCms)) die("Can't call actions directly!");

//Set for the new blog posting
$blog_post = new BlogPost();

if (isset($params['submitpost']) || isset($params['submitpublish']))
{
	$blog_post->update_parameters($params['blog_post']);
	if (isset($params['submitpublish']))
	{
		$blog_post->status = 'publish';
	}

	if ($blog_post->save())
	{
		$this->redirect($id, 'defaultadmin', $return_id);
	}
}

$smarty->assign('blog_post', $blog_post);

$smarty->assign('writepost', $this->process_template('editpost.tpl', $id, $return_id));
echo $this->process_template('defaultadmin.tpl', $id, $return_id);

# vim:ts=4 sw=4 noet
?>