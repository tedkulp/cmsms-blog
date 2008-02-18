<?php
if (!isset($gCms)) exit;

$this->drop_table('blog_posts');
$this->drop_table('blog_categories');
$this->drop_table('blog_post_categories');

?>