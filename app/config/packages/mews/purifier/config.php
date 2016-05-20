<?php

/*
 * This file is part of HTMLPurifier Bundle.
 * (c) 2012 Maxime Dizerens
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/*'HTML.Allowed'             => 'div,b,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',*/
return array(
	'encoding' => 'UTF-8',
    'finalize' => true,
    'preload'  => false,
    'cachePath' => storage_path('purifier'),
    'settings' => array(
        'default' => array(
            'HTML.Doctype'             => 'XHTML 1.0 Strict',
            'HTML.Allowed'             => 'p[style],br',
            'CSS.AllowedProperties'    => 'text-align',
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty'   => true,
        ),
    ),
);
