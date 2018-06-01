<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
        if (!function_exists('write_xml'))
        {
            function write_xml($data, $path)
            {
                $xml = new DOMDocument('1.0', 'UTF-8');
                $xml->formatOutput = true;
                if (!array_key_exists('root', $data) || $data['root'] == NULL)
                $data['root'] = 'document';
                $root = $xml->createElement($data['root']);
                foreach ($data['data'] as $key => $value)
                {
                    $element = $xml->createElement($key, $value);
                    $root->appendChild($element);
                }
                $xml->appendChild($root);
                $xml->save($path);
            }
        }
        if (!function_exists('read_xml'))
        {
            function read_xml($path)
            {
                $xml = new DOMDocument();
                $xml->load($path);
                $root = $xml->firstChild;
                $data = array();
                foreach ($root->childNodes as $node)
                {
                    if ($node->nodeType != XML_TEXT_NODE)
                    $data[$node->nodeName] = $node->nodeValue;
                }
                return $data;
            }
        }
