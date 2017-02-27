<?php

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules(array(
        '@PSR2' => true,
        'blank_line_after_opening_tag' => true,
        'function_typehint_space' => true,
        'no_extra_consecutive_blank_lines' => true,
        'single_quote' => true,
        'binary_operator_spaces' => true,
        'concat_space' => array('spacing' => 'one')
    ));
