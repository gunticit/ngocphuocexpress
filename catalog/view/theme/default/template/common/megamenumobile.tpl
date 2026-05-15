<div id="mega-menu-mobile" class="visible-xs">
	<a href="javascript:void(0);" class="btn-close-mnmb"><span></span></a>
	<ul id='menu-mobile'>
		<?php $lang_id = $this->registry->get('config')->get('config_language_id'); ?>
		<?php foreach ($menus_root as $key => $menu) { ?>
		<?php $title = json_decode(base64_decode($menu['title']), true); ?>
		<li class="root <?php if(isset($menu['active']) and $menu['active']==1) echo " active";?> <?php if($menu['activemega']==1) echo " mega-root";?>"><a href="<?php echo $menu['url']; ?>"><?php echo html_entity_decode(html_entity_decode($title[$lang_id])) ?></a>
			<?php
			if($menu['activemega']==1)
			$proMegaMenuModel->list_submenu_mega($menu['id']);
			else
			$proMegaMenuModel->list_submenu($menu['id']);
			?>
		</li>
		<?php } ?>
	</ul>
</div>