<?php
/*
 # -- BEGIN LICENSE BLOCK ----------------------------------
 #
 # This file is part of MAGIX CMS.
 # MAGIX CMS, The content management system optimized for users
 # Copyright (C) 2008 - 2019 magix-cms.com <support@magix-cms.com>
 #
 # OFFICIAL TEAM :
 #
 #   * Gerits Aurelien (Author - Developer) <aurelien@magix-cms.com> <contact@aurelien-gerits.be>
 #
 # Redistributions of files must retain the above copyright notice.
 # This program is free software: you can redistribute it and/or modify
 # it under the terms of the GNU General Public License as published by
 # the Free Software Foundation, either version 3 of the License, or
 # (at your option) any later version.
 #
 # This program is distributed in the hope that it will be useful,
 # but WITHOUT ANY WARRANTY; without even the implied warranty of
 # MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 # GNU General Public License for more details.

 # You should have received a copy of the GNU General Public License
 # along with this program.  If not, see <http://www.gnu.org/licenses/>.
 #
 # -- END LICENSE BLOCK -----------------------------------

 # DISCLAIMER

 # Do not edit or add to this file if you wish to upgrade MAGIX CMS to newer
 # versions in the future. If you wish to customize MAGIX CMS for your
 # needs please refer to http://www.magix-cms.com for more information.
 */
class plugins_homebanner_webservice extends plugins_homebanner_db{
    protected $template,$message,$UtilsHeader,$ws,$data,$xml,$header,$upload,$imagesComponent,$finder,$makeFiles,$slide,$url;
    public $id,$img,$imgData;
    public function __construct($t = null)
    {
        $this->template = $t ? $t : new frontend_model_template();
        $formClean = new form_inputEscape();
        $this->message = new component_core_message($this->template);
        $this->UtilsHeader = new component_httpUtils_header($this->template);
        $this->ws = new frontend_model_webservice();
        $this->data = new frontend_model_data($this);
        $this->xml = new component_xml_output();
        $this->header = new http_header();
        $this->upload = new component_files_upload();
        $this->imagesComponent = new component_files_images($this->template);
        $this->finder = new file_finder();
        $this->makeFiles = new filesystem_makefile();
        $this->url = http_url::getUrl();
        if (http_request::isGet('id')) {
            $this->id = $formClean->numeric($_GET['id']);
        }
        // --- Post
        if (http_request::isPost('slide')) {
            $this->slide = $formClean->arrayClean($_POST['slide']);
        }
        if(isset($_FILES['img']["name"])){
            $this->img = http_url::clean($_FILES['img']["name"]);
        }
        if (http_request::isPost('data')) {
            $this->imgData = array();
            parse_str($_POST['data'],$this->imgData);
        }
    }
    /**
     * Assign data to the defined variable or return the data
     * @param string $type
     * @param string|int|null $id
     * @param string $context
     * @param boolean $assign
     * @return mixed
     */
    private function getItems($type, $id = null, $context = null, $assign = true) {
        return $this->data->getItems($type, $id, $context, $assign);
    }
    /**
     * Update data
     * @param $data
     * @throws Exception
     */
    /**
     * Insert data
     * @param array $config
     */
    private function add($config)
    {
        switch ($config['type']) {
            case 'slide':
                parent::insert(
                    array('type' => $config['type'])
                );
                break;
            case 'slideContent':
                parent::insert(
                    array('type' => $config['type']),
                    $config['data']
                );
                break;
            case 'content':
                parent::insert(
                    array('type' => $config['type']),
                    $config['data']
                );
                break;
        }
    }

    /**
     * Mise a jour des données
     * @param $data
     * @throws Exception
     */
    private function upd($data)
    {
        switch ($data['type']) {
            case 'img':
            case 'slide':
            case 'slideContent':
            case 'content':
                parent::update(
                    array(
                        'context' => $data['context'],
                        'type' => $data['type']
                    ),
                    $data['data']
                );
                break;
        }
    }

    /**
     * suppression de données
     * @param $data
     * @throws Exception
     */
    private function del($data)
    {
        switch($data['type']){
            case 'delPages':
                parent::delete(
                    array(
                        'type' => $data['type']
                    ),
                    $data['data']
                );
                $this->message->json_post_response(true,NULL, $data['data']);
                break;
        }
    }
    //########## REQUEST POST, PUT, DELETE

    /**
     * @param bool $debug
     * @return mixed|SimpleXMLElement
     */
    public function parse($debug = false){
        return $this->ws->setParseData($debug);
    }
    /**
     * @param $data
     * @return array
     */
    private function setItemSlideData($data)
    {
        $arr = array();
        /*$extwebp = 'webp';
        foreach ($data as $slide) {
            $arr[$slide['id_slide']] = array();
            $arr[$slide['id_slide']]['id_slide'] = $slide['id_slide'];
            $arr[$slide['id_slide']]['id_lang'] = $slide['id_lang'];
            $arr[$slide['id_slide']]['title_slide'] = $slide['title_slide'];
            $arr[$slide['id_slide']]['desc_slide'] = $slide['desc_slide'];
            $arr[$slide['id_slide']]['url_slide'] = $slide['url_slide'];
            $arr[$slide['id_slide']]['blank_slide'] = $slide['blank_slide'];

            $imgPrefix = $this->imagesComponent->prefix();
            $fetchConfig = $this->imagesComponent->getConfigItems(array(
                'module_img'    =>'plugins',
                'attribute_img' =>'homebanner'
            ));
            $imgData = pathinfo($slide['img_slide']);
            $filename = $imgData['filename'];
            foreach ($fetchConfig as $key => $value) {
                $arr[$slide['id_slide']]['img'][$value['type_img']]['src'] = '/upload/homebanner/'.$slide['id_slide'].'/'.$imgPrefix[$value['type_img']] . $slide['img_slide'];
                $arr[$slide['id_slide']]['img'][$value['type_img']]['src_webp'] = '/upload/homebanner/'.$slide['id_slide'].'/'.$imgPrefix[$value['type_img']] . $filename . '.'.$extwebp;
                $arr[$slide['id_slide']]['img'][$value['type_img']]['w'] = $value['width_img'];
                $arr[$slide['id_slide']]['img'][$value['type_img']]['h'] = $value['height_img'];
                $arr[$slide['id_slide']]['img'][$value['type_img']]['crop'] = $value['resize_img'];
            }
        }
        return $arr;*/
        $imgPrefix = $this->imagesComponent->prefix();
        $fetchConfig = $this->imagesComponent->getConfigItems(array(
            'module_img'    =>'plugins',
            'attribute_img' =>'homebanner'
        ));
        foreach ($data as $page) {
            if (!array_key_exists($page['id_slide'], $arr)) {
                $arr[$page['id_slide']] = array();
                $arr[$page['id_slide']]['id_slide'] = $page['id_slide'];
                if ($page['img_slide'] != null) {
                    $arr[$page['id_slide']]['imgSrc']['original'] = '/upload/homebanner/' . $page['id_slide'] . '/' . $page['img_slide'];
                    foreach ($fetchConfig as $key => $value) {
                        $arr[$page['id_slide']]['imgSrc'][$value['type_img']] = '/upload/homebanner/' . $page['id_slide'] . '/' . $imgPrefix[$value['type_img']] . $page['img_slide'];
                    }
                }
            }
            $arr[$page['id_slide']]['content'][$page['id_lang']] = array(
                'id_lang' => $page['id_lang'],
                'iso_lang' => $page['iso_lang'],
                'default_lang' => $page['default_lang'],
                'title_slide' => $page['title_slide'],
                'url_slide' => $page['url_slide'],
                'desc_slide' => $page['desc_slide'],
                'blank_slide' => $page['blank_slide'],
                'published_slide' => $page['published_slide']
            );
        }
        return $arr;
    }

    /**
     * Ajout et Mise a jour des données
     * @param $arrData
     * @throws Exception
     */
    private function getBuildSave($arrData)
    {
        $id = isset($this->id) ? $this->id : $arrData['id'];

        if (isset($this->id)) {
            // Regarder pour voir si l'édition et ajout fonctionne correctement, sinon ajouté paramètre id (get)
            $fetchRootData = $this->fetchData(array('context'=>'one','type'=>'img'),array('id'=>$this->id));
            if($fetchRootData != null){
                $id_slide = $fetchRootData['id_slide'];
            }else{
                $this->add(array(
                    'type' => 'slide'
                ));
                $newData = $this->getItems('lastSlide', null,'one',false);
                $id_slide = $newData['id_slide'];
            }
        }else{
            $this->add(array(
                'type' => 'slide'
            ));
            $newData = $this->getItems('lastSlide', null,'one',false);
            $id_slide = $newData['id_slide'];
        }
        if($id_slide) {
            if(!array_key_exists('0',$arrData['language'])) {

                $content = $arrData['language'];

                $content['published'] = (!isset($content['published']) ? 0 : 1);
                $content['blank'] = (!isset($content['blank']) ? 0 : 1);

                $data = array(
                    'id_lang' => $content['id_lang'],
                    'id_slide' => $id_slide,
                    'title_slide' => !is_array($content['name']) ? $content['name'] : '',
                    'url_slide' => !is_array($content['url']) ? $content['url'] : '',
                    'desc_slide' => !is_array($content['content']) ? $content['content'] : NULL,
                    'blank_slide' => $content['blank'],
                    'published_slide' => $content['published']
                );
                if ($this->fetchData(array('context' => 'one', 'type' => 'slideContent'), array('id' => $id_slide, 'id_lang' => $content['id_lang'])) != null) {

                    $this->upd(array(
                        'type' => 'content',
                        'data' => $data
                    ));

                } else {

                    $this->add(array(
                        'type' => 'content',
                        'data' => $data
                    ));
                }

            }else {
                //print_r($arrData);
                foreach ($arrData['language'] as $lang => $content) {
                    $content['published'] = (!isset($content['published']) ? 0 : 1);
                    $content['blank'] = (!isset($content['blank']) ? 0 : 1);

                    $data = array(
                        'id_lang' => $content['id_lang'],
                        'id_slide' => $id_slide,
                        'title_slide' => !is_array($content['name']) ? $content['name'] : '',
                        'url_slide' => !is_array($content['url']) ? $content['url'] : '',
                        'desc_slide' => !is_array($content['content']) ? $content['content'] : NULL,
                        'blank_slide' => $content['blank'],
                        'published_slide' => $content['published']
                    );
                    if ($this->fetchData(array('context' => 'one', 'type' => 'slideContent'), array('id' => $id_slide, 'id_lang' => $content['id_lang'])) != null) {

                        $this->upd(array(
                            'type' => 'content',
                            'data' => $data
                        ));

                    } else {

                        $this->add(array(
                            'type' => 'content',
                            'data' => $data
                        ));
                    }
                }
            }
        }
        $this->header->set_json_headers();
        $this->message->json_post_response(true, null, array('id'=>$id_slide));
        //print_r($arrData);
    }

    /**
     * @param $arrData
     * @throws Exception
     */
    private function getBuildRemove($arrData){
        if($arrData['id']){
            $this->del(
                array(
                    'type'=>'delPages',
                    'data'=>array(
                        'id' => $arrData['id']
                    )
                )
            );
        }
    }
    /**
     * Return XML List
     */
    private function getBuildItems(){
        // Collection
        $collection = $this->getItems('WSslides',NULL,'all',false);

        $this->xml->newStartElement('slides');

        $arr = $this->setItemSlideData($collection);

        foreach($arr as $key => $value) {
            $this->xml->newStartElement('slide');
            $this->xml->setElement(
                array(
                    'start' => 'id',
                    'text' => $value['id_slide']
                )
            );

            if(isset($value['imgSrc'])) {
                $this->xml->newStartElement('image');
                foreach ($value['imgSrc'] as $k => $item) {
                    $this->xml->setElement(
                        array(
                            'start' => $k,
                            'attrNS' => array(
                                array(
                                    'prefix' => 'xlink',
                                    'name' => 'href',
                                    'uri' => $this->url . $item
                                )
                            )
                        )
                    );
                }
                $this->xml->newEndElement();
            }
            // Start languages loop
            $this->xml->newStartElement('languages');

            foreach($value['content'] as $item) {
                // Start Language
                $this->xml->newStartElement('language');
                $this->xml->setElement(
                    array(
                        'start' => 'id_lang',
                        'text' => $item['id_lang'],
                        'attr' => array(
                            array(
                                'name' => 'default',
                                'content' => $item['default_lang']
                            )
                        )
                    )
                );
                $this->xml->setElement(
                    array(
                        'start' => 'iso',
                        'text' => $item['iso_lang']
                    )
                );
                $this->xml->setElement(
                    array(
                        'start' => 'title',
                        'text' => $item['title_slide']
                    )
                );
                $this->xml->setElement(
                    array(
                        'start' => 'url',
                        'text' => $item['url_slide']
                    )
                );
                $this->xml->setElement(
                    array(
                        'start' => 'blank',
                        'text' => $item['blank_slide']
                    )
                );
                $this->xml->setElement(
                    array(
                        'start' => 'content',
                        'cData' => $item['desc_slide']
                    )
                );
                // End language loop
                $this->xml->newEndElement();
            }
            $this->xml->newEndElement();
            // End languages
            $this->xml->newEndElement();
        }
        $this->xml->newEndElement();
        $this->xml->output();
    }

    /**
     * Return XML Data from ID
     */

    /**
     *
     */
    public function run(){

        $getContentType = $this->ws->getContentType();
        if($this->ws->setMethod() === 'PUT'){
            if($getContentType === 'xml' || $getContentType === 'json') {

                $arrData = json_decode(json_encode($this->parse()), true);
                $this->getBuildSave($arrData);

            }

        }elseif($this->ws->setMethod() === 'POST'){
            if($getContentType === 'xml' || $getContentType === 'json') {

                $arrData = json_decode(json_encode($this->parse()), true);
                $this->getBuildSave($arrData);

            }elseif($getContentType === 'files'){
                if (isset($this->id)) {

                    $name = $this->imgData['img'];
                    $setImgDirectory = $this->upload->dirImgUpload(
                        array_merge(
                            array('upload_root_dir' => 'upload/homebanner/' . $this->id),
                            array('imgBasePath' => true)
                        )
                    );

                    if (file_exists($setImgDirectory)) {
                        $setFiles = $this->finder->scanDir($setImgDirectory);
                        $clean = '';
                        if ($setFiles != null) {
                            foreach ($setFiles as $file) {
                                $clean .= $this->makeFiles->remove($setImgDirectory . $file);
                            }
                        }
                    }

                    $settings = array(
                        'name'            => filter_rsa::randMicroUI(),
                        'edit'            => NULL,
                        'prefix'          => array('s_','m_','l_'),
                        'module_img'      => 'plugins',
                        'attribute_img'   => 'homebanner',
                        'original_remove' => false
                    );
                    $dirs = array(
                        'upload_root_dir' => 'upload/homebanner', //string
                        'upload_dir'      => $this->id //string ou array
                    );

                    $resultUpload = $this->upload->setImageUpload('img', $settings, $dirs, false);
                    $newData = array(
                        'id' => $this->id,
                        'img' => $resultUpload['file']
                    );
                    $this->upd(
                        array(
                            'type' => 'img',
                            'data' => $newData
                        )
                    );
                }
            }

        }elseif($this->ws->setMethod() === 'GET'){

            $this->xml->getXmlHeader();

            $this->getBuildItems();
            
        }elseif($this->ws->setMethod() === 'DELETE'){
            $arrData = json_decode(json_encode($this->parse()), true);
            $this->getBuildRemove($arrData);
        }
    }
}
?>