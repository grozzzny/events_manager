<?php


namespace grozzzny\events_manager\controllers;


use yii\easyii\helpers\Image;
use yii\easyii\helpers\Upload;
use yii\web\UploadedFile;

trait TraitController
{

    /**
     * Сохранение изображений и файлов. Отличе в методе сохранения
     * @param $current_model
     */
    public function saveFiles(&$current_model)
    {
        foreach ($current_model->getAttributes() as $attribute => $value){
            if($current_model->hasValidator('image', $attribute)) {
                $current_model->$attribute = UploadedFile::getInstance($current_model, $attribute);
                if($current_model->$attribute && $current_model->validate([$attribute])){
                    $current_model->$attribute = Image::upload($current_model->$attribute, $current_model::ALIAS);
                }
                else{
                    $current_model->$attribute = $current_model->isNewRecord ? '' : $current_model->oldAttributes[$attribute];
                }
            }elseif ($current_model->hasValidator('file', $attribute)){
                if($fileInstanse = UploadedFile::getInstance($current_model, $attribute)) {
                    $current_model->$attribute = Upload::file($fileInstanse, $current_model::ALIAS);
                }else{
                    $current_model->$attribute = $current_model->isNewRecord ? '' : $current_model->oldAttributes[$attribute];
                }
            }
        }
    }

}