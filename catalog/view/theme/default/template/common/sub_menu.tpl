			<div class="mega-menu-dropdown">
				<div class="mega-menu-dropdown-inner">
					<ul class="normal-submenu">
						<?php foreach($result as $key=>$value) { ?>
							<li>
								<a href="<?php echo $value['url']; ?>"><?php echo html_entity_decode($value['title'][$lang_id]); ?></a>
								<?php $this->list_submenu($value['id']); ?>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>