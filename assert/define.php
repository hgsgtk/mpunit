<?php

const collect_vars = 'return v(get_defined_vars()+["this"=>isset($this)?$this:null]);';

function v(array $variable): string
{
    unset($variable['GLOBALS']);

    return \serialize($variable);
}
