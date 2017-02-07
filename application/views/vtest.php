<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();
$v->main();?>
<ul class="media-list">
  <li class="media">
    <a class="pull-left" href="#">
      <img class="media-object" src="..." alt="...">
    </a>
    <div class="media-body">
      <h4 class="media-heading">Media heading</h4>
      ...
    </div>
  </li>
</ul>
<?php
$v->foot();
?>