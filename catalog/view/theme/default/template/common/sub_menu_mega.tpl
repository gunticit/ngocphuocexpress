			<div class="mega-menu-dropdown">
				<div class="mega-menu-dropdown-inner">
					<div class="sub-menu megamenu-sub columns<?php echo $parent_info['columns'] ?>" 
						style="width:<?php 
						if($parent_info['widths']){
						echo $parent_info['widths'].'px';
						}else{
							echo '100%';
						} 
						?>">
                        <?php if (strip_tags($content) != '') { ?>
						<div class='mega-content'>
							<?php echo $content; ?>
						</div>
                        <?php } ?>
						<?php if($result!=null){ ?>
						  <ul class='sub-menu-mega'>
							<?php foreach($result as $key=> $value) { ?>
								<li><a href="<?php echo $value['url']; ?>"><?php echo html_entity_decode($value['title'][$lang_id]); ?></a></li>
								<?php $this->listSubWithoutUl($value['id']);?>
                              <?php } ?>
							</ul>
						<?php } ?>
					</div>
				</div>
			</div>