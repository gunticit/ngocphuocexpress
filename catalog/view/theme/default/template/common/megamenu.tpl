<div id="mega-menu-container" class="hidden-xs">

	<a href="javascript:void(0);" class="responsive-menu-controller"><?php echo $responsive_title;?></a>

	<ul id='mega-menu'>

		<?php $lang_id = $this->registry->get('config')->get('config_language_id'); ?>

		<?php $count = count($menus_root)/2; ?>

		<?php foreach ($menus_root as $key => $menu) { ?>

		<?php if($key < $count){ ?> 

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

		<?php } ?>

		<?php foreach ($menus_root as $key => $menu) { ?>

		<?php if($key >= $count){ ?> 

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

		<?php } ?>

	</ul>


	<script type="text/javascript">

		$(window).load(function(){

			$('#mega-menu li.root > div').each(function(index, element) {

				var menu = $('#mega-menu').offset();

				var dropdown = $(this).parent().offset();

				i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#mega-menu').outerWidth());

				if (i > 0) {

					$(this).css('margin-left', '-' + i + 'px');

				}

			});

			$('.responsive-menu-controller').click(function(){

				if($(this).next().is(':visible')==true){

					$(this).next().slideUp();

				} else {

					$(this).next().slideDown();

				}

			})

			$('#mega-menu > li.root > a').click(function(){

				if($(this).parent().hasClass('clicked')==false && $(this).parent().hasClass('mega-root')==false && $(this).parent().children('.mega-menu-dropdown').length > 0 && $('.responsive-menu-controller').is(':visible')){

					$(this).parent().addClass('clicked');

					$(this).parent().css('height','auto');

					$(this).next().slideDown();

					return false;

				}

			})

		})

		$(window).bind('on',function(){

			var check = $('#mega-menu > li.root').find('mega-menu-dropdown');

			alert(check);

			if(check){

				$(this).append('<i class="fa fa-plus" aria-hidden="true"></i>');

			}

		});

	</script>

</div>



<div class="menu-mobile visible-xs">

	<div class="container">

		<div class="col-sm-12">

			<a href="javascript:void(0);" class="btn-menu-mobile btn-mn-xs"><?php echo $responsive_title;?></a>

			<nav id='menu-mobile'>

				<ul>

					<?php $lang_id = $this->registry->get('config')->get('config_language_id'); ?>

					<?php foreach ($menus_root as $menu) { ?>

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

			</nav>

		</div>

	</div>

	<script>

		$(window).bind("load resize", function(){

			if(jQuery(window).width()<992){

				jQuery('nav#menu-mobile').mmenu({

				});

			}

		});

		$(window).scroll(function(){

			var header_tall = $('header#header').height();

			if($(this).scrollTop() > header_tall){

				$('.megamn-desktop').addClass('fixedheader');

			}else{

				$('.megamn-desktop').removeClass('fixedheader');

			}

		});

		$('.btn-menu-mobile').on('click', function(){
			$('#menu-mobile').toggleClass('active');
		})

	</script>

</div>



