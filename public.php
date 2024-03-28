<?php
/**
 * @category plugin
 * @package homebanner
 * @copyright  MAGIX CMS Copyright (c) 2011 Gerits Aurelien, http://www.magix-dev.be, http://www.magix-cms.com
 * @license Dual licensed under the MIT or GPL Version 3 licenses.
 * @version 1.0
 * @author Gérits Aurélien <aurelien@magix-cms.com>
 */
class plugins_homebanner_public extends plugins_homebanner_db {
	/**
	 * @var frontend_model_template
	 */
	protected frontend_model_template $template;
	protected frontend_model_data $data;
	protected component_files_images $imagesComponent;

	/**
	 * @var string $lang
	 */
	public string $lang;

	/**
	 * @param ?frontend_model_template $t
	 */
	public function __construct(?frontend_model_template $t = null) {
		$this->template = $t instanceof frontend_model_template ? $t : new frontend_model_template();
		$this->data = new frontend_model_data($this,$this->template);
		$this->lang = $this->template->lang;
	}

	/**
	 * Assign data to the defined variable or return the data
	 * @param string $type
	 * @param array|int|null $id
	 * @param ?string $context
	 * @param bool|string $assign
	 * @return mixed
	 */
	private function getItems(string $type, $id = null, ?string $context = null, $assign = true) {
		return $this->data->getItems($type, $id, $context, $assign);
	}

	/**
	 * @return void
	 */
	private function initImageComponent(): void {
		if(!isset($this->imagesComponent)) $this->imagesComponent = new component_files_images($this->template);
	}

	/**
	 * @param array $slides
	 * @return array
	 */
	private function setItemSlideData(array $slides): array {
		$arr = [];
		if(!empty($slides)) {
			$this->initImageComponent();
			foreach ($slides as $slide) {
				$arr[$slide['id_slide']] = [
					'id_slide' => $slide['id_slide'],
					'id_lang' => $slide['id_lang'],
					'title_slide' => $slide['title_slide'],
					'desc_slide' => $slide['desc_slide'],
					'link_slide' => [
						'url' => $slide['link_url_slide'],
						'label' => $slide['link_label_slide'],
						'title' => $slide['link_title_slide']
					],
					'blank_slide' => $slide['blank_slide'],
					'img' => $this->imagesComponent->setModuleImage('homebanner','homebanner',$slide['img_slide'],$slide['id_slide'])
				];
			}
		}
		return $arr;
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getSlides(array $params = []): array {
		if(empty($params)) {
			$slides = $this->getItems('homeSlides',['lang' => $this->lang],'all', false);
			return $this->setItemSlideData($slides);
		}
		return [];
	}
}