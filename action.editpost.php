<?php
if (!isset($gCms)) die("Can't call actions directly!");

if (array_key_exists('cancelpost', $params))
{
	$this->redirect($id, 'defaultadmin', $return_id, array('selected_tab' => 'manageposts'));
}

$blog_post = cms_orm('BlogPost')->find_by_id($params['blog_post_id']);
if ($blog_post == null)
{
	$this->redirect($id, 'defaultadmin', $return_id, array('selected_tab' => 'manageposts'));
}

if (isset($params['submitpost']) || isset($params['submitpublish']))
{
	$blog_post->update_parameters($params['blog_post']);
	if (isset($params['submitpublish']))
	{
		$blog_post->status = 'publish';
	}

	if ($blog_post->save())
	{
		$this->redirect($id, 'defaultadmin', $return_id, array('selected_tab' => 'manageposts'));
	}
}

$smarty->assign('form_action', 'editpost');
$smarty->assign('blog_post', $blog_post);
echo $this->process_template('editpost.tpl', $id, $return_id);

# vim:ts=4 sw=4 noet
?>