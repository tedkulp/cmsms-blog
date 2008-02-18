<?php
if (!isset($gCms)) exit;

$this->create_table('blog_posts', "
	id I KEY AUTO,
	author_id I,
	post_date T,
	title C(255),
	slug C(255),
	content XL,
	summary XL,
	status C(25),
	use_comments I(1) default 1,
	create_date T,
	modified_date T
");

$this->create_table('blog_categories', "
	id I KEY AUTO,
	name C(255),
	create_date T,
	modified_date T
");

$this->create_table('blog_post_categories', "
	category_id I,
	post_id I,
	create_date T,
	modified_date T
");

$this->set_template('summary', 'Default Template', '<p>Placeholder</p>');
$this->set_template('detail', 'Default Template', '<p>Placeholder</p>');

$category = new BlogCategory();
$category->name = 'General';
$category->save();

$this->create_event('BlogPostAdded');
$this->create_event('BlogPostModified');
$this->create_event('BlogPostRemoved');
$this->create_event('BlogCategoryAdded');
$this->create_event('BlogCategoryModified');
$this->create_event('BlogCategoryRemoved');
$this->create_event('BlogCommentAdded');
$this->create_event('BlogCommentRemoved');

?>