<?php echo $header; ?>
<section class="header-breadcrumb" style="background-image: url(http://carpenter.weblusive-themes.com/wp-content/uploads/2016/04/banner.jpg)">

	<div class="container">
		<div class="row m0 page-cover">
			<h2 class="page-cover-tittle">
				<?php echo $heading_title; ?>
			</h2>
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>        
		</div>
	</div>
</section>
<div class="container">
	<div class="row">
		<?php echo $column_left; ?>
		<?php if ($column_left && $column_right) { ?>
		<?php $class = 'col-sm-6'; ?>
		<?php } elseif ($column_left || $column_right) { ?>
		<?php $class = 'col-sm-9'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="<?php echo $class; ?>">

			<?php echo $content_top; ?>
			<div class="box_document">
				<div class="list_document">
					<?php foreach ($documents as $document) { ?>
					<div class="item-lb">
						<div class="item-document">
								<!-- <div class="image">
									<a href="<?php echo $document['href'];?>">
										<img src="<?php echo $document['thumb'];?>" alt="<?php echo $document['name'];?>" title="<?php echo $document['name'];?>">
									</a>
								</div> -->
								<div class="caption">
									<div class="name">
										<a class="apopup" href="<?php echo $document['href'];?>">
											<div style="display: flex;">
												<img src="<?php echo $document['thumb']; ?>" style="max-width: 80px; height: 80px;"> 
												<div style="padding: 0 20px;">
													<h2 style="<?php echo $imglogo; ?>color: #<?php if($imglogo == '.docx' || $imglogo == '.doc'){
														 echo '003a70';
														}else if($imglogo == '.pdf'){
															echo 'e80000';
															} else if($imglogo == '.xls' || $imglogo == '.xlsx'){
																echo '1a7343';
																} else if($imglogo == '.ppt' || $imglogo == '.pptx'){
																	echo 'e80000';
																} ?>"><?php echo $document['name'];?></h2>
																<p><?php echo nl2br($document['mota']);?></p>
															</div>
														</div>
													</a>
												</div>
											</div>
										</div>
									</div>
									<hr>
									<?php } ?>
								</div>
								<div class="pana"><?php echo $pagination; ?></div>
							</div>
							<?php echo $content_bottom; ?>
						</div>
						<?php echo $column_right; ?>
					</div>
				</div>
				<?php echo $footer; ?>
