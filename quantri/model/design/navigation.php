<?php
class ModelDesignNavigation extends Model {
	public function insert($data) {
		foreach($data['title'] as $key=>$value){
			$title = array_map("htmlentities", $value);
			$title = json_encode($title);
			$this->db->query("INSERT INTO " . DB_PREFIX . "navigation SET title = '" . $this->db->escape($title). "', url = '" . $this->db->escape($data['url'][$key]) . "', icon = '" . $this->db->escape($data['icon'][$key]) . "', parent_id = '" . (int)$data['parent_id'][$key] . "'");
		}
	}
	
	public function empty_data() {
		$this->db->query("TRUNCATE " . DB_PREFIX . "navigation");
	}
	
	public function getDefaultLanguage(){
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "language WHERE code = '" . $this->config->get('config_language') . "'");
		return $query->row ? $query->row['language_id'] : 0;
	}
	
	public function getMenuHtml($parent_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "navigation  WHERE " . DB_PREFIX . "navigation.parent_id = '".$parent_id."' ORDER BY " . DB_PREFIX . "navigation.id ASC");
		$result=array();
		foreach ($query->rows as $value) {
			$result[] = $value;
		}
		
		$this->load->language('design/navigation');
		
		/* Multi Language */
		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
		
		if($result) {
		if($parent_id!=0) echo "<ol class='dd-list'>";
		foreach($result as $value) { ?>
		<?php
			$title = json_decode($value['title'], true);
			//var_dump($title);
			$content = json_decode($value['subcontent'], true);
		?>
		<li class='dd-item'>
			<div class='dd-handle'>
				<div class='bar'>
					<span class='title'><?php echo html_entity_decode($title[$this->getDefaultLanguage()]);?></span>
				</div>
			</div>
			<div class='info hide'>
				<p class="input-item"><label><?php echo $this->language->get('entry_title'); ?></label></p>
				<?php foreach($languages as $language) { ?>
					<div class="input-group">
						<input class="form-control" type="text" name="title[][<?php echo $language['language_id']; ?>]" value="<?php if(isset($title[$language['language_id']])) echo html_entity_decode($title[$language['language_id']]);?>"/>
						<div class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>"/></div>
					</div>
				<?php } ?>
				<p class="input-item"><label><?php echo $this->language->get('entry_link'); ?></label><input class="form-control" type="text" name="url[]" value="<?php echo $value['url'] ; ?>"/></p>
                <div class="input-item">
                  <label><?php echo $this->language->get('entry_icon'); ?></label>
                  <p class="input-group">
                    <input class="form-control icon" type="text" name="icon[]" value="<?php echo $value['icon'] ; ?>"/>
                    <span class="input-group-addon"></span>
                  </p>
                </div>
				<p class="input-item"><a  href="javascript:void(0);" class="remove" onclick="remove_item(this);"><i class="fa fa-trash"></i> <?php echo $this->language->get('button_remove'); ?></a></p>
				<div class="hidden-data">
					<input type="hidden" class="parent_id" name="parent_id[]" value="<?php echo $value['parent_id'];?>"/>
				</div>
			</div><a href="javascript:void(0);" class="explane" onclick="explane(this)">Explane</a>
			<?php
				$this->model_design_navigation->getMenuHtml($value['id']);
			?>
		</li>
		<?php
		} 
		if($parent_id!=0) echo "</ol>";
		}
	}
	
	public function getlist() {

      $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "navigation  WHERE " . DB_PREFIX . "navigation.parent_id = '0' ORDER BY " . DB_PREFIX . "navigation.id ASC");
	  $result=array();
	  foreach ($query->rows as $value) {
				$result[] = $value;
	  }	
	  return $result;		
	}
}