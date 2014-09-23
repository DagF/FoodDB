<?php

class OptionListRow extends Template{
    public function __construct( $name, $value ){
        $this->file = "templates/option_list_row.tpl";

        $this->values = [
            "value" => $value,
            "name" => $name
        ];
    }
}
