<div class="list-group"> <span class="list-group-item active" style='display:none;'><?php echo $heading_title;?></span>
  <?php foreach ($threads as $thread) { ?>
  <?php if ($thread['thread_id'] == $thread_id) { ?>
  <a href="<?php echo $thread['href']; ?>" class="list-group-item active"><?php echo $thread['name']; ?></a>
  <?php if ($thread['children']) { ?>
  <?php foreach ($thread['children'] as $child) { ?>
  <?php if ($child['thread_id'] == $child_id) { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item active">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
  <?php } else { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
  <?php } ?>
  <?php } ?>
  <?php } ?>
  <?php } else { ?>
  <a href="<?php echo $thread['href']; ?>" class="list-group-item"><?php echo $thread['name']; ?></a>
  <?php } ?>
  <?php } ?>
</div>
