<?php
if (!isset($gCms)) die("Can't call actions directly!");

$posts = null;
$category = cms_orm('BlogCategory')->find_by_name_or_slug($params['category'], $params['category']);

if ($category != null)
{
	$posts = $category->published_posts;
}

$smarty->assign('posts', $posts);

echo $this->process_template_from_database($id, $return_id, 'summary');

# vim:ts=4 sw=4 noet
?>