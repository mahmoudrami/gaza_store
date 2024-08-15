<?php
namespace App\Traits;

trait trans{


    public function getTransNameAttribute(){
        return json_decode($this->name, true)[app()->getLocale()];// هيك بعطيك ايرور ليش لانو بقراش الا نصوص وهيك مصفوفة ف ايرور
    }

    public function getNameEnAttribute(){
        return json_decode($this->name, true)['en'];
    }

    public function getNameArAttribute(){
        return json_decode($this->name, true)['ar'];
    }

    public function getTransDescriptionAttribute(){
        return json_decode($this->description, true)[app()->getLocale()];// هيك بعطيك ايرور ليش لانو بقراش الا نصوص وهيك مصفوفة ف ايرور
    }

    public function getDescriptionArAttribute(){
        return json_decode($this->description, true)['ar'];
    }

    public function getDescriptionEnAttribute(){
        return json_decode($this->description, true)['en'];
    }

}
